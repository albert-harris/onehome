<?php

/**
 * This is the model class for table "{{_pro_resume}}".
 *
 * The followings are the available columns in table '{{_pro_resume}}':
 * @property integer $id
 * @property string $position
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $comment
 * @property string $file_resume
 * @property integer $status
 */
class ProResume extends CActiveRecord
{
    public static $AllowFile = 'doc,docx,pdf, txt, xlsx, xls, jpg,gif,png';
    public static $folderUpload='upload/resume';
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ProResume the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{_pro_resume}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('status', 'numerical', 'integerOnly'=>true),
			array('position, name, file_resume', 'length', 'max'=>255),
			array('email', 'length', 'max'=>100),
			array('email', 'email'),
			array('phone', 'length', 'max'=>50),
            array('position, name, email, phone, comment', 'required'),
            array('verify_code', 'captcha', 'allowEmpty'=>false),  
			array('comment', 'safe'),
            array('file_resume', 'file',
                'allowEmpty'=>true,
                'types'=> self::$AllowFile,
                'wrongType'=>Yii::t('lang', "Only ".self::$AllowFile." are allowed."),
            ), 
            
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, position, name, email, phone, comment, file_resume, status', 'safe'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'position' => 'Position',
			'name' => 'Name',
			'email' => 'Email',
			'phone' => 'Phone',
			'comment' => 'Comment',
			'file_resume' => 'File Resume',
			'status' => 'Status',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('t.id',$this->id);
		$criteria->compare('t.position',$this->position,true);
		$criteria->compare('t.name',$this->name,true);
		$criteria->compare('t.email',$this->email,true);
		$criteria->compare('t.phone',$this->phone,true);
		$criteria->compare('t.comment',$this->comment,true);
		$criteria->compare('t.file_resume',$this->file_resume,true);
		$criteria->compare('t.status',$this->status);

		$criteria->order = 't.id DESC';
		
        $_SESSION['data-excel'] // for retrive all items
		 = new CActiveDataProvider($this, array(
                        'pagination'=>false,
			'criteria'=>$criteria,
		));
        
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
            ),
		));
	}

    
    public function activate()
    {
        $this->status = 1;
        $this->update();
    }

    public function deactivate()
    {
        $this->status = 0;
        $this->update();
    }
	

	public function defaultScope()
	{
		return array(
			//'condition'=>'',
		);
	}
    
    public static function save_upload_file_resume($model){
        if(!is_null($model->file_resume)){
            $model->file_resume = self::saveFile($model, 'file_resume', self::$folderUpload, 1);
            $model->update(array('file_resume'));
        }
        return $model->file_resume;
    }
        
     /**
     * Apr 01, 2014 - ANH DUNG
     * To do: save file 
     * @param: $model model proresume
     * @param: $nameField ex: file_resume
     * @param: $pathUpload ex: 'upload/resume'  
     * @return: name of image
     */
    public static function  saveFile($model, $nameField, $pathUpload, $count)
    {
        if(is_null($model->$nameField)) return '';    
        $ext = $model->$nameField->getExtensionName();
        $fileName = MyFunctionCustom::slugify($model->$nameField->getName());
        $fileName = str_replace(strtolower($ext), '', $fileName);
        $fileName = trim($fileName, '-');
        $fileName = trim($fileName);
        $fileName = $fileName.'-'.time().$count.'.'.$ext;

        $imageProcessing = new ImageProcessing();
        $imageProcessing->createDirectoryByPath($pathUpload.'/'.$model->id);
        $model->$nameField->saveAs($pathUpload.'/'.$model->id.'/'.$fileName);
        return $fileName;
    }   
    
/**
     * <Jason>
     * <To Export auctioneers list>
     * @param type $list
     */
    public static function exportResume($list){
        Yii::import('application.extensions.vendors.PHPExcel',true);
        $objPHPExcel = new PHPExcel();
        // Set properties
        $objPHPExcel->getProperties()->setCreator("VerzDesign")
                                        ->setLastModifiedBy("Jason")
                                        ->setTitle('Export Current List')
                                        ->setSubject("Office 2007 XLSX Document")
                                        ->setDescription("Members")
                                        ->setKeywords("office 2007 openxml php")
                                        ->setCategory("Resume");
        
        
        $row=1;
        $i=1;
        $dataAll = $list->data;

        // 1.sheet 1 
        $objPHPExcel->setActiveSheetIndex(0);		
        $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setName('Times New Roman');
        $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setSize(12);       
        $objPHPExcel->getActiveSheet()->setTitle('Export Current List'); 

        $index=1;
        $beginBorder = $row;
        $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", 'SN');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", 'Position');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", 'Name');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", 'Email');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", 'Phone');
        $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", 'File Resume');
        $index--;

        $objPHPExcel->getActiveSheet()->getStyle("A$row:".MyFormat::columnName($index).$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle("A$row:".MyFormat::columnName($index).$row)->getFont()
                            ->setBold(true);    	
        $row++;

        foreach($dataAll as $model):
            $index=1;
            $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", $i);
            $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", $model->position);
            $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", $model->name);
            $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", $model->email);
            $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", $model->phone);
            $objPHPExcel->getActiveSheet()->setCellValue(MyFormat::columnName($index++)."$row", $model->file_resume);
            $row++;
            $i++;
        endforeach;	// end body

        $objPHPExcel->getActiveSheet()->getStyle("B$beginBorder:".MyFormat::columnName($index).($row))
            ->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);

        $row--;		
        $index--;
        $objPHPExcel->getActiveSheet()->getStyle("A$beginBorder:A".$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
        $objPHPExcel->getActiveSheet()->getStyle("A$beginBorder".':'.MyFormat::columnName($index).($row))
                                            ->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        
        $objPHPExcel->getActiveSheet()->getStyle("A$beginBorder:".MyFormat::columnName($index).$row)
                        ->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);		

        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
                    
        //save file
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

        for($level=ob_get_level();$level>0;--$level)
        {
                @ob_end_clean();
        }
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-type: '.'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'.'Resume List'.'.'.'xlsx'.'"');

        header('Cache-Control: max-age=0');
        $objWriter->save('php://output');
        Yii::app()->end(); 
    }
    
    protected function beforeSave() {
        $this->position = MyFormat::removeScriptTag($this->position);
        $this->phone = MyFormat::removeScriptTag($this->phone);
        $this->comment = MyFormat::removeScriptTag($this->comment);
        return parent::beforeSave();
    }
    
}
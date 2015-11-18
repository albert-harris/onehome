<?php

/**
 * This is the model class for table "{{_pro_upload_document}}".
 *
 * The followings are the available columns in table '{{_pro_upload_document}}':
 * @property integer $id
 * @property integer $order_no
 * @property string $title
 * @property string $file_name
 */
class ProUploadDocument extends CActiveRecord
{
    public static $AllowFile = 'doc,docx,pdf,jpg,gif,png,xls, xlsx';
    public static $folderUpload='upload/document';  
    
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ProUploadDocument the static model class
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
		return '{{_pro_upload_document}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array('title, file_name', 'required'),
            array('title', 'length', 'max'=>255),
            array('id, title, file_name,order_no', 'safe'),
            array('file_name', 'file',
                'allowEmpty'=>true,
                'types'=> ProUploadDocument::$AllowFile,
                'wrongType'=>Yii::t('lang', "Only ".ProUploadDocument::$AllowFile." are allowed."),
            ),  
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
            'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
        );
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'order_no' => 'Order No',
            'user_id' => 'User',
			'title' => 'Title',
			'file_name' => 'File Name',
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
		$criteria->compare('t.order_no',$this->order_no);
                $criteria->compare('t.user_id',$this->user_id,true);        
		$criteria->compare('t.title',$this->title,true);
		$criteria->compare('t.file_name',$this->file_name,true);
                
                $criteria->order = 't.id DESC';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
            ),
		));
	}

//    public function activate()
//    {
//        $this->status = 1;
//        $this->update();
//    }
//
//    public function deactivate()
//    {
//        $this->status = 0;
//        $this->update();
//    }

    /**
     * Apr 21, 2014 - Jason
     * To do: save file 
     * @param: $model transactions
     * @param: $nameField ex: file_name
      @param: $pathUpload ex: 'upload/document';  
     * @param: $nameBase name to show if need (option)
     * public static $folderUpload='upload/products/';
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
        $imageProcessing->createDirectoryByPath($pathUpload.'/'.$model->user_id);
        $model->$nameField->saveAs($pathUpload.'/'.$model->user_id.'/'.$fileName);
        return $fileName;
    }     
    
    /**
     * @Author: Jason  Apr 21, 2014
     * To do: delete file  of Product
     * @param: $model ProTransactionsPropertyDocument
     * @param: $nameField ex: file_name
     * @param: $pathUpload ex: 'upload/transactions/property_document';  
     */    
    public static function deleteOldFile($model, $nameField, $pathUpload)
    {
        $modelDel = self::model()->findByPk($model->id);
        if(is_null($modelDel) || empty($modelDel->$nameField))return;
        self::removeFile($modelDel);
    }   
    
    /**
     * @Author: Jason  Apr 21, 2014
     * @Todo: only remove file of transaction
     * @Param: $modelDel is model ProTransactionsPropertyDocument     
     */
    public static function removeFile($modelDel){
        $ImageProcessing = new ImageProcessing();
        $ImageProcessing->folder = '/'.self::$folderUpload.'/'.$modelDel->user_id;
        $ImageProcessing->delete($ImageProcessing->folder.'/'.$modelDel->file_name);        
    }
    
    protected function beforeDelete() {
        self::removeFile($this);
        return parent::beforeDelete();
    }
    
    // delete model and unlink file by $user_id
    public static function deleteByUserId($user_id){
        $criteria = new CDbCriteria();
        $criteria->compare('t.user_id', $user_id);
        $models = self::model()->findAll($criteria);
        if(count($models)){
            foreach($models as $item)
                $item->delete();
        }
    }
    
    /**
     * @return CActiveDataProvider
     * <Jason>
     * <To get list document for agent>
     */
    public static function getListDocument() {
        $criteria=new CDbCriteria;
//        $criteria->compare('t.user_id', Yii::app()->user->id);
        $criteria->order = 'order_no ASC';

        return new CActiveDataProvider('ProUploadDocument', array(
            'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
            ),
        ));
    }
    
	public function defaultScope()
	{
		return array(
			//'condition'=>'',
		);
	}
}
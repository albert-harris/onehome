<?php

/**
 * This is the model class for table "{{_pro_listing_upload_cea}}".
 *
 * The followings are the available columns in table '{{_pro_listing_upload_cea}}':
 * @property string $id
 * @property integer $listing_id
 * @property string $file
 * @property string $created_date
 * @property string $title
 */
class ProListingUploadCea extends CActiveRecord
{
    public $file_upload;
    /**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ProListingUploadCea the static model class
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
		return '{{_pro_listing_upload_cea}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('listing_id', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>255),
			array('created_date', 'safe'),
//                        array('file_upload', 'file',
//                            'allowEmpty' => false,
//                            'types' => 'doc,docx,pdf,xls,xlsx,txt,csv',
//                            'wrongType' => 'Only doc,docx,pdf,xls,xlsx,txt,csv are allowed.',
//                            'maxSize' => ActiveRecord::getMaxFileSize(), // 3MB
//                            'tooLarge' => 'The file was larger than 10 MB.Please upload a smaller file.',
//                       ),                   
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, listing_id, file, created_date, title,file_upload', 'safe'),
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
			'listing_id' => 'Listing',
			'file' => 'File',
			'created_date' => 'Created Date',
			'title' => 'Title',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('listing_id',$this->listing_id);
		$criteria->compare('file',$this->file,true);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('title',$this->title,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
             'pagination' => array(
                 'pageSize' => 50,
            ),            
		));
	}
     
    public static function checkLimitFileUpload($id){
        $totalImgupload = ProListingUploadCea::model()->countByAttributes(array('listing_id'=>$id));   
        if($totalImgupload>=LIMIT_DOC_UPLOAD){
            return false;
        }
        return true;
    }   
    
   public static function removefileDoc($model){
        @unlink(YII_UPLOAD_DIR .'/listing/'.$model->listing_id .'/cea/'.$model->file);
    }
    
    
    
    
    
}
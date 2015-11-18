<?php

/**
 * This is the model class for table "{{_pro_listing_apeal}}".
 *
 * The followings are the available columns in table '{{_pro_listing_apeal}}':
 * @property string $id
 * @property integer $listing_id
 * @property string $file
 * @property string $created_date
 */
class ProListingApeal extends CActiveRecord
{
    public $uploaf_file;
    /**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{_pro_listing_apeal}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('listing_id', 'numerical', 'integerOnly'=>true),
			array('file', 'length', 'max'=>255),
                        array('file', 'file',
                            'allowEmpty' => true,
                            'types' => 'pdf,doc,docx,xls,xlsx,txt',
                            'wrongType' => 'Only pdf,doc,docx,xls,xlsx,txt are allowed.',
                            'maxSize' => ActiveRecord::getMaxFileSize(), // 3MB
//                            'maxSize' => 100, // 3MB
                            'tooLarge' => 'The file was larger than  10 MB. Please upload a smaller file.',
                       ),                     
			array('id, listing_id, file, created_date', 'safe'),
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
			'file' => 'Supporting Document',
			'created_date' => 'Created Date',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('listing_id',$this->listing_id);
		$criteria->compare('file',$this->file,true);
		$criteria->compare('created_date',$this->created_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ProListingApeal the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        
        
        
}

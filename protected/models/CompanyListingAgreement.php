<?php

/**
 * This is the model class for table "{{_company_listing_agreement}}".
 *
 * The followings are the available columns in table '{{_company_listing_agreement}}':
 * @property integer $id
 * @property string $user_id
 * @property integer $location_id_1
 * @property integer $location_id_2
 * @property integer $location_id_3
 */
class CompanyListingAgreement extends CActiveRecord
{
	public $agreeCompany, $agreeRenewal, $agreeNond;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{_company_listing_agreement}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('agreeCompany, agreeRenewal, agreeNond', 'required', 'on'=>'show-popup', 'message'=>'You must agree to the term'),
			array('location_id_1, location_id_2, location_id_3', 'numerical', 'integerOnly'=>true),
			array('user_id', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, location_id_1, location_id_2, location_id_3', 'safe', 'on'=>'search'),
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
			'user_id' => 'User',
			'location_id_1' => 'Location Id 1',
			'location_id_2' => 'Location Id 2',
			'location_id_3' => 'Location Id 3',
			'location1' => '1st Prefered District',
			'location2' => '2nd Prefered District',
			'location3' => '3rd Prefered District',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('location_id_1',$this->location_id_1);
		$criteria->compare('location_id_2',$this->location_id_2);
		$criteria->compare('location_id_3',$this->location_id_3);
		$criteria->order = 'id desc';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CompanyListingAgreement the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function getAgentName() {
		return $this->user->name_for_slug;
	}
	
	public function getLocation1() {
		return Yii::app()->format->formatEnum($this->location_id_1, ProLocation::getListDataLocation());
	}
	
	public function getLocation2() {
		return Yii::app()->format->formatEnum($this->location_id_2, ProLocation::getListDataLocation());
	}
	
	public function getLocation3() {
		return Yii::app()->format->formatEnum($this->location_id_3, ProLocation::getListDataLocation());
	}
}

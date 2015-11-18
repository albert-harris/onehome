<?php

/**
 * This is the model class for table "{{_service_registration}}".
 *
 * The followings are the available columns in table '{{_service_registration}}':
 * @property string $id
 * @property integer $property_type
 * @property integer $room_type
 * @property integer $room_size
 * @property string $email
 * @property string $contact_no
 * @property integer $time_contact
 * @property integer $know_by
 *
 * The followings are the available model relations:
 * @property OurService[] $proOurServices
 */
class ServiceRegistration extends CActiveRecord
{
	static public $TIME_LIST = array(
		1 => 'Weekdays 10 am – 12 pm',
		2 => 'Weekdays 2 pm – 6 pm',
		3 => 'Sat      10 am  – 12 pm',
	);
	
	static public $KNOW_BY_LIST = array(
		1 => 'Onehome.sg',
		2 => 'From Agent',
		3 => 'SME Magazine',
		4 => 'Flyers',
		5 => 'Facebook',
	);
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{_service_registration}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('property_type, room_type, room_size, time_contact, know_by', 'numerical', 'integerOnly'=>true),
			array('fullname', 'length', 'max'=>50),
			array('email', 'length', 'max'=>255),
			array('address, address2', 'length', 'max'=>80),
			array('contact_no', 'length', 'max'=>30),
			array('salutation', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, property_type, room_type, room_size, fullname, email, contact_no, time_contact, know_by', 'safe', 'on'=>'search'),
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
			'registeredServices' => array(self::MANY_MANY, 'OurService', '{{_service_registration_item}}(registration_id, service_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'property_type' => 'Property Type',
			'propertyTypeText' => 'Property Type',
			'room_type' => 'Room Type',
			'roomTypeText' => 'Room Type',
			'room_size' => 'Size Area',
			'fullname' => 'Your Name',
			'email' => 'Email Address',
			'contact_no' => 'Contact Number',
			'time_contact' => 'Prefered Time to Be Contacted',
			'preferedTimeText' => 'Prefered Time',
			'know_by' => 'How Did You Get To Know Us?',
			'knowByText' => 'How Did You Get To Know Us?',
		);
	}

	public function behaviors(){
		return array(
			'CTimestampBehavior' => array(
				'class' => 'zii.behaviors.CTimestampBehavior',
				'createAttribute' => 'created_at',
			)
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
		$criteria->compare('property_type',$this->property_type);
		$criteria->compare('room_type',$this->room_type);
		$criteria->compare('room_size',$this->room_size);
		$criteria->compare('fullname',$this->fullname,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('contact_no',$this->contact_no,true);
		$criteria->compare('time_contact',$this->time_contact);
		$criteria->compare('know_by',$this->know_by);
		$criteria->order = 'created_at DESC';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ServiceRegistration the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function getPreferedTimeText() {
		return Yii::app()->format->formatEnum($this->time_contact, ServiceRegistration::$TIME_LIST);
	}
	
	public function getKnowByText() {
		return Yii::app()->format->formatEnum($this->know_by, ServiceRegistration::$KNOW_BY_LIST);
	}
	
	public function getPropertyTypeText() {
		return Yii::app()->format->formatEnum($this->property_type, ProPropertyType::$ARR_TYPE_SEARCH);
	}
	
	public function getRoomTypeText() {
		return Yii::app()->format->formatEnum($this->room_type, Listing::getListOptionsBedroom());
	}
	
	public function getRegisteredServiceData() {
		$result = array();
		foreach($this->registeredServices as $item) {
			if (!$item)
				continue;
			
			// item has no childs
			if (!$item->parent_id) {
				$result[$item->id] = array(
					'model' => $item,
					'childs' => array()
				);
				continue;
			}
			
			if (!isset($result[$item->parent_id])) {
				$result[$item->parent_id] = array(
					'model' => $item->parent,
					'childs' => array()
				);
			}
			$result[$item->parent_id]['childs'][] = $item;
		}
		return $result;
	}
	
}

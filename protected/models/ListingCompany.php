<?php

/**
 * This is the model class for table "{{_listing_company}}".
 *
 * The followings are the available columns in table '{{_listing_company}}':
 * @property integer $id
 * @property integer $location_id
 * @property integer $property_type
 * @property integer $type
 * @property string $asking_price
 * @property integer $bed_rooms
 * @property integer $bath_rooms
 * @property string $building_name
 * @property string $contact_name_no
 * @property integer $user_id
 * @property string $dnc_expiry_date
 * @property string $created_date
 * @property string $remarks
 */
class ListingCompany extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ListingCompany the static model class
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
		return '{{_listing}}';// Không dùng model này
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
            return array(
                    array('floor_area,property_address,location_id, property_type, type, asking_price, bed_rooms, bath_rooms, building_name, contact_name_no,dnc_expiry_date, remarks', 'required'),
                    array('id, location_id, property_type, type, bed_rooms, bath_rooms, user_id,asking_price', 'numerical', 'integerOnly'=>true),
                    array('asking_price', 'length', 'max'=>16),
                    array('building_name, contact_name_no', 'length', 'max'=>255),
                    array('dnc_expiry_date, remarks', 'safe'),
                    array('id, location_id, property_type, type, asking_price, bed_rooms, bath_rooms, building_name, contact_name_no, user_id, dnc_expiry_date, created_date, remarks,floor_area,property_address,asking_psf', 'safe'),
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
			'property_address' => 'Property address',
			'floor_area' => 'Floor area',
			'location_id' => 'Location',
			'property_type' => 'Property Type',
			'type' => 'Type',
			'asking_price' => 'Asking Price',
			'asking_psf' => 'Asking PSF',
			'bed_rooms' => 'Bed Rooms',
			'bath_rooms' => 'Bath Rooms',
			'building_name' => 'Building Name',
			'contact_name_no' => 'Contact Name/No',
			'user_id' => 'User',
			'dnc_expiry_date' => 'DNC Expiry Date',
			'created_date' => 'Created Date',
			'remarks' => 'Remarks',
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
		$criteria->compare('t.location_id',$this->location_id);
		$criteria->compare('t.property_type',$this->property_type);
		$criteria->compare('t.type',$this->type);
		$criteria->compare('t.asking_price',$this->asking_price,true);
		$criteria->compare('t.property_address',$this->property_address,true);
		$criteria->compare('t.bed_rooms',$this->bed_rooms);
		$criteria->compare('t.bath_rooms',$this->bath_rooms);
		$criteria->compare('t.building_name',$this->building_name,true);
		$criteria->compare('t.contact_name_no',$this->contact_name_no,true);
		$criteria->compare('t.user_id',$this->user_id);
		$criteria->compare('t.dnc_expiry_date',$this->dnc_expiry_date,true);
		$criteria->compare('t.created_date',$this->created_date,true);
		$criteria->compare('t.remarks',$this->remarks,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
            ),
		));
	}

    /*
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
	*/

	public function defaultScope()
	{
		return array(
			//'condition'=>'',
		);
	}
}
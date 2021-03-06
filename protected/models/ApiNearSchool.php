<?php

/**
 * This is the model class for table "{{_api_near_school}}".
 *
 * The followings are the available columns in table '{{_api_near_school}}':
 * @property integer $id
 * @property string $name
 * @property string $longitude
 * @property string $latitude
 * @property integer $status
 * @property string $created_date
 * @property string $long_street
 * @property string $lat_street
 */
class ApiNearSchool extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{_api_near_school}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('created_date', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('name, longitude, latitude', 'length', 'max'=>250),
			array('long_street, lat_street', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, longitude, latitude, status, created_date, long_street, lat_street', 'safe', 'on'=>'search'),
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
			'name' => 'Name',
			'longitude' => 'Longitude',
			'latitude' => 'Latitude',
			'status' => 'Status',
			'created_date' => 'Created Date',
			'long_street' => 'Long Street',
			'lat_street' => 'Lat Street',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('longitude',$this->longitude,true);
		$criteria->compare('latitude',$this->latitude,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('long_street',$this->long_street,true);
		$criteria->compare('lat_street',$this->lat_street,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ApiNearSchool the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

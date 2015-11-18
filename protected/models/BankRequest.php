<?php

/**
 * This is the model class for table "{{_bank_request}}".
 *
 * The followings are the available columns in table '{{_bank_request}}':
 * @property integer $id
 * @property string $property_name_or_address
 * @property string $postal_code
 * @property integer $unit_from
 * @property integer $unit_to
 * @property integer $location_id
 * @property integer $property_type_id
 * @property string $tenure
 * @property integer $furnished
 * @property integer $of_bathrooms
 * @property integer $of_bedroom
 * @property string $type_selling
 * @property string $floor_area
 * @property string $tenancy_expiry_date
 * @property integer $monthly_rental_amount
 * @property string $remark
 * @property string $nric
 * @property string $owner_particular
 * @property string $fullname
 * @property string $contact_no
 * @property string $email
 * @property string $target_price
 */
class BankRequest extends CActiveRecord
{
    public $termandcondition;
    public $transaction_id;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return BankRequest the static model class
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
		return '{{_bank_request}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
//            array('location_id, type_selling,postal_code,contact_no,owner_particular,nric,tenure,property_name_or_address,unit_from, unit_to, property_type_id, of_bathrooms, of_bedroom, email, fullname','required'),
            array('choosetype,location_id, type_selling,postal_code,contact_no,nric,tenure,property_name_or_address,unit_from, unit_to, of_bathrooms_from, of_bedroom_from, email, fullname','required'),
//            array('location_id, type_selling,postal_code,contact_no,nric,tenure,property_name_or_address,unit_from, unit_to, property_type_id, of_bathrooms_from, of_bathrooms_to, of_bedroom_from, of_bedroom_to, email, fullname','required'),
            array('unit_from, unit_to, location_id, of_bathrooms_from, of_bathrooms_to, of_bedroom_from, of_bedroom_to', 'numerical', 'min'=>1),
            array('monthly_rental_amount,target_price', 'numerical'),
            array('property_name_or_address, tenure, nric, owner_particular, fullname, email, furnished', 'length', 'max'=>255),
            array('postal_code, floor_area, contact_no', 'length', 'max'=>100),
            array('type_selling', 'length', 'max'=>17),
            array('tenancy_expiry_date', 'length', 'max'=>3),
            array('target_price', 'length', 'max'=>16),
            array('remark', 'safe'),
            array('termandcondition','boolean'),
            array('termandcondition', 'compare', 'compareValue' => 1, 'message' => 'You need to agree to the Terms and Conditions of Property Info.'),
            array('email', 'email'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, property_name_or_address, postal_code, unit_from, unit_to, location_id, property_type_id, tenure, furnished, of_bathrooms_from, of_bathrooms_to, of_bedroom_from, of_bedroom_to, type_selling, floor_area, tenancy_expiry_date, monthly_rental_amount, remark, nric, owner_particular, fullname, contact_no, email, target_price', 'safe'),
            array('tenancy_expiry_datepicker,choosetype,property_type_code', 'safe'),
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
            'property' => array(self::BELONGS_TO, 'ProPropertyType', 'property_type_id'),
            'location' => array(self::BELONGS_TO, 'ProLocation', 'location_id'),
            'furnished' => array(self::BELONGS_TO, 'ProMasterFurnished', 'furnished'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'property_name_or_address' => 'Property Name Or Address',
			'postal_code' => 'Postal Code',
			'unit_from' => 'Unit',
			'unit_to' => 'Unit',
			'location_id' => 'District',
			'property_type_id' => 'Property Type',
			'tenure' => 'Tenure',
			'furnished' => 'Furnished',
			'of_bathrooms_from' => '# of Bathrooms',
			'of_bathrooms_to' => 'Bathrooms To',
			'of_bedroom_from' => '# of Bedroom',
			'of_bedroom_to' => 'Bedroom To',
			'type_selling' => 'Type Selling',
			'floor_area' => 'Floor Area',
			'tenancy_expiry_date' => 'Tenancy Expiry Date',
			'monthly_rental_amount' => 'Monthly Rental Amount',
			'remark' => 'Remark',
			'nric' => 'NRIC',
			'owner_particular' => 'Owner Particular',
			'fullname' => 'Full Name as per NRIC',
			'contact_no' => 'Contact No',
			'email' => 'Email Address',
			'target_price' => 'Target Price',		
			'choosetype' => 'Property Type',
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
		$criteria->compare('t.property_name_or_address',$this->property_name_or_address,true);
		$criteria->compare('t.postal_code',$this->postal_code,true);
		$criteria->compare('t.unit_from',$this->unit_from);
		$criteria->compare('t.unit_to',$this->unit_to);
		$criteria->compare('t.location_id',$this->location_id);
		$criteria->compare('t.property_type_id',$this->property_type_id);
		$criteria->compare('t.tenure',$this->tenure,true);
		$criteria->compare('t.furnished',$this->furnished);
		$criteria->compare('t.of_bathrooms_from',$this->of_bathrooms_from);
		$criteria->compare('t.of_bathrooms_to',$this->of_bathrooms_to);
		$criteria->compare('t.of_bedroom_from',$this->of_bedroom_from);
		$criteria->compare('t.of_bedroom_to',$this->of_bedroom_to);
		$criteria->compare('t.type_selling',$this->type_selling,true);
		$criteria->compare('t.floor_area',$this->floor_area,true);
		$criteria->compare('t.tenancy_expiry_date',$this->tenancy_expiry_date,true);
		$criteria->compare('t.monthly_rental_amount',$this->monthly_rental_amount);
		$criteria->compare('t.remark',$this->remark,true);
		$criteria->compare('t.nric',$this->nric,true);
		$criteria->compare('t.owner_particular',$this->owner_particular,true);
		$criteria->compare('t.fullname',$this->fullname,true);
		$criteria->compare('t.contact_no',$this->contact_no,true);
		$criteria->compare('t.email',$this->email,true);
		$criteria->compare('t.target_price',$this->target_price,true);
                $criteria->order = "t.id DESC";

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
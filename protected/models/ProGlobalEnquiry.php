<?php

/**
 * This is the model class for table "{{_pro_global_enquiry}}".
 *
 * The followings are the available columns in table '{{_pro_global_enquiry}}':
 * @property integer $id
 * @property string $type_enquiry
 * @property integer $property_type_id
 * @property integer $location_id
 * @property string $price
 * @property string $bedrooms
 * @property string $floor_size
 * @property string $tenure
 * @property string $address
 * @property string $postal_code
 * @property string $HDB_own_estate
 * @property string $unit
 * @property string $official_bank_val
 * @property string $floor_area
 * @property string $listing_description
 * @property string $furnished
 * @property string $floor
 * @property string $lease_term
 * @property string $bathrooms
 * @property string $special_features
 * @property string $rent_type
 * @property string $availability
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property integer $country_id
 * @property string $created_date
 */
class ProGlobalEnquiry extends CActiveRecord {

    public $min_price;
    public $max_price;
    public $min_bedroom;
    public $max_bedroom;
    public $min_bathroom;
    public $max_bathroom;
    public $min_floor_size;
    public $max_floor_size;
    public $property_type_parent;
    public $min_unit;
    public $max_unit;
    public $get_update;
    public static $arrType = array(
        'Buy' => 'Buy',
        'Sell' => 'Sell',
        'Rent' => 'Rent'
    );
    public static $raRentType = array(
        'Landlord' => 'Landlord',
        'Tenant' => 'Tenant',
    );
    
    // ANH DUNG
    public $file_name;
    public $file_id;
    public $file_name_slug;
    public $date_only;
    public static $AllowFile = 'doc,docx,pdf,jpg,jpeg,png';
    public static $folderUpload='upload/global_enquiry';
    const MESSAGE_TERM = 'Please check Terms & Conditions.';
    
    public static function model($className = __CLASS__) {
        return parent::model($className);                
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{_pro_enquiry_global}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, phone, country_id', 'required', 'on' => 'create'),
            array('email', 'email', 'message'=>'This is not a valid email address'),
            array('name, phone, country_id', 'required', 'on' => 'remove'),
            array('property_type_id, location_id, country_id,monthly_rental_amount', 'numerical', 'integerOnly' => true),
            array('type_enquiry', 'length', 'max' => 4),
            array('tenure, address, postal_code, HDB_own_estate, unit, official_bank_val, floor_area, furnished, floor, lease_term, bathrooms, special_features, availability, name, email', 'length', 'max' => 100),
            array('rent_type', 'length', 'max' => 8),
            array('location_list_id,file_name,date_only,file_id, file_name_slug', 'safe'),
            array('id, type_enquiry, property_type_id, location_id, price, bedrooms, floor_size, tenure,'
                . ' address, postal_code, HDB_own_estate, unit, official_bank_val, floor_area, listing_description, furnished, floor, '
                . 'lease_term, bathrooms, special_features, rent_type, availability, name, email, '
                . 'phone, country_id, created_date,description,min_price,max_price,min_bedroom,max_bedroom,min_floor_size,max_floor_size,'
                . 'type_selling,tenancy_expiry_date,monthly_rental_amount,remark,nric,furnishing_include,listing_type,of_persons_staying,move_in_date,occupation,min_unit,max_unit,min_bathroom,max_bathroom,min_bedroom,max_bedroom,tenancy_expiry_datepicker', 'safe'),
            array('file_name', 'file','on'=>'file_upload',
                'allowEmpty'=>true,
                'types'=> ProGlobalEnquiry::$AllowFile,
                'wrongType'=>Yii::t('lang', "Only ".ProGlobalEnquiry::$AllowFile." are allowed."),
            ),             
            array('choosetype,property_type_code', 'safe'),
            
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        return array(
            'areaCode' => array(self::BELONGS_TO, 'AreaCode', 'country_id'),
            'property' => array(self::BELONGS_TO, 'ProPropertyType', 'property_type_id'),
            'location' => array(self::BELONGS_TO, 'ProLocation', 'location_id'),
            'rFile' => array(self::HAS_MANY, 'ProEnquiryGlobalFile', 'enquiry_global_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'type_enquiry' => 'Type Enquiry',
            'property_type_id' => 'Property Type',
            'location_id' => 'Location',
            'price' => 'Asking Price',
            'bedrooms' => 'Bedrooms',
            'floor_size' => 'Floor Size',
            'tenure' => 'Tenure',
            'address' => 'Address',
            'postal_code' => 'Postal Code',
            'HDB_own_estate' => 'Hdb Own Estate',
            'unit' => 'Unit',
            'official_bank_val' => 'Official Bank Val',
            'floor_area' => 'Floor Area',
            'listing_description' => 'Listing Description',
            'furnished' => 'Condition',
            'furnishing_include' => 'Furnishing',
            'floor' => 'Floor',
            'lease_term' => 'Lease Term',
            'bathrooms' => 'Bathrooms',
            'special_features' => 'Special Features',
            'rent_type' => 'Rent Type',
            'availability' => 'Availability',
            'name' => 'Full name',
            'email' => 'Email address',
            'phone' => 'Contact no',
            'country_id' => 'Country',
            'created_date' => 'Created Date',
            'description' => 'Description',
            'nric' => 'NRIC',
            'listing_type' => 'Listing For',
            'of_persons_staying' => '#Of persons staying',
            'move_in_date' => 'Move in date',
            'occupation' => 'Occupation',
            'file_name' => 'File Upload',
            'location_list_id' => 'Location',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('t.id', $this->id);
        $criteria->compare('t.type_enquiry', $this->type_enquiry, true);
        $criteria->compare('t.property_type_id', $this->property_type_id);
        $criteria->compare('t.location_id', $this->location_id);
        $criteria->compare('t.price', $this->price, true);
        $criteria->compare('t.bedrooms', $this->bedrooms, true);
        $criteria->compare('t.floor_size', $this->floor_size, true);
        $criteria->compare('t.tenure', $this->tenure, true);
        $criteria->compare('t.address', $this->address, true);
        $criteria->compare('t.postal_code', $this->postal_code, true);
        $criteria->compare('t.HDB_own_estate', $this->HDB_own_estate, true);
        $criteria->compare('t.unit', $this->unit, true);
        $criteria->compare('t.official_bank_val', $this->official_bank_val, true);
        $criteria->compare('t.floor_area', $this->floor_area, true);
        $criteria->compare('t.listing_description', $this->listing_description, true);
        $criteria->compare('t.furnished', $this->furnished, true);
        $criteria->compare('t.floor', $this->floor, true);
        $criteria->compare('t.lease_term', $this->lease_term, true);
        $criteria->compare('t.bathrooms', $this->bathrooms, true);
        $criteria->compare('t.special_features', $this->special_features, true);
        $criteria->compare('t.rent_type', $this->rent_type, true);
        $criteria->compare('t.availability', $this->availability, true);
        $criteria->compare('t.name', $this->name, true);
        $criteria->compare('t.email', $this->email, true);
        $criteria->compare('t.phone', $this->phone, true);
        $criteria->compare('t.country_id', $this->country_id);
        $criteria->compare('t.created_date', $this->created_date, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => array(
                    'id' => 'DESC'
                ),
            ),
            'pagination' => array(
                'pageSize' => Yii::app()->user->getState('pageSize', Yii::app()->params['defaultPageSize']),
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

    public function defaultScope() {
        return array(
                //'condition'=>'',
        );
    }
    
    protected function beforeSave() {
        $aAttributes = array(
           'tenure','address','postal_code','name','email',
           'phone','description','remark','occupation',
       );
       MyFormat::RemoveScriptOfModelField($this, $aAttributes);
       return parent::beforeSave();
    }

}

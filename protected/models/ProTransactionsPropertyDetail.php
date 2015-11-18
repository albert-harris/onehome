<?php

/**
 * This is the model class for table "{{_pro_transactions_property_detail}}".
 *
 * The followings are the available columns in table '{{_pro_transactions_property_detail}}':
 * @property string $id
 * @property string $transactions_id
 * @property string $category_id
 * @property string $property_type_id
 * @property integer $listing_type_id
 * @property string $unit_no
 * @property string $street_name
 * @property string $land_area
 * @property string $built_in_area
 * @property string $tenure
 * @property string $house_blk_no
 * @property string $no_of_bedroom
 * @property string $postal_code
 * @property string $building_name
 */
class ProTransactionsPropertyDetail extends CActiveRecord
{
    const VAR_INDIVIDUAL = 1;
    const VAR_COMPANY = 2;
    const VAR_INDIVIDUAL_FROM_COMPANY = 3;// là listing individual dc tạo  từ company listing, cái này chỉ sử dụng trong bảng listing
    const VAR_YES = 1;
    const VAR_NO = 0;
    public static $aListingType = array(
        self::VAR_INDIVIDUAL=>'Individual',
        self::VAR_COMPANY=>'Company',
    );
        
    public static $aYesNo = array(
        self::VAR_YES=>'Yes',
        self::VAR_NO=>'No',
    );
    
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
            return '{{_pro_transactions_property_detail}}';
    }

    public function rules()
    {
        return array(
            
            array('property_type_id, house_blk_no, postal_code', 
                'required', 'on'=>'CreateTransaction'),
            array('property_type_id, house_blk_no,street_name, postal_code', 
                'required', 'on'=>'CreateTransactionFromListing'), 
            array('property_type_id, house_blk_no,street_name, postal_code', 
                'required', 'on'=>'CreateTransactionFromListing'),

            array('property_type_id, house_blk_no, postal_code',
                'required', 'on'=>'CreateTransactionUnlisted'),
            
            array('property_type_id, house_blk_no, postal_code', 
                'required', 'on'=>'CreateTransactionTenancyOnly'),
            
            array('listing_type_id', 'numerical', 'integerOnly'=>true),
            array('unit_no, land_area, built_in_area', 'length', 'max'=>50),
            array('street_name, tenure, house_blk_no, building_name', 'length', 'max'=>100),
            array('no_of_bedroom', 'length', 'max'=>10),
            array('postal_code', 'length', 'max'=>20),
            array('property_name_or_address, id, transactions_id, category_id, property_type_id, listing_type_id, unit_no, street_name, land_area, built_in_area, tenure, house_blk_no, no_of_bedroom, postal_code, building_name', 'safe'),
            array('property_name_or_address','VerzRequiredMar'),// Mar 24, 2015
            
        );
    }
    
    /**
     * @Author: ANH DUNG Mar 26, 2015
     * @Todo: check required listing id or property_name_or_address
     */
    public function VerzRequiredMar($attribute, $params) {
        if(isset($_GET['add_property'])){
            if($_GET['add_property'] == ProTransactions::ADD_UNLISTED){
                if( trim($this->property_name_or_address) == ''){
                    $this->addError("property_name_or_address", $this->getAttributeLabel('property_name_or_address')." can not be blank");
                }
            }
        }
    }
    

    public function relations()
    {
        return array(
            'rPropertyType' => array(self::BELONGS_TO, 'ProPropertyType', 'property_type_id'),
            'rCategory' => array(self::BELONGS_TO, 'Categories', 'category_id'),
            'rTransaction' => array(self::BELONGS_TO, 'ProTransactions', 'transactions_id'),
            'rTenure' => array(self::BELONGS_TO, 'ProMasterTenure', 'tenure'),
            'rListing' => array(self::BELONGS_TO, 'Listing', 'listing_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'transactions_id' => 'Transactions',
            'category_id' => 'Category',
            'property_type_id' => 'Property Type',
            'listing_type_id' => 'Listing Type',
            'unit_no' => 'Unit No',
            'street_name' => 'Street Name',
            'land_area' => 'Land Area',
            'built_in_area' => 'Built In Area',
            'tenure' => 'Tenure',
            'house_blk_no' => 'House/Blk No',
            'no_of_bedroom' => 'No. of Bedroom',
            'postal_code' => 'Postal Code',
            'building_name' => 'Building Name',
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

            $criteria->compare('t.id',$this->id,true);
            $criteria->compare('t.transactions_id',$this->transactions_id);
            $criteria->compare('t.category_id',$this->category_id,true);
            $criteria->compare('t.property_type_id',$this->property_type_id,true);
            $criteria->compare('t.listing_type_id',$this->listing_type_id);
            $criteria->compare('t.unit_no',$this->unit_no,true);
            $criteria->compare('t.street_name',$this->street_name,true);
            $criteria->compare('t.land_area',$this->land_area,true);
            $criteria->compare('t.built_in_area',$this->built_in_area,true);
            $criteria->compare('t.tenure',$this->tenure,true);
            $criteria->compare('t.house_blk_no',$this->house_blk_no,true);
            $criteria->compare('t.no_of_bedroom',$this->no_of_bedroom,true);
            $criteria->compare('t.postal_code',$this->postal_code,true);
            $criteria->compare('t.building_name',$this->building_name,true);

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
    
    protected function beforeValidate() {
        $this->house_blk_no = InputHelper::removeScriptTag($this->house_blk_no);
        $this->street_name = InputHelper::removeScriptTag($this->street_name);
        $this->postal_code = InputHelper::removeScriptTag($this->postal_code);
        $this->no_of_bedroom = InputHelper::removeScriptTag($this->no_of_bedroom);
        $this->tenure = InputHelper::removeScriptTag($this->tenure);
        $this->unit_no = InputHelper::removeScriptTag($this->unit_no);
        $this->building_name = InputHelper::removeScriptTag($this->building_name);
        $this->built_in_area = InputHelper::removeScriptTag($this->built_in_area);
        $this->land_area = InputHelper::removeScriptTag($this->land_area);
        return parent::beforeValidate();
    }
    
    /**
     * @Author: ANH DUNG Apr 29, 2014
     * @Todo: get field of property detail by transaction id
     * @Param: $transactions_id 
     * @Param: $fieldName
     * @Return: string value of field
     */
    public static function getField($transactions_id, $fieldName){
        $res = '';
        $criteria=new CDbCriteria;
        $criteria->compare('t.transactions_id', $transactions_id);
        $model = self::model()->find($criteria);
        if($model){
            if($model->hasAttribute($fieldName)){
                $res = $model->$fieldName;
            }
        }
        return $res;
    }
    
    /**
     * @Author: ANH DUNG Dec 19, 2014
     * @Todo: something
     * @Param: $model
     */
    protected function beforeSave() {
        if($this->rListing){
            $this->property_name_or_address = $this->rListing->property_name_or_address;
        }
        return parent::beforeSave();
    }
}
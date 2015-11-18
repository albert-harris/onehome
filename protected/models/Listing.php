<?php

/**
 * This is the model class for table "{{_listing}}".
 *
 * The followings are the available columns in table '{{_listing}}':
 * @property string $id
 * @property integer $user_id
 * @property integer $status
 * @property integer $status_tmp
 * @property integer $status_approve
 * @property integer $status_listing
 * @property string $property_name_or_address
 * @property string $postal_code
 * @property string $hdb_town_estate
 * @property integer $property_type_1
 * @property integer $property_type_2
 * @property integer $unit_from
 * @property integer $unit_to
 * @property string $price
 * @property string $office_bkank_valuation
 * @property string $of_bedroom
 * @property string $floor_area
 * @property string $listing_description
 * @property integer $furnished
 * @property integer $floor
 * @property integer $lease_term
 * @property string $of_bathrooms
 * @property string $special_feature_json
 * @property string $fixtures_fittings_json
 * @property string $outdoor_indoor_space_json
 * @property string $furnishing_included
 * @property string $active_listing_options
 * @property string $remark
 * @property string $created_date
 * @property integer $listing_type
 */
class Listing extends CActiveRecord {
    public $agent_name; //HTram : for search in BE

    public $image_photo; //step 3
    public $file_upload; //step 3
    public $title_cea; //step 3
    public static $AllowFile = 'jpg,jpeg,png';
    public $photo_listing_anhdung; // Aug 12, 2014
    // APR 07, 2014 ANH DUNG - FOR SEARCH INDEX

    const FOR_SALE = 2;
    const FOR_RENT = 1;
    
    const DEFAULT_SORT_BY = "date_listed.desc";

    public static $aTextSaleRent = array(
//        Listing::FOR_SALE => 'FOR SALE',
//        Listing::FOR_RENT => 'FOR RENT',
        Listing::FOR_SALE => 'For Sale',
        Listing::FOR_RENT => 'For Rent',
    );
    
    public static $aTextSaleRentCompany = array(
        Listing::FOR_SALE => 'Sale',
        Listing::FOR_RENT => 'Rent',
    );
    
    public static $aTextSaleRentNormal = array(
        Listing::FOR_SALE => 'For Sale',
        Listing::FOR_RENT => 'For Rent',
    );
    
    public static $aDirectionSort = array('asc', 'desc');
//    public static $typeForRent = 'for-rent';
//    public static $typeForSale = 'for-sale';
    // item per page at index
    const DEFAULT_ITEM_PERPAGE = 12;
    public static $ITEM_PERPAGE = array( 
        12 => "12 items",
        16 => "16 items",
        24 => "24 items");
    public static $SORT_BY = array(Listing::DEFAULT_SORT_BY => 'Date (New to Old)',
        'date_listed.asc' => 'Date (Old to New)',
    );
    public static $S_SORT_BY = array(Listing::DEFAULT_SORT_BY => 'Date (New to Old)',
        'date_listed.asc' => 'Date (Old to New)',
    );
    public $user_agent_id;
    public $user_agent_nirc;
    public $user_member;
    public $file;
    
    const PRICE_ON_APPLICATION = 1;
    const PRICE_GUIDE = 2;
    const PRICE_VIEW_TO_OFFER = 3;
    const PRICE_OFFERS_IN_EXCESS_OF = 4;
    const PRICE_NEGOTIABLE = 5;
    // APR 07, 2014 ANH DUNG - FOR SEARCH INDEX    
    const NB_PRICE_OTHER = 6;
    
    public static $nearBy = array(
        51 => 'Nearest MRT Stations',
        23 => 'Nearest Schools',
        1093 => 'Nearest Building',
        'car' => 'Nearest bus stop',
//                'sign-post'=>'Nearest bus stop'
    );
    
    // Jun 25, 2014 ANH DUNG - 
    public static $ARR_PRICE_SELECT = array(
        Listing::PRICE_ON_APPLICATION =>'Price on Application',
        Listing::PRICE_GUIDE =>'Guide Price',
        Listing::PRICE_VIEW_TO_OFFER =>'View to Offer',
        Listing::PRICE_OFFERS_IN_EXCESS_OF =>'Offers in Excess of',
        Listing::PRICE_NEGOTIABLE =>'Negotiable',
        Listing::NB_PRICE_OTHER=>'Other (please specify)',
    );
    
    public static $ARR_HDB_TOWN_ESTATE = array(// this is test data
        1=>'Ang Mo Kio',
        2=>'Bedok',
        3=>'Bishan',
        4=>'Bukit Batok',
        5=>'Bukit Merah',
    );   
    public static $ARR_BED_ROOMS = array(
        0=>'Studio',
        11=>'Room Rental',
        1=>'1 Bedroom',
        2=>'2 Bedrooms',
        3=>'3 Bedrooms',
        4=>'4 Bedrooms',
        5=>'5 Bedrooms',
        6=>'6 Bedrooms',
        7=>'7 Bedrooms',
        8=>'8 Bedrooms',
        9=>'9 Bedrooms',
        10=>'10+ Bedrooms',
        
    );   
    
    const FLOOR_UNIT_SQFT = 'sqft';
    const FLOOR_UNIT_SQM = 'sqm';
    public static $ARR_FLOOR_AREA_UNIT = array(
        Listing::FLOOR_UNIT_SQFT => 'sqft',
        Listing::FLOOR_UNIT_SQM => 'sqm',
    );
    
    const LAND_AREA_UNIT = 'sqft';
    
    public $error_gvs3;
    // Jun 25, 2014 ANH DUNG - 
//    public static $default_required = 'listing_type,listing_type_transaction,property_name_or_address,postal_code,property_type_2,tenure';
    public static $default_required = 'listing_type,listing_type_transaction,property_name_or_address,property_type_2,tenure';
    public static $default_required_admin = 'listing_type,listing_type_transaction,property_name_or_address,postal_code,property_type_2,tenure';
    public static $AllScenarioStep1 = array('gsv1','gsv2','gsv3','gsv4','gsv5','gsv6','gsv7','gsv8','gsv9');
    
    public static $ARR_LISTING_TYPE = array(
        ProTransactionsPropertyDetail::VAR_INDIVIDUAL=>'Individual',
        ProTransactionsPropertyDetail::VAR_INDIVIDUAL_FROM_COMPANY=>'Company',
    );
    
    
    // Jun 25, 2014 ANH DUNG - 
    public static function getListOptionsPrice(){
        return Listing::$ARR_PRICE_SELECT;
    }
    public static function getListOptionsHDB(){
        return ProMasterHdbTown::getListOption();
    }
    public static function getListOptionsBedroom(){
        return Listing::$ARR_BED_ROOMS;
    }
    public static function getListOptionsFloorAreaUnit(){
        return Listing::$ARR_FLOOR_AREA_UNIT;
    }
    public static function getViewBedroom($value){
        return isset(Listing::$ARR_BED_ROOMS[$value])?Listing::$ARR_BED_ROOMS[$value]:'';
    }    
    // Jun 25, 2014 ANH DUNG - 
    
    // Aug 04, 2014 ANH DUNG - 
    const COMPANY_IMMEDIATE = 1;
    const COMPANY_FOLLOW_UP = 2;
    public $dnc_expiry_date_new;
    
    const EDIT_CONTACT_NUMBER = 1;
    const UPDATE_DNC_EXPIRY_DATE = 2;
    const DELETE = 3;
    const CHANGE_TELEMARKETER = 4;
    
    const STATUS_COMPANY_AVAILABLE = 1;
    const STATUS_COMPANY_CLOSED = 2;
    const STATUS_COMPANY_DELETE =3;
    
    public static $ACTION_COMPANY_LISTING = array(
        Listing::EDIT_CONTACT_NUMBER=>'Edit Contact Number',
        Listing::UPDATE_DNC_EXPIRY_DATE=>'Update DNC Expiry Date',
        Listing::CHANGE_TELEMARKETER => 'Change Telemarketer'
    );
    public $action_listing_grid;
    public static $COMPANY_TYPE_MOVE_REVERT = array(
        Listing::COMPANY_IMMEDIATE=>Listing::COMPANY_FOLLOW_UP,
        Listing::COMPANY_FOLLOW_UP=>Listing::COMPANY_IMMEDIATE,
    );
    
    public static $STATUS_COMPANY_ = array(
        Listing::STATUS_COMPANY_AVAILABLE=>'Available',
        Listing::STATUS_COMPANY_CLOSED=>'Closed',
        Listing::STATUS_COMPANY_DELETE=>'Deleted',
    );
    
    // Aug 04, 2014 ANH DUNG - 
    
    public static function buildTR($model){
//        $cms = new CmsFormatter();
//		$c = Yii::app()->controller;
//		$ownerContact = $c->widget('ShortTextWidget', array(
//			'text' => $model->contact_name_no,
//			'urlOnCLick' => $c->createUrl('/member/company/fieldClick', array('id'=>$model->id, 'field'=>'owner_contact'))
//		), true);
		
		return 
            '<div class="hidden_detail ad_nb_tr child-'.$model->id.'">
                <div class="listing_detail">
                    <strong class="label_detail">Property Type:</strong> '.$model->rPropertyType->name.'<br/>
                    <strong class="label_detail">Owner\'s Name:</strong> '. $model->company_owner_name .'<br/>
                    <strong class="label_detail">Address:</strong> '.$model->property_name_or_address.'<br/>
                    <strong class="label_detail">Display Address:</strong> '.$model->display_address.'
                </div>
                <div class="listing_detail">
                    <strong class="remark">Remarks:</strong> <div style="display: inline-block;">'.nl2br($model->remark).'</div><br/>
                </div>
            </div>';

    }
    
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{_listing}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {        
        $default_required = Listing::$default_required;
        if(Yii::app()->controller->module->id=='admin')
        {
            $default_required = Listing::$default_required_admin;
        }
        
        return array(
            ///create listing_Step1
//             array('of_bedroom,of_bathrooms,floor_area','compare','compareValue'=>'0','operator'=>'>'),
//            array('unit_from, unit_to,price,office_bkank_valuation,floor_area,of_bedroom', 'numerical', 'integerOnly' => true, 'on' => 'create_listing_step1'),
            // Jun 26, 2014 ANH DUNG CLOSE 
//    array('listing_type,listing_type_transaction,property_name_or_address,postal_code,hdb_town_estate,property_type_1,unit_from,unit_to,price,of_bedroom,floor_area,tenure', 'required', 'on' => 'create_listing_step1'),
//    array('of_bedroom,floor_area', 'compare', 'compareValue' => '0', 'operator' => '>', 'on' => 'create_listing_step1'),
//    array('unit_from, unit_to,price,office_bkank_valuation', 'compare', 'compareValue' => '0','allowEmpty'=>true, 'operator' => '>=', 'message' => '{attribute} must be greater than 0', 'on' => 'create_listing_step1'),
//    array('unit_to,unit_from', 'compare', 'compareValue' => '0', 'operator' => '>=', 'message' => 'Unit  must be greater than 0', 'on' => 'create_listing_step1'),
//    array('unit_to', 'compare', 'compareAttribute' => 'unit_from', 'operator' => '>', 'message' => 'Unit to must be greater than Unit from', 'on' => 'create_listing_step1'),
            // Jun 26, 2014 ANH DUNG CLOSE 
            
    array('listing_type,listing_type_transaction,property_name_or_address,postal_code,property_type_2,tenure', 'required', 'on' => 'create_listing_step1'),    
    array('postal_code','comparePostalcode','on' => 'create_listing_step1,create_listing_step1_admin'),
//    array('postal_code','PostalcodeUniqueCompanyListing','on' => 'CreateListingCompany,UpdateListingCompany'),
            
//    hdb_town_estate
    /***** ANH DŨNG from gsv1 -> gvs9  ******/
    array( $default_required.',of_bedroom,floor_area',
        'required', 
        'on' => 'gsv1'),
    array($default_required.',of_bedroom,floor_area,land_area',
        'required', 
        'on' => 'gsv2'),
    array($default_required.',of_bedroom',
        'required', 
        'on' => 'gsv3'),
    array('floor_area,land_area ','VerzRuleGsv3', 'on' => 'gsv3'),
    array($default_required.',land_area',
        'required', 
        'on' => 'gsv4'),
    array($default_required.',hdb_town_estate,of_bedroom,floor_area',
        'required', 
        'on' => 'gsv5'),
    array($default_required.',floor_area',
        'required', 
        'on' => 'gsv6'),
    array($default_required.',floor_area',
        'required', 
        'on' => 'gsv7'),
    array($default_required.',floor_area',
        'required', 
        'on' => 'gsv8'),
    array($default_required.',land_area',
        'required', 
        'on' => 'gsv9'),
            
    array('price','VerzCheckMinMaxPrice',
        'on' => 'gsv1,gsv2,gsv3,gsv4,gsv5,gsv6,gsv7,gsv8,gsv9'),
    array('floor_area,land_area ','VerzRuleMinLandFloor', 
        'on' => 'gsv1,gsv2,gsv3,gsv4,gsv5,gsv6,gsv7,gsv8,gsv9'),
    array('user_agent_id ','VerzRuleMemberBE', 
        'on' => 'gsv1,gsv2,gsv3,gsv4,gsv5,gsv6,gsv7,gsv8,gsv9'),
                
    array('listing_type,listing_type_transaction,property_name_or_address,postal_code,property_type_2,tenure', 'required', 'on' => 'create_listing_step1_admin'),
 
    /***** ANH DŨNG from gsv1 -> gvs9  ******/

    // Ku Toan create listing_Step1 admin - ANH DUNG CLOSE Jul 01, 2014
//    array('listing_type,listing_type_transaction,property_name_or_address,postal_code,hdb_town_estate,property_type_1,unit_from,unit_to,price,of_bedroom,floor_area,user_agent_id,tenure', 'required', 'on' => 'create_listing_step1_admin'),
//    array('of_bedroom,floor_area', 'compare', 'compareValue' => '0','allowEmpty'=>true, 'operator' => '>', 'on' => 'create_listing_step1_admin'),
//    array('unit_from, unit_to,unit_from, unit_to,price,office_bkank_valuation,floor_area,of_bedroom', 'numerical', 'integerOnly' => true, 'on' => 'create_listing_step1_admin'),
//    array('price,office_bkank_valuation', 'compare', 'compareValue' => '0', 'operator' => '>=', 'message' => '{attribute} must be greater than 0', 'on' => 'create_listing_step1_admin'),
//    array('unit_to,unit_from', 'compare', 'compareValue' => '0', 'operator' => '>=', 'message' => 'Unit  must be greater than 0', 'on' => 'create_listing_step1_admin'),
//    array('unit_to', 'compare', 'compareAttribute' => 'unit_from', 'operator' => '>', 'message' => 'Unit to must be greater than Unit from', 'on' => 'create_listing_step1_admin'),
    // Ku Toan create listing_Step1 admin 
                        
    //extradetail_step2
//            array('listing_description,furnished,floor,lease_term,of_bathrooms,special_feature_json,fixtures_fittings_json,outdoor_indoor_space_json,furnishing_included_json', 'required', 'on' => 'extradetail_step2'),
//    array('listing_description,furnished,floor,lease_term,of_bathrooms', 'required', 'on' => 'extradetail_step2'),
    array('listing_description', 'required', 'on' => 'extradetail_step2_for_sale'),
    array('listing_description,', 'required', 'on' => 'extradetail_step2_for_rent'),
//    array('of_bathrooms', 'compare', 'compareValue' => '0', 'operator' => '>', 'on' => 'extradetail_step2'),
    //ajax Upload photo
    array('image_photo', 'file', 'on' => 'ajax_upload_photo_step2',
        'allowEmpty' => true,
        'types' => 'jpg,gif,png',
        'wrongType' => 'Only '.Listing::$AllowFile.' are allowed.',
        'maxSize' => ActiveRecord::getMaxFileSizeImage(), // 3MB
//        'maxSize' => 10, // 3MB
        'tooLarge' => 'The file was larger than ' . (ActiveRecord::getMaxFileSize() / 1024) . ' KB. Please upload a smaller file.',
    ),
    //step 4
    array('activate_listing_options', 'required', 'on' => 'listing_step4'),
    //admin_rejected
    array('remark_by_admin', 'required', 'on' => 'admin_rejected'),
    //listing_appeal_upload_file
    array('remark_rejected', 'required', 'on' => 'listing_appeal_upload_file'),
    // The following rule is used by search().	
//    array('user_id, status, status_tmp, status_approve, status_listing, property_type_1, property_type_2, unit_from, unit_to, furnished, floor, lease_term, listing_type,of_bathrooms,asking_psf', 'numerical', 'integerOnly' => true),// Feb 09, 2015 remove unit_from, unit_to,
    array('user_id, status, status_tmp, status_approve, status_listing, property_type_1, property_type_2, furnished, floor, lease_term, listing_type,of_bathrooms,asking_psf', 'numerical', 'integerOnly' => true),
    array('property_name_or_address, postal_code, hdb_town_estate, office_bkank_valuation, of_bedroom, floor_area, of_bathrooms', 'length', 'max' => 255),
    array('price', 'length', 'max' => 16),
    //blank_valuation_request
    array('location_id, listing_type,listing_type_transaction,property_name_or_address,postal_code,hdb_town_estate,property_type_1,unit_from,unit_to,price,of_bedroom,floor_area,developer,tenure', 'required', 'on' => 'blank_valuation_request'),
    // Please remove those attributes that should not be searched.
    array('id, user_id, status, status_tmp, status_approve, status_listing, property_name_or_address,keywordsearch, '
        . 'postal_code, hdb_town_estate, property_type_1, property_type_2, unit_from, unit_to, price, office_bkank_valuation, '
        . 'of_bedroom, floor_area, listing_description, furnished, floor, lease_term, of_bathrooms, special_feature_json,listing_releated,'
        . 'fixtures_fittings_json, outdoor_indoor_space_json, furnishing_included_json, active_listing_options,developer,tenure,postal_code_xy,listing_type_transaction, '
        . 'remark, created_date, listing_type,image_photo,file_upload,title_cea,activate_listing_options,remark_by_admin,user_agent_id,asking_psf,building_name,contact_name_no,dnc_expiry_date', 'safe'),
    // Jun 26, 2014 ANH DUNG ADD
    array('dnc_expiry_date_new,date_listed,land_area, floor_area_unit, asking_price_select, asking_price_select_other,postal_code_tmp,company_listing_id', 'safe'),
    array('house_blk_no,company_owner_name,company_email,company_storey,company_utility_room,company_availability,company_built_up', 'safe'),
    array('dnc_expiry_date_text,photo_listing_anhdung,search_psf,last_update_by,last_update_time', 'safe'),
    array('company_listing_keywordsearch, vacant_position,flexible,property_building_name,display_title,display_address', 'safe'),
    // Aug 06-2014 for company listing
    // Aug 28-2014 for company listing ANH DUNG CLOSE
//    array('property_name_or_address,postal_code,floor_area,of_bedroom,price,property_type_1,unit_from, unit_to, building_name,listing_type,contact_name_no,dnc_expiry_date,'
//        . 'house_blk_no,company_owner_name,company_email,company_storey,company_utility_room,'
//        . 'company_availability,company_built_up', 'required', 'on'=>'CreateListingCompany, UpdateListingCompany'),
    array('property_name_or_address,postal_code,floor_area,of_bedroom,price,property_type_1,unit_from, unit_to, building_name,listing_type,contact_name_no,'
        . 'house_blk_no,company_owner_name,'
        . 'company_availability', 'required', 'on'=>'CreateListingCompany, UpdateListingCompany'),
            
    array('company_email', 'email', 'on'=>'CreateListingCompany, UpdateListingCompany'),            
    // Aug 06-2014 for company listing            
    array('price', 'numerical', 'tooSmall'=>"Price shouldn't be zero", 'min' => 1 ),

    //validate postal code , unit form,unit to
    array('postal_code','CheckUnitListing','on'=>'create_listing_step1,create_listing_step1_admin,gsv1,gsv2,gsv3,gsv4,gsv5,gsv6,gsv7,gsv8,gsv9'),        
            
    //HTram
    array('agent_name, location_id','safe'),
        );
    }

    /**
     * @Author: ANH DUNG Jun 27, 2014
     * @Todo: rule gvs3 check floor area or land area
     */
    public function VerzRuleGsv3($attribute,$params)
    {
        if(trim($this->floor_area)=='' && trim($this->land_area)=='' ){
           $this->addError("error_gvs3","Please enter either floor area or land area.");
        }
    }    
    public function VerzRuleMinLandFloor($attribute,$params)
    {
        // floor_area
        if(trim($this->floor_area)!='' && Yii::app()->params['min_floor_area']>0 ){
           $value = $this->floor_area;
           if($this->floor_area_unit==Listing::FLOOR_UNIT_SQM){
               $value = $this->floor_area*Yii::app()->params['unit_sqm_sqft'];
           }
           if($value<Yii::app()->params['min_floor_area']){
                $this->addError("floor_area","Cannot list property with floor area below ".Yii::app()->params['min_floor_area']." sqft");
                if($this->floor_area_unit==Listing::FLOOR_UNIT_SQM){
                    $this->floor_area_unit = Listing::FLOOR_UNIT_SQFT;
                    $this->floor_area = $value ;
                }
           }
        }// end floor_area
        
        // floor_area
        if(trim($this->land_area)!=''&& $this->land_area!=0 && Yii::app()->params['min_land_area']>0 ){
           $value = $this->land_area;
           if($value<Yii::app()->params['min_land_area']){
                $this->addError("land_area","Cannot list property with land area below ".Yii::app()->params['min_land_area']." sqft");
           }
        }// end floor_area        
    }
    /**
     * @Author: ANH DUNG Jun 27, 2014
     * @Todo: kiểm tra min max price với mỗi property type tương ứng
     */
    public function VerzCheckMinMaxPrice($attribute,$params)
    {
        return ; // tạm đóng lại theo y/c
        if(trim($this->price)!=''){
            $price = $this->price;
            $message = self::SubCheckOne($this->property_type_1, $price);
            if($message==''){
                $message = self::SubCheckOne($this->property_type_2, $price);
            }
            if($message!=''){
                $this->addError("price",$message);
            }
        }
    }    
    
    /**
     * @Author: DTOAN
     * @Todo: kiểm tra Liting tao khong duoc phep trung nhau
     * 1 User dc phep tao 2 listing cung postal code,unit form,unit to voi 2 type khac nhau(rent,sale)
     */
    public function CheckUnitListing($attribute,$params)
    {
        /**
         * 1.Kiem tra postal code da co hay chua
         *     - Kiem tra postal code do cua user dang tao khong
         *      a.user hien tai 
         *          - kiem  tra listing_type co trung khong ====> ko duoc phep trung listing type (for rent,for sale)
         *      b.user khac 
         *          - bao loi
         *          
         */
        if(trim($this->postal_code)!=''){
            $checkListing =Listing::model()->findByAttributes(array('postal_code'=>$this->postal_code));
            if($checkListing){
                //user hien tai
//                if($this->property_type_2 !=2 && $this->property_type_2 !=42 ){ //Apartment/Condo cai nay co unit from,unit to
//                    // echo  $this->unit_from  .'---'.$checkListing->unit_from .'<br>';
//                    // echo  $this->unit_to  .'---'.$checkListing->unit_to .'<br>';
//                   if($checkListing->id !=$this->id){
//                       if($this->id !=$checkListing->id &&($this->unit_from ==$checkListing->unit_from) && ($this->unit_to ==$checkListing->unit_to) ){
//                            if($this->listing_type==$checkListing->listing_type){
//                                $this->addError("unit_from",'Unit already existed in our system');
//                            }
//                        }                    
//                   }
//                }
                
                // if(($this->unit_from ==$checkListing->unit_from) && ($this->unit_to ==$checkListing->unit_to) ){
                //     $this->addError("unit_from",'Unit already existed in our system');
                // }else{
                //     if($checkListing->user_id == $this->user_agent_id){
                //         if($this->listing_type==$checkListing->listing_type){
                //             $this->addError("postal_code",'Postal code already existed in our system');
                //         }
                //     }else{
                //         $this->addError("postal_code",'Postal code already existed in our system.');
                //     }  
                // }
            }
        }
    }    
    




    /**
     * @Author: ANH DUNG Jun 27, 2014
     * @Todo: kiểm tra min max price với mỗi property type tương ứng
     */
    public function VerzRuleMemberBE($attribute,$params)
    {
        if(Yii::app()->controller->module->id=='admin')
        {
            $label = $this->getAttributeLabel('user_agent_id');
            if($this->listing_type_transaction == ProTransactionsPropertyDetail::VAR_INDIVIDUAL){
                if(empty($this->user_agent_id)){
                    $this->addError("user_agent_id", "$label cannot be blank.");
                }// user_agent_id
            }
        }
    }
    
    /**
     * @Author: ANH DUNG Jun 27, 2014
     */
    public static function SubCheckOne($property_type_id, $price){
        $message='';
        $mProperty = ProPropertyType::model()->findByPk($property_type_id);
        if($mProperty){
            if(!empty($mProperty->price_min) && !empty($mProperty->price_max)
                    && $mProperty->price_min>0&&$mProperty->price_max>0){
                if(!Listing::validMinMaxPrice($mProperty, $price)){
                    $price_min = ProPropertyType::formatPriceMinMax($mProperty, 'price_min');
                    $price_max = ProPropertyType::formatPriceMinMax($mProperty, 'price_max');
                    $nameProperty = $mProperty->name;
                    $message = "Sorry! Price outside acceptable range. For $nameProperty, must be <br>between $price_min and $price_max";
                }
            }
        }
        return $message;
    }
    
    /**
     * @Author: ANH DUNG Jun 27, 2014
     * @Todo: check min max price with $model id
     * @Param: $mProperty model property
     * @Return: full name with salution of user
     */
    public static function validMinMaxPrice($mProperty, $price){
        // price_min,price_max,price_sign,price_sign_position', 'safe'),
        $res = false;
        if($mProperty->price_min<= $price && $mProperty->price_max>= $price){
            $res = true;
        }
        return $res;
    }    
    
    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
            'rUser' => array(self::BELONGS_TO, 'Users', 'user_id'),
            'rUserAdmin' => array(self::BELONGS_TO, 'Users', 'user_id_admin'),
            'rHdbTown' => array(self::BELONGS_TO, 'ProMasterHdbTown', 'hdb_town_estate'),
            'rPropertyType' => array(self::BELONGS_TO, 'ProPropertyType', 'property_type_1'),
            'rPropertyType2' => array(self::BELONGS_TO, 'ProPropertyType', 'property_type_2'),
            'rBedroom' => array(self::BELONGS_TO, 'ProMasterBedroom', 'of_bedroom'),
            'rBathroom' => array(self::BELONGS_TO, 'ProMasterBathroom', 'of_bathrooms'),
            'rFloor' => array(self::BELONGS_TO, 'ProMasterFloor', 'floor'),
            'rFurnished' => array(self::BELONGS_TO, 'ProMasterFurnished', 'furnished'),
            'rLeaseTerm' => array(self::BELONGS_TO, 'ProMasterLeaseTerm', 'lease_term'),
//            'releated' => array(self::HAS_ONE, 'ProListingReleated', 'listing_releated'),
            'releated' => array(self::HAS_MANY, 'ProListingReleated', 'listing_id'),
            'rTransaction' => array(self::HAS_MANY, 'ProTransactions', 'listing_id',
                'on'=>'rTransaction.status>0',
                ),
            
            'rLocationDistrict' => array(self::BELONGS_TO, 'ProLocation', 'location_id'),
            'rCompanyListing' => array(self::BELONGS_TO, 'Listing', 'company_listing_id'),
            'rCompanyListingHasMany' => array(self::HAS_MANY, 'Listing', 'company_listing_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'user_id' => 'Created By',
            'status' => 'Status',
            'status_tmp' => 'Status Tmp',
            'status_approve' => 'Status Approve',
            'status_listing' => 'Status Listing',
            'property_name_or_address' => 'Property Name Or Address',
            'postal_code' => 'Postal Code',
            'hdb_town_estate' => 'HDB Town / Estate',
            'property_type_1' => 'Property Type',
            'property_type_2' => 'Property Type',
            'unit_from' => 'Unit # ',
            'unit_to' => 'Unit # ',
            'price' => 'Price (S$)',
            'office_bkank_valuation' => 'Official / Bank Valuation (S$)',
            'of_bedroom' => '# Of Bedrooms',
            'floor_area' => 'Floor Area ',
            'listing_description' => 'Listing Description',
            'furnished' => 'Condition',
            'floor' => 'Floor',
            'lease_term' => 'Lease Term',
            'of_bathrooms' => '# Of Bathrooms',
            'special_feature_json' => 'Special Feature',
            'fixtures_fittings_json' => 'Fixtures Fittings',
            'outdoor_indoor_space_json' => 'Outdoor Indoor Space',
            'furnishing_included_json' => 'Furnishing Included',
            'active_listing_options' => 'Active Listing Options',
            'remark' => 'Remark',
            'created_date' => 'Created Date',
            'listing_type' => 'Listing Type',
            'image' => 'Image',
            'file_upload' => 'File upload',
            'title_cea' => 'Title',
            'user_agent_id' => 'Member',
            'file' => 'Supporting Document',
            'remark_rejected' => 'Reason',
            'tenure' => 'Tenure',
            'developer' => 'Developer',
            'listing_type_transaction' => 'Listing Transaction',
            'location_id' => 'Location',
            'contact_name_no'=>'Contact No',
            'user_id_admin'=>'Created By',
            'company_listing_keywordsearch'=>'Keyword Search',
            'dnc_expiry_date_new'=>'New Expiry Date',
            'company_owner_name'=>'Owner Name',
            'company_email'=>'Email',
            'company_storey'=>'Storey',
            'company_utility_room'=>'Utility Room',
            'company_availability'=>'Availability',
            'company_built_up'=>'Built Up',
            'house_blk_no'=>'House/Blk No',
            'last_update_time'=>'Last Modified Date',
            'company_listing_id'=>'Company Listing',
            'company_listing_status'=>'Status',
            'vacant_position'=>'Vacant Position',
            'flexible'=>'Flexible',
			'owner_contact_click' => 'Click Owner Contacts',
			'view_count' => 'Number of Views',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        $criteria = new CDbCriteria;
        $criteria->with = array('user');
        $criteria->compare('id', $this->id, true);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('status', $this->status);
        $criteria->compare('status_tmp', $this->status_tmp);
        $criteria->compare('status_approve', $this->status_approve);
        $criteria->compare('status_listing', $this->status_listing);
        $criteria->compare('property_name_or_address', $this->property_name_or_address, true);
        $criteria->compare('postal_code', $this->postal_code, true);
        $criteria->compare('hdb_town_estate', $this->hdb_town_estate, true);
        $criteria->compare('unit_from', $this->unit_from);
        $criteria->compare('unit_to', $this->unit_to);
        $criteria->compare('price', $this->price, true);
        $criteria->compare('office_bkank_valuation', $this->office_bkank_valuation, true);
        $criteria->compare('of_bedroom', $this->of_bedroom, true);
        $criteria->compare('floor_area', $this->floor_area, true);
        $criteria->compare('listing_description', $this->listing_description, true);
        $criteria->compare('furnished', $this->furnished);
        $criteria->compare('floor', $this->floor);
        $criteria->compare('lease_term', $this->lease_term);
        $criteria->compare('of_bathrooms', $this->of_bathrooms, true);
        $criteria->compare('active_listing_options', $this->active_listing_options, true);
        $criteria->compare('remark', $this->remark, true);
        $criteria->compare('created_date', $this->created_date, true);
        $criteria->compare('listing_type', $this->listing_type);
        $criteria->compare('listing_type_transaction', $this->listing_type_transaction);
        
        // Jul 23, 2014 - ANH DUNG FIX FOR NEW SEARCH PROPERTY TYPE
        if(isset($_GET['choosetype']) && array_key_exists($_GET['choosetype'], ProPropertyType::$ARR_TYPE_SEARCH)){
            if($_GET['choosetype'] != ProPropertyType::SEARCH_ALL){
                $criteria->compare('property_type_2', $_GET['choosetype']);
            }
            if(isset($_GET['property_type_code']) && is_array($_GET['property_type_code'])){
                $criteria->addInCondition('property_type_1', $_GET['property_type_code']);
            }
        }
        // Jul 23, 2014 - ANH DUNG FIX FOR NEW SEARCH PROPERTY TYPE        
        
        $date_listed = MyFormat::dateConverDmyToYmdForSeach($this->date_listed);
        if(!empty($this->date_listed)){
            $criteria->compare('date_listed', $date_listed, true);
        }
        //add 17-08-2015 - HTram: to search by Agent Name
        if(!empty($this->agent_name)){
//            $criteria->addCondition('user.first_name like "%'.$this->agent_name.'%" OR user.last_name like "%'.$this->agent_name.'%"');
            $criteria->compare('user.full_name_for_search', $this->agent_name, true);
        }

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
           'sort' => array(
              'defaultOrder' => array(
                 'date_listed' => 'DESC'
              ),
           ),              
            'pagination' => array(
                'pageSize' => 20,
            ),
        ));
    }
    
    /**
     * @Author: ANH DUNG Aug 05, 2014
     */
    public function SearchCompanyBE() {
        $cRole = Yii::app()->user->role_id;
        $cUid = Yii::app()->user->id;
        $criteria = new CDbCriteria;
        $company_listing_type = 1 ;
        if(isset($_GET['company_listing_type']) && $_GET['company_listing_type'] == 2){
            $company_listing_type = 2;
        }
        $criteria->compare('t.company_listing_type', $company_listing_type);// Immediate or Follow up
        $criteria->compare('t.status', $this->status);// active inactive listing trong admin
        $criteria->compare('t.property_name_or_address', $this->property_name_or_address, true);
        $criteria->compare('t.keywordsearch', $this->keywordsearch, true);
        $criteria->compare('t.property_type_1', $this->property_type_1);
		if ( is_array($this->location_id) && $this->location_id ) {
	        $criteria->addInCondition('t.location_id', $this->location_id);
		}
        $criteria->compare('t.property_type_2', $this->property_type_2);
        $criteria->compare('t.listing_description', $this->listing_description, true);
        $criteria->compare('t.listing_type', $this->listing_type); // sale / rent
        $criteria->compare('t.listing_type_transaction', ProTransactionsPropertyDetail::VAR_COMPANY);        
        if(trim($this->company_listing_keywordsearch) != ""){
            $criteria->compare('CONCAT( t.property_name_or_address, " ",  t.company_owner_name) ', $this->company_listing_keywordsearch, true);
        }
		$criteria->compare('t.user_id', $this->user_id);
        // Jan 23, 2015 limit Telemarketer should see their own immediate and follow-up listing only. Listing of other telemarketers should be hidden.
         if($cRole != ROLE_ADMIN && (Yii::app()->user->id !=ID_USER_SHOW_FULL_LISTING_1 && Yii::app()->user->id !=ID_USER_SHOW_FULL_LISTING_1  )){
            $criteria->compare('t.user_id', $cUid);
        }
        // Jan 23, 2015 limit Telemarketer should see their own immediate and follow-up listing only. Listing of other telemarketers should be hidden.        
        
        if($cRole == ROLE_TELEMARKETER){
            $criteria->addCondition('t.company_listing_status<>'.Listing::DELETE);
        }

//        $criteria->addInCondition('t.location_id', ProAgentDistrict::GetByAgentId(Yii::app()->user->id));
        $dnc_expiry_date = MyFormat::dateConverDmyToYmdForSeach($this->dnc_expiry_date);
        if(!empty($this->dnc_expiry_date))
            $criteria->compare('t.dnc_expiry_date', $dnc_expiry_date);
        
        $pageSize =  Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);
        if(isset($_GET['pageSize']) && !empty($_GET['pageSize']))
            $pageSize = (int)$_GET['pageSize'];
        
        $_SESSION['data-excel'] // for retrive all items
		 = new CActiveDataProvider($this, array(
                        'pagination'=>false,
			'criteria'=>$criteria,
		));
        $_SESSION['data_excel_company_listing_type'] = $company_listing_type;
        
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
           'sort' => array(
              'defaultOrder' => array(
                 'id' => 'DESC'
              ),
           ),              
            'pagination' => array(
                'pageSize'=> $pageSize,
            ),
        ));
    }
    
    public function searchCompanyListing() {
        $criteria = new CDbCriteria;
        if(trim($this->company_listing_keywordsearch) != ""){
            $criteria->with     = array('rUser');
            $criteria->together = true;
            $criteria->compare('CONCAT( t.property_name_or_address, " ",CONCAT( rUser.first_name, " ",rUser.last_name)) ', $this->company_listing_keywordsearch, true);
        }

        if ($this->price) {
			$criteria->addCondition('t.price <= :price');
			$criteria->params[':price'] = $this->price;
		}
		
		$criteria->compare('t.user_id', $this->user_id);
        $criteria->compare('t.status', $this->status);// active inactive listing trong admin
        $criteria->compare('t.status_approve', $this->status_approve); // 0:  pending aprrove , 1: admin approve : 2 : pending remove
        $criteria->compare('t.property_name_or_address', $this->property_name_or_address, true);
        $criteria->compare('t.postal_code', $this->postal_code, true);
        $criteria->compare('t.property_type_1', $this->property_type_1);
        $criteria->compare('t.property_type_2', $this->property_type_2);
        $criteria->compare('t.of_bedroom', $this->of_bedroom, true);
        $criteria->compare('t.floor_area', $this->floor_area, true);
        $criteria->compare('t.listing_description', $this->listing_description, true);
        $criteria->compare('t.listing_type', $this->listing_type);
        $criteria->compare('t.listing_type_transaction', ProTransactionsPropertyDetail::VAR_COMPANY);
        $criteria->compare('t.company_listing_status', Listing::STATUS_COMPANY_AVAILABLE);
		$criteria->compare('t.location_id', $this->location_id);
        $criteria->compare('t.company_listing_type', Listing::COMPANY_IMMEDIATE);// Immediate or Follow up
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
           'sort' => array(
              'defaultOrder' => array(
                 'id' => 'DESC'
              ),
           ),              
            'pagination' => array(
                'pageSize' => 20,
            ),
        ));
    }

    public function behaviors() {
        return array(
            'sluggable' => array(
                'class' => 'application.extensions.mintao-yii-behavior-sluggable.SluggableBehavior',
                'columns' => array('property_name_or_address'),
				'update' => false,
            ),
        );
    }

    /**
     * <Jason>
     * @return type
     */
    public static function seachAllListingDaskboard() {
        $criteria = new CDbCriteria;
        $criteria->compare('t.status_listing', STATUS_ACTIVE);
        $criteria->compare('t.status', STATUS_ACTIVE);

        return Listing::model()->findAll($criteria);
    }

    //HThoa
    public static function seachAll($data = null) {
        $criteria = new CDbCriteria;
        $criteria->compare('t.status', STATUS_ACTIVE);
        if ($data != null) {
            if (isset($data['listing'])) {
                $criteria->compare('t.listing_type', $data['listing']);
            }
            if (isset($data['property_type'])) {
                $criteria->compare('t.listing_type', $data['listing']);
            }
            if (isset($data['location'])) {
                $criteria->compare('t.location', $data['location']);
            }
        }
        return new CActiveDataProvider('Listing', array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 2,
            ),
        ));
    }

    public static function getListType($type = NULL) {
        $arrType = array(1 => 'For Rent', 2 => 'For Sale');
        if (empty($type)) {
            return $arrType;
        } else {
            if (array_key_exists($type, $arrType)) {
                return $arrType[$type];
            }
        }
    }

    public static function getFurnished($key = null) {
        $data = array(1 => 'Unfurnished', 2 => 'Partially Furnishe', 3 => ' Fully Furnished');
        if (!empty($key)) {
            if (array_key_exists($key, $data))
                return $data[$key];
            return null;
        }
        return $data;
    }

    public static function getformatPrice($value) {
        $arr = explode('.', $value);
        return $arr[0];
    }

    public static function getPropertyName($id) {
        $criteria = new CDbCriteria;
        $criteria->compare('t.id', $id);
        $result = Listing::model()->find($criteria);
        if (!empty($result)) {
            return $result->property_name_or_address;
        } else {
            return '';
        }
    }

    /*
     * dtoan
     * save orther table step2
     */

    public static function saveTableStep2($model, $col, $table, $columtable) {
        if (isset($model->$col)) {

            $data = json_decode($model->$col, true);
            if (is_array($data) && count($data) > 0) {
                //delete data old
                $table = call_user_func(array($table, 'model'));
                $table->deleteAllByAttributes(array('listing_id' => $model->id));

                foreach ($data as $value) {
                    $modelOrther = new $table;
                    $modelOrther->listing_id = $model->id;
                    $modelOrther->$columtable = $value;
                    $modelOrther->save();
                }
            }
        }
    }

    public static function getDropdownlistWithTableName($table, $key, $value, $needMore=array()) {
        $table = call_user_func(array($table, 'model'));
        $criteria = new CDbCriteria();
        if(isset($needMore['order'])){// ANH DUNG
            $criteria->order = $needMore['order'];
        }
        $model = $table->findAll($criteria);
        if ($model) {
            return CHtml::listData($model, $key, $value);
        }
        return array();
    }

    public static function validateFileUpload($file, $attribute, $type) {

        if ($type = 'image') {
            $mime = array('jpg', 'gif', 'png', 'jpeg');
        }

        if ($type = 'file') {
            $mime = array(
                'doc' => 'application/msword',
                'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                'xls' => 'application/vnd.ms-excel',
                'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'txt' => 'text/plain'
            );
        }



        if ($file["error"][$attribute][0] > 0) {
            return "File error ";
        } else {
            $type = explode("/", $file["type"][$attribute][0]);
            $size = $file["size"][$attribute][0];
            $errType = 'File is not allowed';
            $errMaxFile = 'The file was larger than ' . (ActiveRecord::getMaxFileSize() / 1024) . ' KB. Please upload a smaller file.';

            if ($type == 'image') {
                if (!in_array(strtolower($type[1]), $mime))
                    return $errType;
            }
            if ($type == 'file') {
                if (!in_array($type[1], $mime))
                    return $errType;
            }

            if ($size > ActiveRecord::getMaxFileSizeImage())
                return $errMaxFile;
        }
    }

    /*
     * dtoan
     */

    public static function activeLisingOptions($key = NULL) {
        $arrData = array(
            1 => 'I confirm the listing details and photos describe the property accurately.',
            2 => 'I confirm I have obtained agreement from the client to advertise the property.',
            3 => 'I confirm this is a direct Listing',
        );
        if (empty($key))
            return $arrData;
        else if (isset($arrData[$key]))
            return $arrData[$key];
    }

    /*
     * DTOAN
     */

    public static function getDefaultImgListing($listingId, $field = NULL) {
        $model = ProListingPhotos::model()->findByAttributes(array('listing_id' => $listingId, 'default' => 1));
        if ($model) {
            if (empty($field))
                return $model;
            else
                return $model->$field;
        }
    }

    public static function GetTakeoff($key = null) {
        $arr = array(0 => 'No', 1 => 'Yes');
        if (empty($key))
            return $arr;
        else {
            if (isset($arr[$key]))
                return $arr[$key];
        }
    }

    /**
     * @Author: ANH DUNG Apr 07, 2014
     * <Edit By Jason>
     * @Todo: search at index page
     */
    public static function searchAtIndex() {
        $criteria = new CDbCriteria;

        self::AddConditionListingShow($criteria);

        if (isset($_GET['choosetype']) && $_GET['choosetype'] != ProPropertyType::SEARCH_ALL ) {
            $criteria->compare('t.property_type_2', (int) $_GET['choosetype']);
        }
        
        if (isset($_GET['property_type_code']) && is_array($_GET['property_type_code']) ) {
            $criteria->addInCondition('t.property_type_1', $_GET['property_type_code']);
        }

        if (isset($_GET['building']) && !empty($_GET['building'])) {
			$building = $_GET['building'];
            $criteria->addCondition("t.building_name LIKE :building");
			$criteria->params[':building'] = $building;
        }
		
        if (isset($_GET['minimum_price']) && !empty($_GET['minimum_price'])) {
            $criteria->addCondition("t.price >= " . (double) $_GET['minimum_price']);
        }
        if (isset($_GET['maximum_price']) && !empty($_GET['maximum_price'])) {
            $criteria->addCondition("t.price <= " . (double) $_GET['maximum_price']);
        }
        if (isset($_GET['minimum_bedroom']) && !empty($_GET['minimum_bedroom'])) {
            $criteria->addCondition("t.of_bedroom >= " . (double) $_GET['minimum_bedroom']);
        }

        if (isset($_GET['location']) && !empty($_GET['location'])) {
            $aListId = array();
            foreach ($_GET['location'] as $value) {
                $aListId[$value] = $value;
            }

            if (count($aListId)) {
                $criteria->addInCondition("t.location_id", $aListId);
            }
        }
        
        if (isset($_GET['furnishing_include']) && is_array($_GET['furnishing_include'])) {
            $aListId = ProListingFurnishingIncluded::getArrListingId($_GET['furnishing_include']);
            if (count($aListId)) {
                $criteria->addInCondition("t.id", $aListId);
            }
        }

        if (isset($_GET['maximum_bedroom']) && !empty($_GET['maximum_bedroom'])) {
            $criteria->addCondition("t.of_bedroom <= " . (double) $_GET['maximum_bedroom']);
        }
        if (isset($_GET['minimum_floor']) && !empty($_GET['minimum_floor'])) {
            $criteria->addCondition("t.floor_area_sqft >= " . (double) $_GET['minimum_floor']);
        }
        if (isset($_GET['maximum_floor']) && !empty($_GET['maximum_floor'])) {
            $criteria->addCondition("t.floor_area_sqft <= " . (double) $_GET['maximum_floor']);
        }
//        if (isset($_GET['tenure']) && !empty($_GET['tenure'])) {
//            // update soon
//            $criteria->compare('t.tenure', ActiveRecord::safeField($_GET['tenure']), true);
//        }
        
        if (isset($_GET['keywords']) && !empty($_GET['keywords'])) {
            $criteria->compare('t.keywordsearch', ActiveRecord::safeField($_GET['keywords']), true);
        }
        
        if (isset($_GET['LeaseTerm']) && !empty($_GET['LeaseTerm'])) {
            $criteria->compare('t.lease_term', ActiveRecord::safeField($_GET['LeaseTerm']));
        }
        
        if (isset($_GET['furnished']) && !empty($_GET['furnished'])) {
            $criteria->compare('t.furnished', ActiveRecord::safeField($_GET['furnished']));
        }

        if (isset($_GET['minimum_psf']) && !empty($_GET['minimum_psf'])) {
            $criteria->addCondition("t.search_psf >= " . (double) $_GET['minimum_psf']);
        }
        if (isset($_GET['maximum_psf']) && !empty($_GET['maximum_psf'])) {
            $criteria->addCondition("t.search_psf <= " . (double) $_GET['maximum_psf']);
        }

//        if (isset($_GET['minimum_constructed']) && !empty($_GET['minimum_constructed'])) {
//            $criteria->addCondition("t.constructed >= " . (double) $_GET['minimum_constructed']);
//        }
//        if (isset($_GET['maximum_constructed']) && !empty($_GET['maximum_constructed'])) {
//            $criteria->addCondition("t.constructed <= " . (double) $_GET['maximum_constructed']);
//        }

        if (isset($_GET['option']) && !empty($_GET['option'])) {
            foreach ($_GET['option'] as $key => $value) {
                if ($value == 1) { //With photos only
                    //Listing
                    $aListingId = ProListingPhotos::getListListingId();

                    if (count($aListingId)) {
                        $criteria->addInCondition("t.id", $aListingId);
                    }
                } elseif ($value == 2) { //With floor plan ( floor > 1)
                    $criteria->addCondition("t.floor_area > " . 1);
                }
            }
        }

        if (isset($_GET['listed_on']) && !empty($_GET['listed_on'])) {
            $currDate = date('Y-m-d');
            switch ($_GET['listed_on']) {
                case 1:
                    $currDate = date('Y-m-d', strtotime("$currDate -3 days"))." 00:00:00";
                    $criteria->addCondition("t.date_listed > '$currDate'" );
                    break;
                case 2:
                    $currDate = date('Y-m-d', strtotime("$currDate -7 days"))." 00:00:00";
                    $criteria->addCondition("t.date_listed > '$currDate'" );
                    break;
                case 3:
                    $currDate = date('Y-m-d', strtotime("$currDate -14 days"))." 00:00:00";
                    $criteria->addCondition("t.date_listed > '$currDate'" );
                    break;
                case 4:
                    $currDate = date('Y-m-d', strtotime("$currDate -30 days"))." 00:00:00";
                    $criteria->addCondition("t.date_listed > '$currDate'" );
                    break;
            }
        }


        if ((isset($_GET['listing_type']) && $_GET['listing_type'] == 'sale' ) ||
                ( isset($_GET['listing_for']) && $_GET['listing_for'] == 'for_sale')
        ) {
			$criteria->compare('t.listing_type', Listing::FOR_SALE);
        } else {            
            $criteria->compare('t.listing_type', Listing::FOR_RENT);
        }
        
        // to get only company listing
        $criteria->addCondition('t.user_id IS NOT NULL AND t.user_id>0');

        $mListing = new Listing();
        /*         * * sort ** */
        $defaultSort = explode('.', Listing::DEFAULT_SORT_BY);
        $criteria->order = implode(' ', $defaultSort);

        /*         * * for sort at search form ** */
        if (isset($_GET['s_sort']) && !empty($_GET['s_sort'])) { // check valid $_GET['sort']
            $sSort = explode('.', $_GET['s_sort']); // $_GET['sort'] = name.desc
            if (count($sSort) == 2) {
                if ($mListing->hasAttribute($sSort[0]) && in_array($sSort[1], self::$aDirectionSort)) {
                    $criteria->order = implode(' ', $sSort);
                }
            }
        }
        /*         * * for sort at search form ** */

        if (isset($_GET['sort']) && !empty($_GET['sort'])) { // check valid $_GET['sort']
            $sSort = explode('.', $_GET['sort']); // $_GET['sort'] = name.desc
            if (count($sSort) == 2) {
                if ($mListing->hasAttribute($sSort[0]) && in_array($sSort[1], self::$aDirectionSort)) {
                    $criteria->order = implode(' ', $sSort);
                }
            }
        }
        /*         * * sort ** */

        /*         * * pageSize ** */
        $itemPerPage = Listing::DEFAULT_ITEM_PERPAGE;
        if (isset($_GET['pageSize'])) {
            $itemPerPage = (int) $_GET['pageSize'];
        }

        /*         * * pageSize ** */
        return new CActiveDataProvider('Listing', array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => $itemPerPage,
            ),
        ));
    }

    /**
     * @Author: TOAN Apr 25, 2014
     * @Todo: lấy điều kiện để show listing ra ngoài index fe
     */
    public static function AddConditionListingShow(&$criteria) {
        $criteria->compare('t.status', STATUS_ACTIVE);
        $criteria->compare('t.status_listing', STATUS_LISTING_ACTIVE);
    }

    public static function getViewStatus($status, $default = STATUS_LISTING_ACTIVE) {

        $arrStatus = array(
            STATUS_LISTING_ACTIVE => 'active',
            STATUS_LISTING_PENDING => 'pending',
            STATUS_LISTING_REJECTED => 'rejected',
            STATUS_LISTING_DRAFT => 'draft',
            STATUS_LISTING_PAST => 'past',
        );

        if (isset($arrStatus[$status]))
            return $arrStatus[$status];
        return $arrStatus[$default];
    }

    //Kvan
    public static function getListingByArrId($arrId) {
        if (!empty($arrId)) {
            $criteria = new CDbCriteria;
            $criteria->compare('t.status', STATUS_ACTIVE);
            $criteria->addInCondition('t.id', $arrId);
            return new CActiveDataProvider('Listing', array(
                'criteria' => $criteria,
                'pagination' => array(
                    'pageSize' => 10,
                ),
            ));
        }
        else
            return array();
    }

    public function beforeDelete() {

        //delete all photo
        $allphoto = ProListingPhotos::model()->findAllByAttributes(array('listing_id' => $this->id));
        if ($allphoto) {
            foreach ($allphoto as $photo) {
                if ($photo->delete())
                    ProListingPhotos::removePhoto($photo);
            }
        }
        //delete all doc 
        $allDoc = ProListingUploadCea::model()->findAllByAttributes(array('listing_id' => $this->id));
        if ($allDoc) {
            foreach ($allDoc as $doc) {
                if ($doc->delete())
                    ProListingUploadCea::removefileDoc($doc);
            }
        }

        return parent::beforeDelete();
    }

    public static function getCurrentStep($model, $module = "member", $stepIndex) {
        if (!$model->isNewRecord) {
            $action = Yii::app()->controller->action->id;
            $current_step_next = $model->current_step_next;
            if ($current_step_next != strtolower($action)) {
                $arrAction = array(
                    1 => 'create',
                    2 => 'extradetail',
                    3 => 'managephotos',
                    4 => 'confrimations',
                );

                if (isset($arrAction[$current_step_next])) {
//                     if(!$model->isNewRecord){
//                         if($model->status_listing != STATUS_LISTING_PENDING || $model->status_listing != STATUS_LISTING_DRAFT ){
//                             Yii::app()->request->redirect(Yii::app()->createAbsoluteUrl("member/dashboard"));
//                         }
//                     }
                    if ($stepIndex > $current_step_next) {
                        Yii::app()->request->redirect(Yii::app()->createAbsoluteUrl("$module/listing/" . $arrAction[$current_step_next], array('id' => $model->id)));
                    }
                }
            }
        }
    }

    public function activate() {
        $this->status = 1;
        $this->update();
    }

    public function deactivate() {
        $this->status = 0;
        $this->update();
    }

    public static function getAddressListing($slug) {
        $criteria = new CDbCriteria;
        $criteria->compare('t.property_name_or_address', trim($slug), true);
        $criteria->compare('t.status', STATUS_ACTIVE);
        $criteria->compare('t.status_listing', STATUS_LISTING_ACTIVE);
        return new CActiveDataProvider('Listing', array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 10,
            ),
        ));
    }
    
    public static function getSalespersonListing(&$name) {
        $slug = isset($_GET['slug'])?$_GET['slug']:'';
        $mUser = Users::findBySlug($slug);
        $criteria = new CDbCriteria;
        if($mUser){
            $name = $mUser->first_name." ".$mUser->last_name;
            $criteria->compare('t.user_id', $mUser->id);
        }
        $criteria->compare('t.status', STATUS_ACTIVE);
        $criteria->compare('t.status_listing', STATUS_LISTING_ACTIVE);
        return new CActiveDataProvider('Listing', array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 24,
            ),
        ));
    }

    public static function findBySlug($slug) {
        $criteria = new CDbCriteria;
        $criteria->compare('slug', $slug);
        $criteria->compare('t.status', STATUS_ACTIVE);
        $criteria->compare('t.status_listing', STATUS_LISTING_ACTIVE);
        $model = static::model()->find($criteria);
        return $model;
    }
    
    // ANH DUNG - để cập nhật 1 số field giúp listing active luôn, không qua pending nữa
    public static function SetActiveListing($model){
        $model->status_listing = STATUS_LISTING_ACTIVE;
        $model->status_approve = STATUS_ADMIN_APPROVE;
        if(is_null($model->date_listed))
            $model->date_listed = date('Y-m-d h:i:s');
    }
    
    // ANH DUNG - để cập nhật status listing qua past khi tạo thành công transaction
    public static function SetStatusPastListing($pk){
        $model = self::model()->findByPk($pk);
        if($model){
            $model->status_listing = STATUS_LISTING_PAST;
            $model->scenario = null;
            $model->update(array('status_listing'));
        }
    }
    
    /**
     * @Author: ANH DUNG Aug 13, 2014
     * @Todo: update status company listing
     * FE - This company listing X will be taken out 
     * from the company listing in salesperson portal. with first transaction admin approved
     * @Param: $pk primary key of company listing
     * @Return: not
     */
    public static function SetStatusCloseForCompanyListing($pk){
        $model = self::model()->findByPk($pk);
        if($model){
            if($model->company_listing_status != Listing::STATUS_COMPANY_CLOSED && $model->company_listing_status != Listing::STATUS_COMPANY_DELETE){
                $model->company_listing_status = Listing::STATUS_COMPANY_CLOSED;
                $model->scenario = null;
                $model->update(array('company_listing_status'));
            }
        }
    }
    
    // ANH DUNG - để cập nhật status listing qua ACTIVE khi user click repost từ tab past
    public static function SetStatusActiveListing($pk){
        $model = self::model()->findByPk($pk);
        if($model){
            $model->status_listing = STATUS_LISTING_ACTIVE;
            $model->date_listed = date('Y-m-d h:i:s');
            $model->update(array('status_listing', 'date_listed'));
        }
    }
    
    /**
     * @Author: ANH DUNG Feb 10, 2015
     * @Todo: SetStatusActiveListingRelisted
     */
    public static function SetStatusActiveListingRelisted($pk){
        $model = self::model()->findByPk($pk);
        if($model){
            $model->status_listing = STATUS_LISTING_ACTIVE;
            $model->re_listed_date = date('Y-m-d H:i:s');
            $model->re_listed_count += 1;
            $model->date_listed = date('Y-m-d H:i:s');
            $model->update(array('date_listed', 'status_listing', 're_listed_date', 're_listed_count'));
        }
    }    
    
    // ANH DUNG - để cập nhật status listing qua ACTIVE khi user click repost từ tab past
    public static function UserPostCompanyListing($pk){
        $model = self::model()->findByPk($pk);
        if($model){
            $model->user_id = Yii::app()->user->id;
            $model->update(array('user_id'));
        }
    }    
    
    // ANH DUNG - FOR beforeSave listing
    public static function getFloorSizeSqft($model){
        /// ANH DUNG ADD Sep 08, 2014 theo BDung 2. nêu floor area bằng 0 thì lấy land area
       // if(empty($model->floor_area) || $model->floor_area<1 || is_null($model->floor_area)){
       //     $model->floor_area = $model->land_area;
       // }
       /// ANH DUNG ADD Sep 08, 2014 theo BDung 2. nêu floor area bằng 0 thì lấy land area
        
       $model->floor_area_sqft = $model->floor_area;
       if($model->floor_area_unit==Listing::FLOOR_UNIT_SQM){
           $model->floor_area_sqft = $model->floor_area*Yii::app()->params['unit_sqm_sqft'];
       }
       
    }
    // ANH DUNG - FOR beforeSave listing individual Search PSF trong Refine search, 
    // PSF cua listing la bang Price/Area Floor, neu khong co Area Floor thi chia cho land
    public static function setSearchPsf($model){
        $model->search_psf = 0;
        if($model->land_area!=0){
          $model->search_psf = $model->price/$model->land_area;  
        }
        if($model->floor_area_sqft!=0){
          $model->search_psf = $model->price/$model->floor_area_sqft;  
        } 
        $model->search_psf = round($model->search_psf,2);
    }
    
    // ANH DUNG - FOR beforeSave listing
    // Jan 22, 2015 chỗ này hôm nay xem lại chưa rõ lắm là nó lưu để làm gì
    // cột này định làm id của admin telemarketer tạo companylisting trong BE, 
    // khi saleperson pick cái companylisting đó để tạo lising cho mình thì sẽ lưu cái đó lại
    public static function getAdminId($model){
       if(!isset($_GET['id']) && Yii::app()->controller->module->id=='admin')
       {
            $model->user_id_admin = Yii::app()->user->id;
       }
    }
    
    /**
     * PHAM DUY TOAN
     *
     * Email : ghostkissboy12@gmail.com
     */
    public  function comparePostalcode($attribute, $params){
        if($this->company_listing_id ==''){
            $where = array(
                    'listing_type_transaction'=>ProTransactionsPropertyDetail::VAR_COMPANY,
                    'postal_code'=>$this->postal_code,
            );
            if(!$this->isNewRecord)  $where['id']='<>'.$this->id;
            $result = Listing::model()->countByAttributes( $where);
            if($result>0){
                $this->addError('postal_code','Postal code already existed in our system. Please enter a different postal code.');
            }
        }
    }
        
    
    /**
     * @Author: ANH DUNG Sep 18, 2014
     */
    protected function beforeValidate() {
        $this->price = str_replace(",", "", $this->price);
        self::HandleUniquePostalcode($this);
        return parent::beforeValidate();
    }
    
    /**
     * @Author: ANH DUNG Jan 29, 2015
     * @Todo: handle unique postal_code in create, update company listing
     * @Param: $model model Listing
     * at scenario CreateListingCompany,UpdateListingCompany
     */
    public static function HandleUniquePostalcode($model) {
        $aScenarioCheck = array('CreateListingCompany', 'UpdateListingCompany');
        if( in_array($model->scenario, $aScenarioCheck) ){
            $validator = CValidator::createValidator('unique', $model, 'postal_code', array(
                'criteria' => array(
                    'condition'=>'`listing_type_transaction`=:secondKey  '
                    . ' AND `unit_from`=:threeKey '
                    . ' AND `unit_to`=:fourKey',
                    'params'=>array(
                        ':secondKey'=> ProTransactionsPropertyDetail::VAR_COMPANY,
                        ':threeKey'=>$model->unit_from,
                        ':fourKey'=>$model->unit_to,
                    )
                ),
                'message'=> "Postal code and unit already existed in our system. Please enter a different postal code."
            ));
            $model->getValidatorList()->insertAt(0, $validator); 
        }
    }
    
    /**
     * @Author: ANH DUNG Sep 18, 2014
     * @params: $model model Listing
     * remove .00 for price when load for update 
     */
    public static function FormatPriceFromDb($model){
        $model->price = str_replace(".00", "", $model->price);
    }

    public function beforeSave() {
		$this->dnc_expiry_date = MyFormat::dateConverDmyToYmd($this->dnc_expiry_date);
        $this->keywordsearch = $this->saveKeywordSearch();        
        // Aug 02, 2014 ANH DUNG add
        if($this->listing_type_transaction ==  ProTransactionsPropertyDetail::VAR_COMPANY){
            // do some action for company listing
            self::GetInfoMapAd($this);
            return parent::beforeSave();
        }
        
        if(!empty($this->company_listing_id) && $this->company_listing_id>0 ){
            $this->listing_type_transaction = ProTransactionsPropertyDetail::VAR_INDIVIDUAL_FROM_COMPANY;
        }
        // Aug 02, 2014 ANH DUNG add
        
        // Jun 02, 2014 ANH DUNG add
        self::getFloorSizeSqft($this);
        self::getAdminId($this);
        self::setSearchPsf($this);
        // Jun 02, 2014 ANH DUNG add
        
        if (in_array($this->scenario, Listing::$AllScenarioStep1) ) { // ANH DUNG FIX Jul 01, 2014
//        if (0) { // ANH DUNG FIX Jul 01, 2014
            self::GetInfoMapAd($this);
        } // end if ($this->scenario == 'create_listing_step4' || $this->

		$this->company_listing_id = (int)$this->company_listing_id;
		$this->office_bkank_valuation = (float)$this->office_bkank_valuation;
        return parent::beforeSave();
    }
    
    /**
     * @Author: ANH DUNG Aug 04, 2014
     * @Todo: get some info of map
     * @Param: $model model 
     */




    public static function findDistance($x1, $x2, $y1, $y2) {
        $lon2 = $x2 * (M_PI/180);
        $lon1 = $x1 * (M_PI/180);
        $lat2 = $y2 * (M_PI/180);
        $lat1 = $y1 * (M_PI/180);
        $dlon = $lon2 - $lon1; 
        $dlat = $lat2 - $lat1; 
        $a = ((sin($dlat/2))*(sin($dlat/2))) + cos($lat1) * cos($lat2) * ((sin($dlon/2)) * (sin($dlon/2))) ;
        $c = 2 * atan2( sqrt($a), sqrt(1-$a) ); 
        $d = round(6373 * $c, 2);
        return $d;
    }

    public static function GetInfoMapAd($model){
        /* ---------------------------------------------------
         * DTOAN
         * ADD LOCATION
         * lay 2 so dau
         * --------------------------------------------------
         */
        if (!empty($model->postal_code)) {
            $postaCode = substr($model->postal_code, 0, 2);
            $checkLocation = ProLocation::model()->find("t.postal_code like '%$postaCode%'");
            if ($checkLocation && isset($checkLocation->id))
                $model->location_id = $checkLocation->id;
        }

//        if ($model->map_config_distance != Yii::app()->params['distance']) {
        $position = explode('-', $model->postal_code_xy);
        if (count($position) == 2) {
            $dist   = Yii::app()->params['distance'];
            $limit  = Yii::app()->params['limit_result'];
            $long   = $position[0];
            $lat    = $position[1];


            $mrt_distance = array();
            $mrt = ApiNearRmt::model()->findAll();
            foreach ($mrt as $item) {
                $tmp = Listing::findDistance($long, $item->long_street, $lat, $item->lat_street);
                if($tmp<=$dist){
                    $mrt_distance[$item->id]['v'] = $item->name . "($tmp Km)";
                    $mrt_distance[$item->id]['x'] = $item->long_street;
                    $mrt_distance[$item->id]['y'] = $item->lat_street;
                }
            }  

            //near school
            $school_distance = array();
            $school = ApiNearSchool::model()->findAll();
            foreach ($school as $school_item) {
                $tmp =  Listing::findDistance($long, $school_item->long_street, $lat, $school_item->lat_street);
                if($tmp<=$dist){
                    $school_distance[$school_item->id]['v'] = $school_item->name . "($tmp Km)";
                    $school_distance[$school_item->id]['x'] = $school_item->long_street;
                    $school_distance[$school_item->id]['y'] = $school_item->lat_street;
                }
            } 


            //building nam
            $building_distance = array();
            $allBuilding = ApiBuilding::model()->findAll();

            foreach ($allBuilding as $building) {
                $tmp =  Listing::findDistance($long, $building->long_street, $lat, $building->lat_street);
                if($tmp<=$dist){
                    $name =substr($building->building,6, 45);
                    $building_distance[$building->id]['v'] = $name . "($tmp Km)";
                    $building_distance[$building->id]['x'] = $building->long_street;
                    $building_distance[$building->id]['y'] = $building->lat_street;
                }
            } 


        /*  
            51 => 'Nearest MRT Stations',
            23 => 'Nearest Schools'
            1093 => 'Nearest Building',
            'car' => 'Nearest bus stop',
        */




            //$nearBy = @file_get_contents('http://www.streetdirectory.com/api/?mode=tips&act=nearby&output=json&x=' . trim($position[0]) . '&y=' . trim($position[1]) . '&dist=' . $dist . '&start=0&limit=' . $limit . '&country=sg');
/*            $link = 'http://www.streetdirectory.com/api/?mode=tips&act=nearby&output=json&x=' . trim($position[0]) . '&y=' . trim($position[1]) . '&dist=' . $dist . '&start=0&limit=' . $limit . '&country=sg';
            $ch = curl_init();
            $domain = $_SERVER["HTTP_HOST"];
            curl_setopt($ch, CURLOPT_URL, "$link");
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, "domain=$domain");
            curl_setopt($ch, CURLOPT_HEADER, 0);
            $nearBy = curl_exec($ch);

            $arrCat = Listing::$nearBy;
            $data   = json_decode($nearBy, true);
            $dataCat = array();
            if (is_array($data) && count($data) > 0) {
                foreach ($data as $item) {
                    if (isset($item['cat']) && isset($arrCat[$item['cat']])) {
                        $dataCat[$item['cat']][] = $item;
                    }
                }
            }*/

            $dataCat[51] = $mrt_distance; 
            $dataCat[23] = $school_distance; 
            $dataCat[1093]  = $building_distance;
            $dataCat['car'] = array();
            
            // ANH DUNG Oct 27, 2014 tinh property_house_blk_no
            // 1. co postal code 
            // 2.  House/blk no = building Number (trong table walkup ) + 
            $model->property_house_blk_no = self::getHouseBlkNo($model->postal_code);
            $model->property_street_name = self::getStreetName($model->postal_code);

            $model->map_config_distance = $dist;
            $model->map_config_result = $limit;
            $model->json_map = json_encode($dataCat);
        }
    }
    
    /**
     * @Author: ANH DUNG Oct 27, 2014
     * @Todo: get property_house_blk_no
     * @Param: $postal_code
     */
    public static function getHouseBlkNo($postal_code) {
        $property_house_blk_no = '';
        if(trim($postal_code) !='' ){
            $building_number = ApiPostcode::getValueKeyByPostalCode($postal_code, 'building_number');
            $property_house_blk_no = ApiWalkup::getValueKeyByBuildingNumber($building_number, 'building_number');
        }
        return $property_house_blk_no;
    }
    
    /**
     * @Author: ANH DUNG Oct 27, 2014
     * @Todo: get property_house_blk_no
     * @Param: $postal_code
     */
    public static function getStreetName($postal_code) {
        $property_street_name = '';
        if(trim($postal_code) !='' ){
            $street_key = ApiPostcode::getValueKeyByPostalCode($postal_code, 'street_key');
            $property_street_name = ApiStreets::getValueKeyByStreetKey($street_key, 'street_name');
        }
        return $property_street_name;
    }

    public static function countListingWithStatusLisitng($status, $userId) {
        $listing = Listing::model()->countByAttributes(array('status_listing' => $status, 'user_id' => $userId));
        return $listing;
    }
    public static function getSpecial_features_And_Outdoor_indoor_space($listingId){
        $special = Listing::getDropdownlistWithTableName('ProMasterSpecialFeatures', 'name','name');
        $outdoor = Listing::getDropdownlistWithTableName('ProMasterOutdoorIndoorSpace', 'name','name');
        $arrMarge = array_merge($special,$outdoor);
        if(count($arrMarge)>0){
            $data = array();
            $k=1;
            foreach ($arrMarge as $value){
                if($k%2 !=0){
                    $data['colum1'][$value] = $value;
                }else {
                    $data['colum2'][$value] = $value;
                }
                $k++;
            }
            return $data;
        }
        return null;
    }
    
    public function saveKeywordSearch(){
        if($this->listing_type_transaction ==  ProTransactionsPropertyDetail::VAR_COMPANY){
            $res = Listing::$aTextSaleRentNormal[$this->listing_type] . " $this->location_id $this->company_owner_name $this->contact_name_no";            
            return $res;
        }
        $data['PROPERTYNAME']  = $this->property_name_or_address;
        $data['PROPERTYTYPE']  = ActiveRecord::getInfoRecord('ProPropertyType', $this->property_type_1,'name');
        $data['PROPERTYFLOORAREA']  = $this->floor_area;
        $data['PROPERTYDEVELOPER']  = $this->developer;
        $data['PROPERTYPRICE']      = $this->price;
        $data['PROPERTYCONDITION']  = ActiveRecord::getInfoRecord('ProMasterFurnished', $this->furnished,'name');
        $data['PROPERTYTUNER']  = ActiveRecord::getInfoRecord('ProMasterTenure', $this->tenure,'name');
        $userInfo  = ActiveRecord::getInfoRecord('Users', $this->user_id);
        if($userInfo){
            $data['PROPERTYAGENT'] = $userInfo->first_name . ' '.$userInfo->last_name ;
        }
        return implode('|', $data);
    }

    /**
     * @Author: ANH DUNG Jun 26, 2014
     * @Todo: get scenario
     * @Param: $model Listing
     */
    public static function getScenarioOfListing($model){
        $res = '';
        $scenario = ProPropertyType::getScenarioGroupShow($model->property_type_2);
        if(!empty($scenario))
            $res = $scenario;
        // vì cả property_type_2 và property_type_1 đều có chưa group show scenario nên ở đây 
        // làm ưu tiên cho property_type_1
        $scenario = ProPropertyType::getScenarioGroupShow($model->property_type_1);
        if(!empty($scenario))
            $res = $scenario;
        return $res;
    }    
    
    public static function getViewDetailPrice($model){
        $res = MyFormat::formatPrice($model->price);
        $asking_price_select = isset(Listing::$ARR_PRICE_SELECT[$model->asking_price_select])?Listing::$ARR_PRICE_SELECT[$model->asking_price_select]:'';
        if($model->asking_price_select==Listing::NB_PRICE_OTHER){
            $asking_price_select = $model->asking_price_select_other;
        }
        $res .= ' ' .$asking_price_select;
        return $res;
    }    
    /**
     * @Author: ANH DUNG Jun 27, 2014
     * @Todo: get text for view detail
     * @Param: $model Listing
     */
    public static function getViewDetailHdbtow($model){
        $res = '';
        if($model->rHdbTown){
            $res = $model->rHdbTown->name;
        }
        return $res;
    }
    
    /**
     * @Author: ANH DUNG Jun 27, 2014
     * @Todo: get text for view detail
     * @Param: $model
     */
    public static function getViewDetailPropertyType($model){
        $res = '';
        if($model->rPropertyType){
            $res = $model->rPropertyType->name;
        }
        if(empty($res)){
            if($model->rPropertyType2){
                $res = $model->rPropertyType2->name;
            }
        }
        return $res;
    }
    
    /**
     * @Author: ANH DUNG Jun 27, 2014
     * @Todo: get text for view detail
     * @Param: $model
     */
    public static function getViewDetailBedRoom($model){
        $res = '';
        if(isset(Listing::$ARR_BED_ROOMS[$model->of_bedroom])){
            $res = Listing::$ARR_BED_ROOMS[$model->of_bedroom];
        }
        return $res;
    }    
    
    public static function getViewDetailBedRoomNumberOnly($model){
        $res = $model->of_bedroom;
        if($model->of_bedroom==10){
            $res = "+10";
        }
        return $res;
    }    
    
    public static function getViewDetailFloorArea($model){
        $res = MyFormat::formatPrice($model->floor_area) . ' '. Listing::$ARR_FLOOR_AREA_UNIT[$model->floor_area_unit];
        return $res;
    }    
    public static function getViewDetailLandArea($model){
        $res = MyFormat::formatPrice($model->land_area) . ' '. Listing::LAND_AREA_UNIT;
        return $res;
    }    
    public static function getViewDetailOfficialBank($model){
        $res = MyFormat::formatPrice($model->office_bkank_valuation);
        return $res;
    }    
    public static function getViewDetailTenure($model){
        $res = ActiveRecord::getInfoRecord('ProMasterTenure', $model->tenure,'name');
        return $res;
    }    
    
    /**
     * @Author: ANH DUNG Jun 27, 2014
     * @Todo: check xem field có dc hiện thị với property type đó ko
     * @Param: $model model Listing
     * @Param: $scenario rule validate
     * @Param: $fieldName 
     * @Return: true if ok, false if not ok
     */
    public static function CanView($model, $scenario, $fieldName){
        if(empty($scenario)) return false;
        return in_array($fieldName, ProPropertyType::$A_FIELD_OF_SCENARIO[$scenario]);
    }

    /**
     * @Author: ANH DUNG Aug 05, 2014
     * @Param: $listId array id
     */
    public static function GetModelByListId($listId){
        $criteria = new CDbCriteria();        
        $criteria->addInCondition('t.id', $listId);
        return self::model()->findAll($criteria);
    }
    
    /**
     * @Author: ANH DUNG Aug 05, 2014
     * @Param: $listId array id
     */
    public static function UpdateModelByListId(){
        $sql='';
        $tableName = self::model()->tableName();
        $aRowInsert=array();
        if(isset($_POST['Listing']) && is_array($_POST['Listing']['contact_name_no'])){
            foreach($_POST['Listing']['contact_name_no'] as $key=>$item){
                $id = isset($_POST['Listing']['id'][$key])?$_POST['Listing']['id'][$key]:'';
                $item = MyFormat::removeBadCharacters($item, array('RemoveScript'=>1));
                if(!empty($id)){
                    $sql .= "UPDATE $tableName SET "
                        . " `contact_name_no`=\"$item\"  "
                        . "WHERE `id`=$id ;";
                }
            }
        }
        if(trim($sql)!='')
            Yii::app()->db->createCommand($sql)->execute();
    }
    
    /**
     * @Author: ANH DUNG Aug 05, 2014
     * @Param: $listId array id
     */
    public static function UpdateDncExpiryDateByListId($listId, $dnc_expiry_date){
        $criteria = new CDbCriteria();
        $criteria->addInCondition('id', $listId);
        self::model()->updateAll(array('dnc_expiry_date'=>$dnc_expiry_date), $criteria);
    }
    
    /**
     * @Author: ANH DUNG Aug 05, 2014
     * @Param: $listId array id
     */
    public static function ChangeStatusDeleteByListId($listId){
        $criteria = new CDbCriteria();
        $criteria->addInCondition('id', $listId);
        self::model()->updateAll(array('company_listing_status'=>Listing::DELETE), $criteria);
    }
    
    /**
     * @Author: ANH DUNG Aug 05, 2014
     * @Param: $listId array id
     */
    public static function ChangeTypeByListId($listId, $company_listing_type){
        $criteria = new CDbCriteria();
        $criteria->addInCondition('id', $listId);
        self::model()->updateAll(array('company_listing_type'=>$company_listing_type), $criteria);
    }
    
    /**
     * @Author: ANH DUNG Aug 06, 2014
     * @Todo: save company listing
     * @Param: $model model Listing
     */
   public static function SaveCompanyListing($model){
       $model->last_update_time = date('Y-m-d'); 
       $model->listing_type_transaction = ProTransactionsPropertyDetail::VAR_COMPANY;
       $aAttributes = array(
           'house_blk_no','building_name','company_owner_name','contact_name_no','remark',
           'company_storey','company_utility_room','company_built_up','tenure','company_availability',
       );
       MyFormat::RemoveScriptOfModelField($model, $aAttributes);
       $model->save();
   }


   /**
    * PHAM DUY TOAN
    *
    * Email : ghostkissboy12@gmail.com
    * Check company list
    */
    public static function checkCompanyListingWithId($id, &$mListing){
        $criteria = new CDbCriteria();
        $criteria->compare('t.id', $id);
        $criteria->compare('t.listing_type_transaction', ProTransactionsPropertyDetail::VAR_COMPANY);
        $model = Listing::model()->find($criteria);
        if(is_null($model)){
            Yii::app()->request->redirect(Yii::app()->createAbsoluteUrl('/member/site/dashboard'));
        } 
        $mListing->listing_type = $model->listing_type;
        $mListing->property_name_or_address = $model->property_name_or_address;
        $mListing->postal_code = $model->postal_code;
        $mListing->postal_code_tmp = $model->postal_code_tmp;
        $mListing->postal_code_xy = $model->postal_code_xy;
        $mListing->property_type_1 = $model->property_type_1;
        $mParentPropertyType = ProPropertyType::findParentById($model->property_type_1);
        if($mParentPropertyType){
            $mListing->property_type_2 = $mParentPropertyType->id;
        }
        $mListing->price = $model->price;
        $mListing->unit_from = $model->unit_from;
        $mListing->unit_to = $model->unit_to;
        
        $mListing->floor_area = $model->floor_area;
        $mListing->company_listing_user_created = $model->user_id;
        $mListing->display_title = $model->display_title;
        $mListing->display_address = $model->display_address;
    }
        
    /**
     * @Author: ANH DUNG Aug 11, 2014
     * @Todo: ghi đè file gốc rồi resize lại
     * @Param: $model model ProListingPhotos
     */
    public static function OverideBigPhotoOfListing($model){
        $fileName = $model->image;
        $id = $model->listing_id;
        $url_download = Yii::app()->createAbsoluteUrl('/')."/upload/listing/$id/633x390/$fileName";
        $pathSaveFile = "/upload/listing/$id";
//        $pathSaveFile = "/".$fileFolder."/$fileModelId";
        MyFormat::DownloadFile($url_download, $pathSaveFile, $fileName);        
    }
    
    /**
     * @Author: ANH DUNG Aug 11, 2014
     * @Todo: ghi lại hàm resize photo listing của Dtoan
     * @Param: $model model ProListingPhotos
     */
    public static function ResizePhotoOfListing($model){
        //rezie image
        $ImageProcessing = new ImageProcessing();
        $ImageProcessing->folder = "/upload/listing/$model->listing_id";
        $ImageProcessing->file = $model->image;
        $ImageProcessing->thumbs = ProListingPhotos::$szie;
        $ImageProcessing->create_thumbs();     
    }

    /**
     * @Author: ANH DUNG Aug 12, 2014
     * @Todo: update search_psf field all lissting
     */
    public static function FixUpdateAllListing(){
        $models = self::model()->findAll();
        foreach($models as $item){
            $item->update(array('search_psf'));
        }
    }
    
    /**
     * @Author: ANH DUNG Aug 12, 2014
     * @Todo: save photo listing upload 
     * @Param: $model model 
     */
    public static function SavePhotoListing($model){
        $uid = Yii::app()->user->id;
        if(isset($_FILES['Listing']['name']['photo_listing_anhdung']) && count($_FILES['Listing']['name']['photo_listing_anhdung'])){
            $cMaxDisplay = ProListingPhotos::GetMaxDisplayOrder($model->id);
            foreach($_FILES['Listing']['name']['photo_listing_anhdung'] as $key=>$item){
                if(Listing::CountPhotoListing($model->id) >= Listing::GetLimitPhotoUpload())
                    return ;
                $mFile = new ProListingPhotos();
                $mFile->FileValidate  = CUploadedFile::getInstanceByName('Listing[photo_listing_anhdung]['.$key.']');
                $mFile->validate();
                if(!$mFile->hasErrors()){
                    $ext = $mFile->FileValidate->getExtensionName();
                    $mFile->image = $uid."-".time().ActiveRecord::randString().$key.'.'.$ext;// file name
                    $mFile->listing_id = $model->id;
                    $mFile->default = 0;
                    $mFile->display_order = ++$cMaxDisplay;
                    $mFile->save();
                    Listing::saveFile($mFile, 'FileValidate', $mFile->image);
                    Listing::ResizePhotoListing($mFile);
                    Listing::PutWarterMarkPhotoListing($mFile);
                    Listing::ResizePhotoListingSmall($mFile);
                }
            }
            Listing::AutoSetCoverPhotoListing($model->id);
        }
    }
    
    
    /**
     * @Author: ANH DUNG Jul 27, 2015
     * @Todo: resize lại photo listing if have new size
     */
    public static function FixGenNewSize() {
//        set_time_limit(72000);
//        $from = time();
        $models = ProListingPhotos::model()->findAll();
        foreach($models as $mFile){
            $sourceImage = Yii::getPathOfAlias('webroot')."/".ProListingPhotos::$folderUpload."/".$mFile->listing_id."/".$mFile->image;   
            if(file_exists($sourceImage)){
                Listing::ResizePhotoListing($mFile);
                Listing::PutWarterMarkPhotoListing($mFile);
                Listing::ResizePhotoListingSmall($mFile);
            }
        }
        
        $to = time();
        $second = $to-$from;
        echo count($models).' done in: '.($second).'  Second  <=> '.($second/60).' Minutes';die;
//        echo count($models);
    }
    
    /**
     * @Author: ANH DUNG Aug 12, 2014
     * To do: save file 
     * @param: $model 
     * @param: $fieldName 
     * @param: $count 1,2,3
     */
    public static function  saveFile($model, $fieldName, $fileName)
    {
        if(is_null($model->$fieldName)) return '';
        $pathUpload = ProListingPhotos::$folderUpload."/$model->listing_id";
        $ext = $model->$fieldName->getExtensionName();        
        $imageProcessing = new ImageProcessing();
        $imageProcessing->createDirectoryByPath($pathUpload);
        $model->$fieldName->saveAs($pathUpload.'/'.$fileName);
        $model->$fieldName->saveAs($pathUpload.'/'.ProListingPhotos::SIZE_WATER_MARK.$fileName);
//        return $fileName;
    }    
    
    /**
     * @Author: ANH DUNG Aug 12, 2014
     * @Todo: save photo listing upload 
     * @Param: $model model ProListingPhotos
     */
    public static function ResizePhotoListing($model){
        $ImageProcessing = new ImageProcessing();
        $ImageProcessing->folder = "/".ProListingPhotos::$folderUpload."/$model->listing_id";
        $ImageProcessing->file = $model->image;
        $ImageProcessing->thumbs = ProListingPhotos::$szie;
        $ImageProcessing->create_thumbs();
    }    
    
    /**
     * @Author: ANH DUNG Jan 16, 2015
     * @Todo: re resize some small photo not have water mark
     * @Param: $model model ProListingPhotos
     */
    public static function ResizePhotoListingSmall($model){
//        ProListingPhotos::RemovePhotoListingSmall($model);
//        sleep(1);
        self::RootImageClone($model);
        $NewNameImage = self::CopyImageHaveWaterMarkToRoot($model);
        $ImageProcessing = new ImageProcessing();
        $ImageProcessing->folder = "/".ProListingPhotos::$folderUpload."/$model->listing_id";
//        $ImageProcessing->file = ProListingPhotos::SIZE_WATER_MARK."/".$model->image;
        $ImageProcessing->file = $model->image;
        $ImageProcessing->thumbs = ProListingPhotos::GetSmallSizeToProcessWaterMark();
        $ImageProcessing->create_thumbs();
        self::RootImageRestore($model);
        self::DeleteTempImageClone($model);
    }
    
    /**
     * @Author: ANH DUNG Jan 16, 2015
     * @Todo: copy hình resize đã đóng watermark ra thư mục gốc để resize lần nữa
     * cho các size nhỏ mà nó không đóng được watermark
     * @Param: $model
     */
    public static function CopyImageHaveWaterMarkToRoot($model) {
        $path_from = Yii::getPathOfAlias('webroot') . '/'.ProListingPhotos::$folderUpload."/$model->listing_id/".ProListingPhotos::SIZE_WATER_MARK."/$model->image";
        $NewNameImage = ProListingPhotos::SIZE_WATER_MARK."$model->image";
        $path_to = Yii::getPathOfAlias('webroot') . '/'. ProListingPhotos::$folderUpload."/$model->listing_id/".$model->image;
        MyFormat::CopyFile($path_from, $path_to);
        return $NewNameImage;
    }
    
    /**
     * @Author: ANH DUNG Jan 16, 2015
     * @Todo: copy image root upload ra 1 file cùng thư mục rồi để chép đè 
     * hình có watermark kia lên, sau khi resize xong thì copy trả lại image root này
     * vâng xử lý rất rối vãi, hiện tại chỉ nghĩ ra được cách này, không thích kiểu này lắm nhưng vẫn doing
     */
    public static function RootImageClone($model) {
        $path_from = Yii::getPathOfAlias('webroot') . '/'.ProListingPhotos::$folderUpload."/$model->listing_id/$model->image";
        $NewNameImage = ProListingPhotos::SIZE_WATER_MARK."$model->image";
        $path_to = Yii::getPathOfAlias('webroot') . '/'. ProListingPhotos::$folderUpload."/$model->listing_id/".$NewNameImage;
        MyFormat::CopyFile($path_from, $path_to);
        return $NewNameImage;
    }
    
    /**
     * @Author: ANH DUNG Jan 16, 2015
     * @Todo: restore lại hình root 
     * belong to RootImageClone
     * @Param: $model
     */
    public static function RootImageRestore($model) {
        $NewNameImage = ProListingPhotos::SIZE_WATER_MARK."$model->image";
        $path_from = Yii::getPathOfAlias('webroot') . '/'.ProListingPhotos::$folderUpload."/$model->listing_id/$NewNameImage";
        $path_to = Yii::getPathOfAlias('webroot') . '/'. ProListingPhotos::$folderUpload."/$model->listing_id/".$model->image;
        MyFormat::CopyFile($path_from, $path_to);
    }
    
    /**
     * @Author: ANH DUNG Jan 16, 2015
     * @Todo: xóa hình tạm khi dùng để resize hình ở mấy hàm bên trên
     * @Param: $model
     */
    public static function DeleteTempImageClone($model) {
        $NewNameImage = ProListingPhotos::SIZE_WATER_MARK."$model->image";
        @unlink(YII_UPLOAD_DIR .'/listing/'.$model->listing_id .'/'.$NewNameImage);
    }
    
    /**
     * @Author: ANH DUNG Aug 12, 2014
     * @Todo: put WarterMark
     * @Param: $model model 
     */
    public static function PutWarterMarkPhotoListing($model){
        $listing_id = $model->listing_id;
        $fileName = $model->image;
        foreach(ProListingPhotos::$szie as $folder=>$item){
            ImageProcessing::addWarterMark(YII_UPLOAD_DIR . "/listing/$listing_id/$folder/$fileName",YII_UPLOAD_DIR . "/listing/$listing_id/$folder/$fileName");
        }
    }
    /**
     * @Author: ANH DUNG Aug 12, 2014
     * @Todo: auto set cover
     * @Param: $model model 
     */
    public static function AutoSetCoverPhotoListing($listing_id){
        if(Listing::CheckCanSetCoverAuto($listing_id)>0) return ;
        ProListingPhotos::model()->updateAll(array('default'=>0),
                    "`listing_id`=$listing_id");
        $criteria = new CDbCriteria();
        $criteria->compare('t.listing_id', $listing_id);
        $criteria->limit = 1;
        $criteria->order = 't.id';
        $model = ProListingPhotos::model()->find($criteria);
        if($model){
            $model->default = 1;
            $model->update(array('default'));
        }
    }
    // kiểm tra xem đã có set cover chưa, nếu có rồi thì ko auto set nữa
    public static function CheckCanSetCoverAuto($listing_id){
        $criteria = new CDbCriteria();
        $criteria->compare('t.listing_id', $listing_id);
        $criteria->compare('t.default', 1);        
        return ProListingPhotos::model()->count($criteria);
    }

    public static function GetLimitPhotoUpload(){
        return LIMIT_PHOTO_UPLOAD;
    }
    
    /**
     * @Author: ANH DUNG Aug 12, 2014
     * @Todo: auto set cover
     * @Param: $model model 
     */
    public static function CountPhotoListing($listing_id){
        $criteria = new CDbCriteria();
        $criteria->compare('t.listing_id', $listing_id);
        return ProListingPhotos::model()->count($criteria);
    }
    
    /**
     * @Author: ANH DUNG Aug 15, 2014 
     * @Todo: Please add Condo Name  and type such as “For Sale/ For Rent” - property_name_or_address
     * @Param: $model model 
     * @Return: string 
     */
    public static function FormatNameListingIndexGrid($model, $needMore=array()){
        $CondoName = Listing::getViewDetailPropertyType($model);
        $Type = Listing::$aTextSaleRent[$model->listing_type]." -";
        if(isset($needMore['not_type']))
        {
            $CondoName = '';
        }
        $location = $model->location_id;
        if($location < 10)
                $location = "(D0$location)";
        else
                $location = "(D$location)";

        /*
        * DTOAN 
        * DUNG DE HIEN THI TITLE KHI NGUOI DUNG TU DIEN VAO
        */
        if($model->display_title !=''){
            return $CondoName." $model->display_title $location";
        }

        return $CondoName." $model->property_name_or_address $location";
    }
    
    /**
     * @Author: ANH DUNG Sep 22, 2014
     * @Todo: something
     * @Param: $model
    */
    public static function CanUpdateCompanyListing($model) {
        if(Yii::app()->user->role_id != ROLE_ADMIN){
            if(Yii::app()->user->id != $model->user_id){
                return false;
            }
        }
        return true;
    }
    
    /**
     * @Author: ANH DUNG Aug 12, 2014
     * @Todo: auto set cover
     * @Param: $model model 
     */
    public static function SqlUpdateInfo(){
        $models = self::model()->findAll();
        foreach( $models as $item ){
            $item->update( array('property_house_blk_no', 'property_building_name') );
        }
    }
    
    
    /**
     * @Author: ANH DUNG Dec 02, 2014
     * @Todo: get array listing id by property name
     * @Param: $property_name_or_address
     */
    public static function GetArrListingIdByPropertyName($property_name_or_address) {
        $criteria = new CDbCriteria();
        Listing::GetConditionSearchListing($criteria, $property_name_or_address);
        $models = Listing::model()->findAll($criteria);
        return CHtml::listData($models, "id", "id");
    }
    
    /**
     * @Author: ANH DUNG Dec 19, 2014
     * @Todo: belong to GetArrListingIdByPropertyName and Ajax/actionSearchPropertyName
     * use at: getListTenanciesAgent => Listing::GetArrListingIdByPropertyName
     * @Param: obj $criteria
     * @Param: string $property_name_or_address
     */
    public static function GetConditionSearchListing(&$criteria, $property_name_or_address) {
        $criteria->compare(" t.property_name_or_address", $property_name_or_address, true);
    }
    
    /**
     * @Author: ANH DUNG Jan 16, 2015
     * @Todo: replace some info of Listring
     * @Param: $mCms model page
     * @Param: $mListing model listing
     */
    public static function ReplaceContentCmsPage(&$mCms, $mListing) {
        $mCms->content = str_replace("{property_type}", Listing::getViewDetailPropertyType($mListing),$mCms->content);
        $mCms->content = str_replace("{property_name}", $mListing->property_name_or_address, $mCms->content);
        $mCms->content = str_replace("{property_full_address}", self::GetFullAddress($mListing) , $mCms->content);        
    }
    
    /**
     * @Author: ANH DUNG Jan 16, 2015
     * @Todo: get address of listing
     * @Param: $mListing model listing
     */
    public static function GetFullAddress($mListing) {
        $res = $mListing->property_name_or_address;
        $unit_from = trim($mListing->unit_from);
        // if( $unit_from !='' ){
        //     $res .= " $mListing->unit_from";
        // }
        // if( trim($mListing->unit_to) !='' ){
        //     $res .= ( $unit_from!=""?" - $mListing->unit_to":" $mListing->unit_to");
        // }
        $res .= " Singapore $mListing->postal_code";
        return $res;
    }
    
    
    /**
     * @Author: ANH DUNG Jan 22, 2015
     * @Todo: update id cua admin tao company listing vao id listing saleperson pick
     * @Param: column company_listing_user_created
     */
    public static function UpdateIdAdminCreateCompanylisting() {
        // 1. update table listing
        $criteria = new CDbCriteria();
        $criteria->addCondition('t.company_listing_id IS NOT NULL AND t.company_listing_id<>"" ');
        $models = Listing::model()->findAll($criteria);
        foreach( $models as $model ){
            $mCompanyListing = Listing::model()->findByPk($model->company_listing_id);
            if($mCompanyListing){
                $model->company_listing_user_created = $mCompanyListing->user_id;
                $model->update( array('company_listing_user_created') );
        
                // 2. update table transaction
                $c2 = new CDbCriteria();
                $c2->compare('listing_id', $model->id);
                ProTransactions::model()->updateAll(array('company_listing_user_created'=>$model->company_listing_user_created), $c2);
            }
        }
    }
    
    
    /**
     * @Author: ANH DUNG Jan 26, 2015
     * @Todo: can delete company listing
     * @Param: $model
     */
    public static function CanDeleteCompanyListing($model) {
        if( count($model->rCompanyListingHasMany) ){
            return 0;
        }
        return 1;
    }
    
    /**
     * @Author: ANH DUNG Feb 10, 2015
     * @Todo: format info saleperson
     * Marketed by Irene - Call +6592358128
     * @Param: $model model listing
     */
    public static function FormatSaleperson($model) {
        // Marketed by Irene - Call +6592358128
        $cmsFormater = new CmsFormatter();        
        $res = "Marketed by ";
        $mSaleperson = $model->rUser;
        if($mSaleperson){
            $res .= $mSaleperson->first_name." ".$mSaleperson->last_name." - Call ".$cmsFormater->formatFullPhone($mSaleperson);
        }
        return $res;
    }
    
    /**
     * @Author: ANH DUNG Feb 10, 2015
     * @Todo: format ListedDate of listing
     * Re-listed on OR Listed on
     * Re-listed on Feb 08, 2015
     * @Param: $model model listing
     */
    public static function FormatListedDate($model) {
        $date = $model->date_listed;
        $text = "Listed on ";
        if ( $model->re_listed_count ){
            $date = $model->re_listed_date;
            $text = "Re-listed on ";
        }
        $res = $text.MyFormat::dateConverYmdToDmy($date, MyFormat::$sDateIndexListing);
        return $res;
    }
    
    
     /**
     * @Author: ANH DUNG Mar 05, 2015
     * @Todo: If building name is applicable in properties, show building name as below:
      * For Rent - Vacanza @ East (D14)
        Condominium
        36 Lengkong Tujoh
        Marketed by Irene - Call +6592358128
        Re-listed on Feb 3, 2015
      * 
      * If building name is not applicable in properties, show street name as below:
      * For Sale - Jalan Belibas (D20)
        Semi-Detached House
        16 Jalan Belibas
        Marketed by Irene - Call +6592358128
        Re-listed on Feb 11, 2015 
     * Marketed by Irene - Call +6592358128
     * @Param: $model model listing
     */
    public static function FormatShowBuildingOrStreet($model) {
        if(trim($model->display_address) != ''){
            return $model->display_address; // ANH DUNG MAR 11, 2015
        }
        $res = "";
        if(trim($model->property_street_name) != ""){
            $res = "<p>$model->property_house_blk_no $model->property_street_name</p>";
        }
        if(trim($model->property_building_name) != ""){
            $res = "<p>$model->property_building_name</p>";
        }
        return $res;
    }
    
    /**
     * @Author: ANH DUNG Mar 10, 2015
     * @Todo: get address like client feed back
     * @Param: $model model listing
     */
    public static function GetAddressReal($model) {
        return trim(strip_tags(Listing::FormatShowBuildingOrStreet($model)));
    }
    
    /**
     * @Author: ANH DUNG Mar 10, 2015
     * @Todo: get address like client feed back
     * @Param: $model model listing
     */
    public static function GetFormatLandArea($model,$char=null) {
        $res = '';
        if($model->land_area>0){
            $sqft   = $model->land_area;
            $sqm    = MyFunctionCustom::convertData($model->land_area,'sqft');
            $tmp= array();
            if($sqft !=0 && $sqft !='')  $tmp[] = "$sqft sqft";
            if($sqm  !=0 && $sqm !='')  $tmp[] = "$sqm sqm (land)";
            //$res    =  "&nbsp;&nbsp;-&nbsp; $sqft sqft / $sqm sqm (land) ";
            
            $res    = implode(' / ', $tmp);
        }
        return $res;
    }

    public static function showSqft($data1,$data2){
        $arrTmp = array();
        if($data1 !=''){
            $arrTmp[] = $data1;
        }
        if($data2 !=''){
            $arrTmp[] = $data2;
        }
        return trim(implode('&nbsp;&nbsp;-&nbsp;', $arrTmp));
    }
    
    /**
     * @Author: DTOAN 23-3-2015
     * @Todo: show icon room
     * @Param: $model model listing
     */
    public function showiconBedroomBathroom($model){
        $button =array();
        if($model->of_bedroom>=0){
            $beadroom = ($model->of_bedroom==10) ? "+10" :$model->of_bedroom; 
            
            //if($model->of_bedroom==0) $beadroom  = Listing::$ARR_BED_ROOMS[0];//studio
            //id 18 HDB Apartment
            if($model->of_bedroom==0 && $model->property_type_2==18) $beadroom  = Listing::$ARR_BED_ROOMS[0];//studio

            if($model->of_bedroom==11) $beadroom = Listing::$ARR_BED_ROOMS[11]; //Room Renta
            if($beadroom !=''){
                $button[] ='<p class="btn-4"><span class="ico-bed">'.(int)$beadroom.'</span></p>';
            }
        }
        if($model->canShowBedroomAndBathRoom()){
            $button[] ='<p class="btn-4"><span class="ico-shower">'.(int)$model->of_bathrooms.'</span></p>';
        }
        return implode('',$button);
    }

    public static function getListingWithIdReturnAttributes($id,$key){
        $model = Listing::model()->findByPk($id);
        if($model){
            return $model->$key;
        }
    }
    public function getListingForRent($offset=0, $limit=6){
        $criteria = new CDbCriteria;
        $criteria->compare('t.status', STATUS_ACTIVE);
        $criteria->compare('t.status_listing', STATUS_LISTING_ACTIVE);
        $criteria->compare('t.listing_type', Listing::FOR_RENT);
        $criteria->order = 't.date_listed desc';
        $criteria->offset = $offset;
        $criteria->limit = $limit;
        return self::model()->findAll($criteria);
    }
    public function getListingForSale($offset=0, $limit=6){
        $criteria = new CDbCriteria;
        $criteria->compare('t.status', STATUS_ACTIVE);
        $criteria->compare('t.status_listing', STATUS_LISTING_ACTIVE);
        $criteria->compare('t.listing_type', Listing::FOR_SALE);
        $criteria->order = 't.date_listed desc';
        $criteria->offset = $offset;
        $criteria->limit = $limit;
        return self::model()->findAll($criteria);
    }
    /**
     * @Todo: resize lại photo listing if have new size
     */
    public function resizeNewsize($id,$size){
        $mFile = ProListingPhotos::model()->findByPk($id);
        if($mFile){
            $image_find = Yii::getPathOfAlias('webroot')."/".ProListingPhotos::$folderUpload."/".$mFile->listing_id."/".$size."/".$mFile->image;   
            if(!file_exists($image_find)){
                $sourceImage = Yii::getPathOfAlias('webroot')."/".ProListingPhotos::$folderUpload."/".$mFile->listing_id."/".$mFile->image;   
                if(file_exists($sourceImage)){
                    Listing::ResizePhotoListing($mFile);
                    Listing::PutWarterMarkPhotoListing($mFile);
                    Listing::ResizePhotoListingSmall($mFile);
                }
            }    
        }
    }

    /*
     * @author LH
     */
    public function getDefaultImageUrl($width=null, $height=null) {
        $noImageUrl = null;
        $model = ProListingPhotos::model()->findByAttributes(array(
            'listing_id' => $this->id, 
            'default' => 1));
        if ($model)
            return $model->getImageUrl($width, $height, true);
        return $noImageUrl;
    }
	
    /*
     * @author LH
     */
	public function canShowBedroomAndBathRoom() {
		return !in_array($this->property_type_2, array(
			ProPropertyType::PROPERTY_TYPE_RETAIL, 
			ProPropertyType::PROPERTY_TYPE_OFFICE,
			ProPropertyType::PROPERTY_TYPE_INDUSTRIAL,
			ProPropertyType::PROPERTY_TYPE_LAND,
		));
	}
	
    /*
     * @author Lam Huynh
	 * @return Users[]
     */
	public function getContactClickedUsers() {
		$c = new CDbCriteria();
		$c->params = array(':listing'=>$this->id);
		$c->addCondition('id in (
			select user_id from {{_listing_click}} where listing_id=:listing )');
		return Users::model()->findAll($c);
	}
	
    /*
     * @author Lam Huynh
	 * @return string
     */
	public function getSqft() {
		// copy from listing_detail.php
		if ($this->property_type_2 == 42) { //property type land
			$sqft        = MyFunctionCustom::convertData($this->land_area, 'sqm');
			$sqftcontent = (($sqft != 0 && $sqft != '')) ? "$sqft sqft" : '';
		} else {
			$sqft = $this->floor_area;
			$sqm  = $this->floor_area;
			if ($this->floor_area_unit == Listing::FLOOR_UNIT_SQM) {
				$sqft = MyFunctionCustom::convertData($this->floor_area, 'sqm');
			}
			if ($this->floor_area_unit == Listing::FLOOR_UNIT_SQFT) {
				$sqm = MyFunctionCustom::convertData($this->floor_area, 'sqft');
			}

			$tmp = array();
			if ($sqft != 0 && $sqft != '')
				$tmp[] = "$sqft sqft";
			if ($sqm != 0 && $sqm != '')
				$tmp[] = "$sqm sqm (built-up)";
			$sqftcontent = implode(' / ', $tmp);
		}
		$s = Listing::showSqft($sqftcontent,Listing::GetFormatLandArea($this));
		$arr = explode('/', $s);
		return trim(str_replace('sqft', '', $arr[0]));
	}
	
    /**
     * Change telemarketer of listings when submit form
     * @author Lam Huynh
     */
    public static function massUpdateTelemarketer($items){
		foreach($items as $id => $data) {
			if (!array_key_exists('user_id', $data) ) continue;
			$listing = LhListing::model()->findByPk($id);
			if (!$listing) continue;
			
			$listing->scenario = 'change-telemarketer';
			$listing->user_id = $data['user_id'];
			$listing->save();
		}
		return true;
    }	
}
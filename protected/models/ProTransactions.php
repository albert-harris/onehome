<?php

/**
 * This is the model class for table "{{_pro_transactions}}".
 *
 * The followings are the available columns in table '{{_pro_transactions}}':
 * @property string $id
 * @property string $transactions_no
 * @property string $listing_id
 * @property string $user_id
 * @property integer $type
 * @property string $otp_contract_date
 * @property string $tenancy_agreement_date
 * @property integer $months_rent
 * @property integer $with_tenancy
 * @property string $commencement_date
 * @property string $expiring_date
 * @property string $tenancy_amount
 * @property string $deposit_payable
 * @property string $appointment_date
 * @property string $transacted_price
 * @property string $valuation_price
 * @property integer $internal_co_broke_consultant
 * @property string $co_broke_agreement
 * @property string $purchaser_user_id
 * @property integer $client_type_id
 * @property integer $invoice_bill_to
 * @property string $created_date
 * @property integer $status
 */
class ProTransactions extends CActiveRecord
{
    public $mBillTo;
    public $mInternalCoBroke;
    public $mPropertyDetail;
    public $mPropertyDocument;
    public $mVendorPurchaserDetail;
    public $aModelPropertyDocument;
    public $mTenatDefault;
    public $received_on; // không lưu chỉ sử dụng để truyền biến ProTransactionsSaveCommission::
    
    public $mLandlord;
    public $mTenant;
    public $mVendor; // Oct 28, 2014
    public $mPurchaser; // Oct 28, 2014
    
    public $SubmittedFrom;
    public $SubmittedTo;
    public $MAX_ID;
    public $listing_autocompelte;

    const FOR_RENT = 1;
    const FOR_SALE = 2;
    const LENGTH_TRANS_NO=12;
    
    const STATUS_HAD_INVOICE=2;
    
    const TYPE_CONSULTANT = 3;// FOR ProTransactionsSaveCommission 
    const TYPE_1ST_TIER = 1;// FOR ProTransactionsSaveCommission
    const TYPE_2ND_TIER = 2;// FOR ProTransactionsSaveCommission
    const TYPE_EXTERNAL_COBROKE = 4;// FOR ProTransactionsSaveCommission
    
    const TENANT_IS_SINGAPOREAN = " Scanned IC/ FIN";// FOR ProTransactionsSaveCommission
    const TENANT_NOT_SINGAPOREAN = " Scanned Employment Pass ";// FOR ProTransactionsSaveCommission
    
    public static $aTypeTier = array(
        self::TYPE_CONSULTANT => 'Consultant',
        self::TYPE_1ST_TIER => '1st Tier',
        self::TYPE_2ND_TIER => '2nd Tier',
    );
    
    
    public static $aTypeSaleRent = array(
        self::FOR_RENT,
        self::FOR_SALE,
    );
    
    public static $aTypeSaleRentText = array(
        self::FOR_RENT => 'For Rent',
        self::FOR_SALE => 'For Sale',
    );
    
    public $sPropertyName;
    public $sPropertyPrice;
    public $ext_listing_type_id;
    
    const CLIENT_TYPE_VENDOR = 1;
    const CLIENT_TYPE_PURCHASER = 2;
    const CLIENT_TYPE_LANLORD = 3;
    const CLIENT_TYPE_TENANT = 4;
    
    const BILL_TO_VENDOR = 1;
    const BILL_TO_PURCHASER = 2;
    const BILL_TO_LANLORD = 3;
    const BILL_TO_TENANT = 4;
    const BILL_TO_SOLICITOR = 5;
    const BILL_TO_EXTERNAL_CO_BROKE = 6;
    const BILL_TO_EXTERNAL_CO_BROKE_COMMISSION = 7;
    
    const IS_NOT_INTERNAL_CO_BROKE = 0;
    const INTERNAL_CO_BROKE = 1;
    
    public static $aClientSaleDetail = array(
        self::CLIENT_TYPE_VENDOR=>'Vendor',
        self::CLIENT_TYPE_PURCHASER=>'Purchaser',
        self::CLIENT_TYPE_LANLORD=>'Landlord',
        self::CLIENT_TYPE_TENANT=>'Tenant',
    ); 
    
//    public static $aBillToVendor = array(
//        self::BILL_TO_VENDOR=>'Vendor',
//        self::BILL_TO_SOLICITOR=>'Solicitor',
//    );
    
    public static $aBillTo = array(
        self::BILL_TO_VENDOR=>'Vendor',
        self::BILL_TO_PURCHASER=>'Purchaser',
        self::BILL_TO_LANLORD=>'Landlord',
        self::BILL_TO_TENANT=>'Tenant',
        self::BILL_TO_SOLICITOR=>'Solicitor',
        self::BILL_TO_EXTERNAL_CO_BROKE=>'External Co-Broke',
    );
    
    const TRANS_NEW = 0;
    const TRANS_APPROVED = 1;
    public static $ARR_STATUS_TRANS = array(
        ProTransactions::TRANS_NEW=>'New',
        ProTransactions::TRANS_APPROVED=>'Approved',
    );
    
    public static $WAIT_APPROVE_TEXT = '';
    const LIMIT_PROPERTIES = 5;
    
    public $date_from;
    public $date_to;
    
    // Now 28, 2014 begin big change, sẽ tích hợp phần tạo tenancy ( saleperson tạo ) 
    // mà không tạo transaction
    public static $LIST_STATUS_REAL = array(
        STATUS_ACTIVE,
        STATUS_GEN_INVOICE, // hình như ko có status này, ban đầu tính là có nhưng sau đó change liên tục nên có thể đã bị bỏ
        STATUS_GEN_VOUCHER, // hình như ko có status này
        STATUS_GEN_RECEIPT
    );
    public static $LIST_STATUS_FOR_TENANT = array(
        STATUS_ACTIVE,
        STATUS_GEN_INVOICE, // hình như ko có status này, ban đầu tính là có nhưng sau đó change liên tục nên có thể đã bị bỏ
        STATUS_GEN_VOUCHER, // hình như ko có status này
        STATUS_GEN_RECEIPT,
        STATUS_TENANCY_APPROVE,        
    );
    
    public static $LIST_STATUS_TENANCY_ONLY = array(
        STATUS_TENANCY_APPROVE,// 35 status for change Now 28, 2014 tạo tenancy mà không có transaction
    );
    
    public static $LIST_STATUS_NOT_ALLOW_ACCESS = array(
        STATUS_INACTIVE,
        STATUS_TENANCY_NEW,
    );
    
    public static $LIST_STATUS_TENANCY_NEW = array(
        STATUS_TENANCY_NEW,
    );
    public static $LIST_STATUS_TENANCY_TEXT = array(
        STATUS_TENANCY_NEW => "New",
        STATUS_TENANCY_APPROVE => "Approved",
    );
    const ADD_EXISTING = 1;
    const ADD_UNLISTED = 2;
    
    public static $LIST_ADD_PROPERTY = array(
        ProTransactions::ADD_EXISTING,
        ProTransactions::ADD_UNLISTED,
    );
    public static $ARR_ADD_PROPERTY = array(
        ProTransactions::ADD_EXISTING => 'Existing',
        ProTransactions::ADD_UNLISTED => 'Unlisted',
    );        
    // Now 28, 2014
    
    public $autocomplete_user_name; // Jan 02, 2014
    
    //Augst 17, 2015
    public $keyword;
    
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
            return '{{_pro_transactions}}';
    }

    public function rules()
    {
        return array(
            // for sale
            array('add_property,type,otp_contract_date, with_tenancy,transacted_price,client_type_id',
                'required', 'on'=>'CreateTransaction'), // for sale
            array('type,otp_contract_date, with_tenancy,commencement_date, expiring_date, tenancy_amount, transacted_price,client_type_id',
//            array('type,otp_contract_date, with_tenancy,commencement_date, expiring_date, tenancy_amount, appointment_date_hdb_only,transacted_price,client_type_id',
                'required', 'on'=>'WithTenancyYes'),
            array('add_property,type,tenancy_agreement_date, months_rent,commencement_date,expiring_date,tenancy_amount,deposit_payable,client_type_id',
                'required', 'on'=>'CreateTransactionForRent'), // for rent            
            
            // Now 28, 2014
            array('user_id,' // Add Jan 02, 2014
                . 'add_property,tenancy_agreement_date, months_rent,commencement_date,expiring_date,tenancy_amount,deposit_payable',
                'required', 'on'=>'CreateTransactionForRentRecordTenancy'), // for rent
            // Now 28, 2014
            // JULY 21, 2015
            array('user_id,' // Add JULY 21, 2015
                . 'add_property,tenancy_amount,deposit_payable',
                'required', 'on'=>'CreateTransactionForRentRecordTenancy_new'), 
            array('commencement_date,expiring_date','checkDateWithTenency', 'on'=>'CreateTransactionForRentRecordTenancy_new'),
            
            // Dec 02, 2014
            // for rent Unlisted
            array('add_property,tenancy_agreement_date, months_rent,commencement_date,expiring_date,tenancy_amount,deposit_payable',
                'required', 'on'=>'CreateTransactionForRentUnlisted'), 
            // for sale Unlisted
            array('add_property,type,otp_contract_date, with_tenancy,transacted_price,client_type_id',
                'required', 'on'=>'CreateTransactionForSaleUnlisted'), 
            // Dec 02, 2014
            
            array('tenancy_amount, deposit_payable, transacted_price, valuation_price', 
                'length', 'max'=>16,
                'on'=>'CreateTransaction',
                ),
            array('co_broke_agreement', 'length', 'max'=>255,
                'on'=>'CreateTransaction',
                ),
            array('id, transactions_no, listing_id, user_id, type, otp_contract_date, tenancy_agreement_date, months_rent, with_tenancy, commencement_date, expiring_date, tenancy_amount, deposit_payable, appointment_date_hdb_only, transacted_price, valuation_price, internal_co_broke_consultant, co_broke_agreement, purchaser_user_id, client_type_id, invoice_bill_to, created_date, status', 'safe'),
            array('admin_approved,ext_listing_type_id,SubmittedFrom, SubmittedTo,sPropertyName,sPropertyPrice', 'safe'),
            array('date_from,date_to,keyword', 'safe'),
            array('is_admin_created,add_property', 'safe'), // Now 28, 2014
            
            array('admin_approved', 'CanApproveTransaction', // Feb 11, 2015 ANH DUNG
                'on'=>'ApproveTransaction,ApproveTenancy'),
            
            array('listing_id', 'required'), // Mar 24, 2015
            array('listing_id', 'RequiredListingId'), // Mar 24, 2015
            
        );
    }
    public function checkDateWithTenency($attribute, $params) {
         //add 
        if(isset($this->with_tenancy) && ($this->with_tenancy == 1)){
            if(($this->commencement_date =='') || ($this->commencement_date == NULL) || ($this->commencement_date =='0000-00-00')){
                $this->addError('commencement_date',"Commencement date cannot be blank");
            }
            if(($this->expiring_date =='') || ($this->expiring_date == NULL) || ($this->expiring_date =='0000-00-00')){
                $this->addError('expiring_date',"Expiring date cannot be blank");
            }
        }
    }
    public static function LoadModelRelationByPk($pk){
        $criteria = new CDbCriteria();
        $criteria->compare('t.id', $pk);
        $with = array('rInvoice', 'rVoucher', 'rReceipt', 'rBillTo', 'rExternalCoBroke', 'rExternalCoBrokeCommission', 
            'rInternalCoBroke', 'rPropertyDetail', 'rPropertyDocument',
            'rVendorPurchaserDetail', 'rListing', 'rUser', 'rLandlord','rTenantDefault'
            );
//        $criteria->with = $with; // không nên dùng with ở đâu, nếu dữ liệu nhiều sẽ bị join bảng rất lâu - check lại
//        $criteria->together = true;
        return self::model()->find($criteria);        
    }

    /**
     * @Author: ANH DUNG Feb 19, 2015
     * @Todo: validate landlord and tenant when approve transaction
     */
    public function CanApproveTransaction($attribute, $params) {
//        if ($this->admin_approved) {
            $aLandlordTenant = ProTransactionsVendorPurchaserDetail::GetNewUserOfTransaction($this);
            foreach($aLandlordTenant as $mLandlordOrTenant){
                $mUser = Users::CheckExistsUser($mLandlordOrTenant->user_id, $mLandlordOrTenant->email, $mLandlordOrTenant->nric_passportno_roc);
                if($mUser){
                    $client_type = ProTransactions::$aClientSaleDetail[$mLandlordOrTenant->type];
                    $msg = "$client_type $mLandlordOrTenant->name can not create, an user with EMAIL: $mLandlordOrTenant->email or NRIC: $mLandlordOrTenant->nric_passportno_roc already exists in system";
                    if( $this->scenario == "ApproveTenancy"){
                        $this->addError("status", $msg);
                    }else{
                        $this->addError("admin_approved", $msg);
                    }
                    break;
                }
            }
//        }
    }   
    
    /**
     * @Author: ANH DUNG Mar 24, 2015
     * @Todo: check required listing id or property add
     */
    public function RequiredListingId($attribute, $params) {
        if($this->add_property == ProTransactions::ADD_EXISTING){
            if($this->listing_id < 1 && $this->scenario != 'create_draff_transaction'){
                $this->addError("listing_id", $this->getAttributeLabel('listing_id')." can not be blank");
            }
        }
    }
    
    /**
     * @Author: ANH DUNG Jul 10, 2014
     * @Todo: get name of lanlord when view invoice
     * @Param: $mTransactions model transaction
     * @Return: string name
     */
    public static function getInvoiceLanlordName($mTransactions){
        $res = '';
        foreach($mTransactions->rLandlord as $item){
            $res .= $item->rUser?$item->rUser->first_name.", ":"";
        }
        $res = trim($res);
        return $res = trim($res, ',');
    }

    public static function getInvoiceTenantName($mTransactions){
        $res = '';
        if($mTransactions->rTenantDefault){
            $res .= $mTransactions->rTenantDefault->rUser?$mTransactions->rTenantDefault->rUser->first_name:"";
        }
        $res = trim($res);
        return $res = ltrim($res, ',');
    }
    
    public function relations()
    {
        return array(
            'rInvoice' => array(self::HAS_MANY, 'ProTransactionsInvoice', 'transactions_id',
                'on'=>'rInvoice.invoice_type='. ProTransactionsInvoice::TYPE_INVOICE,
                ),            
            'rVoucher' => array(self::HAS_MANY, 'ProTransactionsInvoice', 'transactions_id',
                'on'=>'rVoucher.invoice_type='. ProTransactionsInvoice::TYPE_VOUCHER,
                ),
            'rReceipt' => array(self::HAS_ONE, 'ProTransactionsInvoice', 'transactions_id',
                'on'=>'rReceipt.invoice_type='. ProTransactionsInvoice::TYPE_RECEIPT,
                ),            
            
            'rBillTo' => array(self::HAS_ONE, 'ProTransactionsBillTo', 'transactions_id',
                'on'=>'rBillTo.type='.  ProTransactionsBillTo::TYPE_VENDOR_PURCHASER,
                ),
            // rExternalCoBroke to gen invoice và là con số này Sales person C got the commission amount - 1000
            'rExternalCoBroke' => array(self::HAS_MANY, 'ProTransactionsBillTo', 'transactions_id',
                'on'=>'rExternalCoBroke.type='.  ProTransactionsBillTo::TYPE_EXTERNAL_CO_BROKE. ' AND '
                . ' rExternalCoBroke.bill_to_id = '. ProTransactions::BILL_TO_EXTERNAL_CO_BROKE,
                ),
            // rExternalCoBrokeCommission để trừ commission External co-broke – 100 (saleperson multi External co-broke  input )
            'rExternalCoBrokeCommission' => array(self::HAS_MANY, 'ProTransactionsBillTo', 'transactions_id',
                'on'=>'rExternalCoBrokeCommission.type='.  ProTransactionsBillTo::TYPE_EXTERNAL_CO_BROKE. ' AND '
                . ' rExternalCoBrokeCommission.bill_to_id <> '. ProTransactions::BILL_TO_EXTERNAL_CO_BROKE,
                ),
            
            
            'rInternalCoBroke' => array(self::HAS_MANY, 'ProTransactionsInternalCoBroke', 'transactions_id'),
            'rPropertyDetail' => array(self::HAS_ONE, 'ProTransactionsPropertyDetail', 'transactions_id'),
            'rPropertyDocument' => array(self::HAS_MANY, 'ProTransactionsPropertyDocument', 'transactions_id',
                'order'=>'rPropertyDocument.order_no ASC',
                ),
            'rVendorPurchaserDetail' => array(self::HAS_MANY, 'ProTransactionsVendorPurchaserDetail', 'transactions_id'),
            'rTenancyDetailAgent' => array(self::HAS_MANY, 'ProTransactionsVendorPurchaserDetail', 'transactions_id', 
                'on'=>'rTenancyDetailAgent.type='.  ProTransactions::CLIENT_TYPE_TENANT,
                'joinType'=>'RIGHT JOIN'
            ),            
            
            'rLandlord' => array(self::HAS_MANY, 'ProTransactionsVendorPurchaserDetail', 'transactions_id',
                'on'=>'rLandlord.type='.  ProTransactions::CLIENT_TYPE_LANLORD." ",
                ),
            
            'rTenantDefault' => array(self::HAS_ONE, 'ProTransactionsVendorPurchaserDetail', 'transactions_id',
                'on'=>'rTenantDefault.type='.  ProTransactions::CLIENT_TYPE_TENANT." AND rTenantDefault.is_default=1",
                ),
            
            'rTenantAddMore' => array(self::HAS_MANY, 'ProTransactionsVendorPurchaserDetail', 'transactions_id',
                'on'=>'rTenantAddMore.type='.  ProTransactions::CLIENT_TYPE_TENANT." AND rTenantAddMore.is_default=0",
                'order'=>'rTenantAddMore.id ASC',
                ),
            'rTenantAll' => array(self::HAS_MANY, 'ProTransactionsVendorPurchaserDetail', 'transactions_id',
                'on'=>'rTenantAll.type='.  ProTransactions::CLIENT_TYPE_TENANT."",
                'order'=>'rTenantAll.is_default DESC, rTenantAll.id ASC',
                ),
            'listing' => array(self::BELONGS_TO, 'Listing', 'listing_id'),
            'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
            'rUser' => array(self::BELONGS_TO, 'Users', 'user_id'),
            'rListing' => array(self::BELONGS_TO, 'Listing', 'listing_id'),
        );
    }

    public function attributeLabels()
    {
            return array(
                    'id' => 'ID',
                    'transactions_no' => 'Transactions No',
                    'listing_id' => 'Search Property Name or Address',
                    'user_id' => 'Saleperson',
                    'type' => 'Type of Transaction',
                    'otp_contract_date' => 'OTP/ Contract Date ',
                    'tenancy_agreement_date' => 'Tenancy Agreement Date',
                    'months_rent' => 'Month – Tenancy Period ',
                    'with_tenancy' => 'With Tenancy',
                    'commencement_date' => 'Commencement Date',
                    'expiring_date' => 'Expiring Date',
                    'tenancy_amount' => 'Tenancy Amount',
                    'deposit_payable' => 'Deposit Paid',
                    'appointment_date_hdb_only' => '1st Appointment Date for HDB only',
                    'transacted_price' => 'Transacted Price',
                    'valuation_price' => 'Valuation Price',
                    'internal_co_broke_consultant' => 'Internal Co Broke Consultant',
                    'co_broke_agreement' => 'Co Broke Agreement',
                    'purchaser_user_id' => 'Purchaser User',
                    'client_type_id' => 'Client Type',
                    'invoice_bill_to' => 'Invoice Bill To',
                    'created_date' => 'Submitted Date',
                    'status' => 'Status',
                    'SubmittedFrom' => 'Submitted From',
                    'SubmittedTo' => 'Submitted To',
                    'sPropertyName' => 'Property Name',
                    'ext_listing_type_id' => 'Listing Type',
                    'admin_approved' => 'Status',
                    'keyword'=>'Keywords',
            );
    }

    public function search()
    {
//        ProTransactions::ReplaceCmsLinkLiveSite();
        $criteria=new CDbCriteria;
        $criteria->with = array('listing', 'rPropertyDetail');
//        $criteria->compare('t.transactions_no',$this->transactions_no,true);
        $criteria->compare('t.type',$this->type);
        $criteria->compare('t.admin_approved',$this->admin_approved);
        $criteria->addInCondition('t.status', ProTransactions::$LIST_STATUS_REAL);
        $created_date = MyFormat::dateConverDmyToYmdForSeach($this->created_date);
        if(!empty($this->created_date))
            $criteria->compare('t.created_date', $created_date, true);
        $criteria->compare('rPropertyDetail.listing_type_id',$this->ext_listing_type_id);
        //add
        if($this->keyword!=''){
            $criteria->addCondition('t.transactions_no like "%'.$this->keyword.'%" '
                    . 'OR rPropertyDetail.listing_type_id like "%'.$this->keyword.'%" '
                    . 'OR listing.property_name_or_address like "%'.$this->keyword.'%" '
                    . 'OR rPropertyDetail.property_name_or_address like "%'.$this->keyword.'%" '
                    . 'OR listing.price like "%'.$this->keyword.'%"');
        }
        //
       
//        $criteria->together=true;
        $sort = new CSort();
        $sort->attributes = array(
            'id'=>'id',
            'created_date'=>'created_date',
            'sPropertyName' => array(
                'asc' => 'listing.property_name_or_address',
                'desc' => 'listing.property_name_or_address desc',
            ),
            'sPropertyPrice' => array(
                'asc' => 'listing.property_name_or_address',
                'desc' => 'listing.property_name_or_address desc',
            ),
            'ext_listing_type_id' => array(
                'asc' => 'rPropertyDetail.listing_type_id',
                'desc' => 'rPropertyDetail.listing_type_id desc',
            ),
            'transactions_no'=>'transactions_no',
            'type'=>'type',
            'email'=>'email',
            'email_not_login'=>'email_not_login',
            'address'=>'address',
            'status'=>'status',
            'contact_no'=>'contact_no',            
            );    
            $sort->defaultOrder = 't.id DESC';          

        return new CActiveDataProvider($this, array(
                'criteria'=>$criteria,
                'pagination'=>array(
                    'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
                ),
            'sort' => $sort,
        ));
    }
    
    /**
     * @Author: ANH DUNG Apr 17, 2014
     * @Todo: list transaction Management of member agent
     * http://localhost/propertyinfo-dev/propertyfinal/member/member_profile/transactionManagement
     */
    public function searchFeList()
    {
        $criteria=new CDbCriteria;
        $criteria->compare('t.user_id',$this->user_id);
        $criteria->compare('t.type',$this->type);
//        $criteria->addCondition('t.status>'. STATUS_INACTIVE); // close on Now 28, 2014
        $criteria->addInCondition('t.status', ProTransactions::$LIST_STATUS_REAL); // add on Now 28, 2014
        
        $SubmittedFrom = MyFormat::dateConverDmyToYmdForSeach($this->SubmittedFrom);
        $SubmittedTo = MyFormat::dateConverDmyToYmdForSeach($this->SubmittedTo);
        
        if(!empty($SubmittedFrom) && empty($SubmittedTo))
            $criteria->addCondition("t.created_date>='$SubmittedFrom'");
        if(empty($SubmittedFrom) && !empty($SubmittedTo))
            $criteria->addCondition("t.created_date<='$SubmittedTo 23:59:00'");
        if(!empty($SubmittedFrom) && !empty($SubmittedTo))
            $criteria->addBetweenCondition("t.created_date",$SubmittedFrom, "$SubmittedTo  23:59:00");	
        $criteria->order = 't.id DESC';
        
        return new CActiveDataProvider($this, array(
                'criteria'=>$criteria,
                'pagination'=>array(
                    'pageSize'=> 10,
//                    'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
                ),
        ));
    }

    public function defaultScope()
    {
            return array(
                    //'condition'=>'',
            );
    }
    
    
    /**
     * @Author: ANH DUNG Sep 05, 2014
     * @Todo: List of Tenancies of tenant
     * Sep 05, 2014 ANH DUNG edit
     * use at propertyfinal/member/tenant/property
     */
    public static function getListTenancies($needMore=array()) {
        $criteria=new CDbCriteria;
        $pagination = array(
                'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
            );
        self::getCriteriaTenancies($criteria, $pagination, $needMore);
        $criteria->order = 't.id DESC';
        return new CActiveDataProvider('ProTransactions', array(
                'criteria'=>$criteria,
                'pagination'=>$pagination
        ));
    }
    
    /**
     * @Author: ANH DUNG Oct 22, 2014
     * @Todo: belong to getListTenancies
     * @Param: $criteria
     */
    public static function getCriteriaTenancies(&$criteria, &$pagination, $needMore){
        $current_user_id = Yii::app()->user->id;
//        $criteria->addCondition('t.status>0');
        $criteria->addInCondition('t.status', ProTransactions::$LIST_STATUS_FOR_TENANT); // add on Now 28, 2014
        $criteria->with = array('rVendorPurchaserDetail');
        $criteria->compare('rVendorPurchaserDetail.user_id', $current_user_id);        
        $criteria->together = true;
        if(isset($needMore['limit'])){
            $criteria->offset = 0; 
            $criteria->limit = $needMore['limit']; 
            $pagination = false;
        }
    }    
    
    /**
     * @Author: ANH DUNG Oct 19, 2014
     * @Todo: something
     * @Param: $model
     */
    public static function getLatestPropertiesTenancies() {
        $criteria=new CDbCriteria;
        $pagination = false;
        self::getCriteriaTenancies($criteria, $pagination, array('limit'=>1));
        $criteria->order = 't.id DESC';
        return self::model()->find($criteria);
    }
    
    /**
     * @Author: ANH DUNG Jul 29, 2014
     * @Todo: BE search list tenancies by transaction 
     */
    public function getBEListTenancies() {
        $criteria=new CDbCriteria;
//        $criteria->addCondition('t.status>0');
        $criteria->addInCondition('t.status', ProTransactions::$LIST_STATUS_FOR_TENANT); // add on Now 28, 2014
        $aWith = array();
//        $criteria->with = array('rVendorPurchaserDetail');
//        $criteria->compare('rVendorPurchaserDetail.user_id', $current_user_id);
        
        if(trim($this->sPropertyName) != ''){
            $aWith[] = 'rPropertyDetail';
            $criteria->compare('rPropertyDetail.property_name_or_address', $this->sPropertyName, true);
        }
        
        if(count($aWith)){
            $criteria->with = $aWith;
            $criteria->together = true;
        }
        
        $tenancy_agreement_date = MyFormat::dateConverDmyToYmdForSeach($this->tenancy_agreement_date);
        if(!empty($this->tenancy_agreement_date)){
            $criteria->compare('t.tenancy_agreement_date', $tenancy_agreement_date);
        }
        
        $commencement_date = MyFormat::dateConverDmyToYmdForSeach($this->commencement_date);
        if(!empty($this->commencement_date)){
            $criteria->compare('t.commencement_date', $commencement_date);
        }
        
        $expiring_date = MyFormat::dateConverDmyToYmdForSeach($this->expiring_date);
        if(!empty($this->expiring_date)){
            $criteria->compare('t.expiring_date', $expiring_date);
        }
        
        $criteria->compare('t.tenancy_amount', $this->tenancy_amount, true);
        $criteria->compare('t.deposit_payable', $this->deposit_payable, true);
        $criteria->compare('t.months_rent', $this->months_rent, true);
        $criteria->order = "t.id DESC";
        // Jan 22, 2015 Should only show the tenancies closed under their listings and not all tenancy record.
        if( Yii::app()->user->role_id != ROLE_ADMIN ){
            $criteria->compare('t.company_listing_user_created', Yii::app()->user->id);
        }
        // Jan 22, 2015 Should only show the tenancies closed under their listings and not all tenancy record.

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
            ),
        ));
    }
    
    /**
     * @Author: ANH DUNG Dec 02, 2014
     * @Todo: BE search list tenancies new by transaction 
     */
    public function getBEListTenanciesNew() {
        $criteria=new CDbCriteria;
        $criteria->addInCondition('t.status', ProTransactions::$LIST_STATUS_TENANCY_NEW);
        $aWith = array();
//        $criteria->with = array('rVendorPurchaserDetail');
//        $criteria->compare('rVendorPurchaserDetail.user_id', $current_user_id);
        
        if(trim($this->sPropertyName) != ''){
            $aWith[] = 'listing';
            $criteria->compare('listing.property_name_or_address', $this->sPropertyName, true);
        }
        
        if(count($aWith)){
            $criteria->with = $aWith;
            $criteria->together = true;
        }
        
        $tenancy_agreement_date = MyFormat::dateConverDmyToYmdForSeach($this->tenancy_agreement_date);
        if(!empty($this->tenancy_agreement_date)){
            $criteria->compare('t.tenancy_agreement_date', $tenancy_agreement_date);
        }
        
        $commencement_date = MyFormat::dateConverDmyToYmdForSeach($this->commencement_date);
        if(!empty($this->commencement_date)){
            $criteria->compare('t.commencement_date', $commencement_date);
        }
        
        $expiring_date = MyFormat::dateConverDmyToYmdForSeach($this->expiring_date);
        if(!empty($this->expiring_date)){
            $criteria->compare('t.expiring_date', $expiring_date);
        }
        
        $criteria->compare('t.tenancy_amount', $this->tenancy_amount, true);
        $criteria->compare('t.deposit_payable', $this->deposit_payable, true);
        $criteria->compare('t.months_rent', $this->months_rent, true);
        $criteria->order = "t.id DESC";

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
            ),
        ));
    }
    
    /**
     * @Author: ANH DUNG Jan 13, 2015
     * @Todo: BE search list tenancies draft by transaction 
     */
    public function getBEListTenanciesDraft() {
        $cUid = Yii::app()->user->id;
        $criteria=new CDbCriteria;
        $criteria->compare('t.status', STATUS_TENANCY_DRAFT);
        $criteria->compare('t.created_by', $cUid); 
        $criteria->compare('t.is_admin_created', 1);
        $aWith = array();
//        $criteria->with = array('rVendorPurchaserDetail');
//        $criteria->compare('rVendorPurchaserDetail.user_id', $current_user_id);
        
        if(trim($this->sPropertyName) != ''){
            $aWith[] = 'listing';
            $criteria->compare('listing.property_name_or_address', $this->sPropertyName, true);
        }
        
        if(count($aWith)){
            $criteria->with = $aWith;
            $criteria->together = true;
        }
        
        $tenancy_agreement_date = MyFormat::dateConverDmyToYmdForSeach($this->tenancy_agreement_date);
        if(!empty($this->tenancy_agreement_date)){
            $criteria->compare('t.tenancy_agreement_date', $tenancy_agreement_date);
        }
        
        $commencement_date = MyFormat::dateConverDmyToYmdForSeach($this->commencement_date);
        if(!empty($this->commencement_date)){
            $criteria->compare('t.commencement_date', $commencement_date);
        }
        
        $expiring_date = MyFormat::dateConverDmyToYmdForSeach($this->expiring_date);
        if(!empty($this->expiring_date)){
            $criteria->compare('t.expiring_date', $expiring_date);
        }
        
        $created_date = MyFormat::dateConverDmyToYmdForSeach($this->created_date);
        if(!empty($this->created_date)){
            $criteria->compare('t.created_date', $created_date, true);
        }
        
        $criteria->compare('t.tenancy_amount', $this->tenancy_amount, true);
        $criteria->compare('t.deposit_payable', $this->deposit_payable, true);
        $criteria->compare('t.months_rent', $this->months_rent, true);
        $criteria->order = "t.id DESC";

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
            ),
        ));
    }

    /**
     * @return CActiveDataProvider
     * <Jason>
     */
    public static function getListTenanciesLandlord($needMore=array()) {
        $criteria=new CDbCriteria;
        $pagination = array(
                'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
            );
        self::getCriteria($criteria, $pagination, $needMore);
        $criteria->order = 't.id DESC';
        
        return new CActiveDataProvider('ProTransactions', array(
            'criteria'=>$criteria,
            'pagination'=>$pagination
        ));
    }
    
    /**
     * @Author: ANH DUNG Oct 22, 2014
     * @Todo: belong to getListTenanciesLandlord
     * @Param: $criteria
     */
    public static function getCriteria(&$criteria, &$pagination, $needMore){
        $current_user_id = Yii::app()->user->id;
//        $criteria->addCondition('t.status>0');
        $criteria->addInCondition('t.status', ProTransactions::$LIST_STATUS_FOR_TENANT); // add on Now 28, 2014
        $criteria->with = array('rVendorPurchaserDetail');
        $criteria->compare('rVendorPurchaserDetail.user_id', $current_user_id);        
        $criteria->together = true;
        if(isset($needMore['limit'])){
            $criteria->offset = 0;
            $criteria->limit = $needMore['limit']; 
            $pagination = false;
        }
    }
    
    /**
     * @Author: ANH DUNG Oct 19, 2014
     * @Todo: something
     * @Param: $model
     */
    public static function getLatestProperties() {
        $criteria=new CDbCriteria;
        $pagination = false;
        self::getCriteria($criteria, $pagination, array('limit'=>1));
        $criteria->order = 't.id DESC';
        return self::model()->find($criteria);
    }

    // ANH DUNG - chỉ dùng để tạo new transaction để lấy id thao tác
    public static function CreateNewRecordTransaction($type, $listing_id, $needMore=array()){
        $model = new ProTransactions();
        $model->status = STATUS_INACTIVE;
        if(!isset($needMore['user_id'])){
            $model->user_id = Yii::app()->user->id;
        }else{
            $model->user_id = $needMore['user_id'];
        }
        $model->type = $type;
        $model->listing_id = $listing_id?$listing_id:0;
        $model->scenario = 'create_draff_transaction';
        $model->save();
        return $model;
    }
    
    // ANH DUNG - chỉ dùng để tạo new transaction để lấy id thao tác
    public static function getByPk($pk){
        $model = ProTransactions::model()->findByPk($pk);
//        if(is_null($model)) // close at Apr 16, 2014 thấy ko cần thiết
//        {
//            $model = self::CreateNewRecordTransaction();
//        }
        return $model;
    }
    
    /**
     * @Author: ANH DUNG Apr 01, 2014
     * @Todo: convert some field date to db date before save
     * @Param: $model model transaction
     */
    public static function convertToDbDate($model){
        $model->otp_contract_date = MyFormat::dateConverDmyToYmd($model->otp_contract_date);
        $model->tenancy_agreement_date = MyFormat::dateConverDmyToYmd($model->tenancy_agreement_date);
        $model->commencement_date = MyFormat::dateConverDmyToYmd($model->commencement_date);
        $model->expiring_date = MyFormat::dateConverDmyToYmd($model->expiring_date);
        $model->appointment_date_hdb_only = MyFormat::dateConverDmyToYmd($model->appointment_date_hdb_only);
    }
    
    /**
     * @Author: ANH DUNG Apr 01, 2014
     * @Todo: convert some field db date to user interface date
     * @Param: $model model transaction
     */
    public static function convertToUserDate($model){
        if(is_null($model)) return;
        $model->otp_contract_date = MyFormat::dateConverYmdToDmy($model->otp_contract_date, 'd/m/Y');
        $model->commencement_date = MyFormat::dateConverYmdToDmy($model->commencement_date, 'd/m/Y');
        $model->expiring_date = MyFormat::dateConverYmdToDmy($model->expiring_date, 'd/m/Y');
        $model->appointment_date_hdb_only = MyFormat::dateConverYmdToDmy($model->appointment_date_hdb_only, 'd/m/Y');
        $model->tenancy_agreement_date = MyFormat::dateConverYmdToDmy($model->tenancy_agreement_date, 'd/m/Y');
    }
    
    /**
     * @Author: ANH DUNG Apr 14, 2014
     * @Todo: map some field from listing to transaction
     * @Param: $model model transaction
     */
    public static function copyFromListingToTransaction($model){
        $cAction = Yii::app()->controller->action->id;
        $cModule = Yii::app()->controller->module->id;
        if(isset($_GET['update_transactions']) 
                || ($cAction == 'update' && $cModule=='admin' && !isset($_GET['change_listing'])) ) return;
        $mListing = Listing::model()->findByPk($model->listing_id);
        if(is_null($mListing)) return;
        $model->mPropertyDetail->property_type_id = $mListing->property_type_1;
        $model->mPropertyDetail->listing_type_id = ProTransactionsPropertyDetail::VAR_INDIVIDUAL;
        if(!empty($mListing->company_listing_id) && $mListing->company_listing_id>0){
            $model->mPropertyDetail->listing_type_id = ProTransactionsPropertyDetail::VAR_COMPANY;
        }        
        $model->mPropertyDetail->house_blk_no = $mListing->property_house_blk_no;
        $model->mPropertyDetail->street_name = $mListing->property_street_name;
        $model->mPropertyDetail->postal_code = $mListing->postal_code;
        $model->mPropertyDetail->no_of_bedroom = $mListing->of_bedroom;
        $model->mPropertyDetail->tenure = $mListing->tenure;
        $model->mPropertyDetail->unit_no = $mListing->unit_from.'-'.$mListing->unit_to;
        $model->mPropertyDetail->building_name = $mListing->property_building_name;
//        $model->mPropertyDetail->built_in_area = $mListing->sdffsdfsdf;
//        $model->mPropertyDetail->land_area = $mListing->sdffsdfsdf;
    }
    
    
    public static function deleteArrModel($mDel){
        if(count($mDel)>0)
        foreach ($mDel as $item)
                $item->delete();	
    }
    
    public function beforeDelete()
    {
        $mDel = ProTransactionsBillTo::model()->findAll('transactions_id ='.$this->id);
        self::deleteArrModel($mDel);

        $mDel = ProTransactionsInternalCoBroke::model()->findAll('transactions_id ='.$this->id);
        self::deleteArrModel($mDel);
        $mDel = ProTransactionsPropertyDetail::model()->findAll('transactions_id ='.$this->id);
        self::deleteArrModel($mDel);
        $mDel = ProTransactionsPropertyDocument::model()->findAll('transactions_id ='.$this->id);
        self::deleteArrModel($mDel);
        $mDel = ProTransactionsVendorPurchaserDetail::model()->findAll('transactions_id ='.$this->id);
        self::deleteArrModel($mDel);
        $mDel = ProTransactionsSaveCommission::model()->findAll('transactions_id ='.$this->id);
        self::deleteArrModel($mDel);
        $mDel = ProTransactionsInvoice::model()->findAll('transactions_id ='.$this->id);
        self::deleteArrModel($mDel);
        
        return parent::beforeDelete(); 
    }
    
    
    //$errorLandLord
    /**
     * @Author: ANH DUNG Apr 28, 2014
     * @Todo: to validate landlord and tenant list
     * @Param: $mTransactions model transaction
     */
    public static function validateLandlordTenant($mTransactions){
        self::validateLandLord($mTransactions, 'mLandlord', Users::USER_LANDLORD);
        self::validateLandLord($mTransactions, 'mTenant', Users::USER_TENANT);
    }
    
    /**
     * @Author: ANH DUNG Oct 28, 2014
     * @Todo: to validate vendor and purchaser list
     * @Param: $mTransactions model transaction
     */
    public static function validateVendorPurchaser($mTransactions){
        self::validateLandLord($mTransactions, 'mVendor', Users::USER_VENDOR);
        self::validateLandLord($mTransactions, 'mPurchaser', Users::USER_PURCHASER);
    }
    
    // validate email and nric of list landlord
    /**
     * @Author: ANH DUNG Oct 28, 2014
     * @Todo: something
     * @Param: $mTransactions model trans
     * @Param: $nameModel is sub model of transaction, value maybe : mLandlord, mTenant...
     * @Param: $type Users::USER_LANDLORD, Users::USER_TENANT
     */
    public static function validateLandLord($mTransactions, $nameModel, $type){
        if(!ProTransactions::ValidateRequiredDetail($mTransactions, $nameModel, $type)){
            return ;
        }
        $criteria=new CDbCriteria;

        //$criteria->compare('t.is_new_user', 1);

        $criteria->compare('t.type', $type);
        $criteria->compare('t.transactions_id', $mTransactions->id);
        $models = ProTransactionsVendorPurchaserDetail::model()->findAll($criteria);
        $aError = array();
        $aEmail = array();
        $aNric = array();
        if($type==Users::USER_TENANT && empty($mTransactions->mTenatDefault->id )){
            // thêm validate duplidate cho tenant default
            $aEmail[] = trim($mTransactions->mTenatDefault->email);
            $aNric[] = trim($mTransactions->mTenatDefault->nric_passportno_roc);
        }
        
        if(count($models)){
            foreach($models as $item){
                // ANH DUNG May 12, 2015
                if(self::isUserSystem($item->user_id)){
                    continue;
                }
                // ANH DUNG May 12, 2015
                
                if(trim($item->email)!='')
                    $aEmail[] = trim($item->email);
                $aNric[] = trim($item->nric_passportno_roc);
                Users::validateEmailLandlordTenant($item);// $item is model landlord
                if($item->getError('email')){
                    $aError['email'][] = $item->getError('email');
                }
                if($item->getError('nric_passportno_roc')){
                    $aError['nric_passportno_roc'][] = $item->getError('nric_passportno_roc');
                }
            }
            
            // check same value in submit
            // http://stackoverflow.com/questions/1170807/how-to-detect-duplicate-values-in-php-array
            $aEmailCount = array_count_values($aEmail);
            $aNricCount = array_count_values($aNric);
            foreach ($aEmailCount as $value=>$count){
                if($count>1){
                    $aError['email'][] = "Email $value can not duplicate.";
                }
            }
            foreach ($aNricCount as $value=>$count){
                if($count>1){
                    $aError['nric_passportno_roc'][] = "NRIC $value can not duplicate.";
                }
            }
            // check same value in submit
        }
        
        if(count($aError)){
            $mTransactions->$nameModel->clearErrors();
            $mTransactions->$nameModel->addErrors ($aError);
        }
    }
    
    /**
     * @Author: ANH DUNG May 12, 2015
     * @Todo: Kiểm tra tenant hay landlord đã là user hệ thống chưa
     * nếu là rồi thì return true (nghĩa là không cần validate ), else false
     * @Param: $pk primary key of model Users
     */
    public static function isUserSystem($pk) {
        $mUser = Users::model()->findByPk($pk);
        if($mUser && $mUser->role_id ){
            return true;
        }
        return false;
    }
    
    /**
     * @Author: ANH DUNG Oct 28, 2014
     * @Todo: 3). details of Purchasers, vendors, 
     * tenants & landlords must be mandatory for transaction submission.
     * @Param: $mTransactions model trans
     * @Param: $nameModel is sub model of transaction, value maybe : mLandlord, mTenant...
     * @Param: $type Users::USER_LANDLORD, Users::USER_TENANT
     */
    public static function ValidateRequiredDetail($mTransactions, $nameModel, $type) {
        $criteria=new CDbCriteria;
        $criteria->compare('t.type', $type);
        $criteria->compare('t.transactions_id', $mTransactions->id);
        $models = ProTransactionsVendorPurchaserDetail::model()->findAll($criteria);
        $aError = array();
        if(count($models) < 1 && $nameModel != 'mTenant'){
            $aError['email'][] = "Detail ".Users::$USER_TYPE_DETAIL[$type]." must be mandatory";
            $mTransactions->$nameModel->clearErrors();
            $mTransactions->$nameModel->addErrors ($aError);
            return false;
        }
        return true;
    }
        
    /**
     * @Author: ANH DUNG Jul 16, 2014
     * @Todo: update status transaction
     * @Param: $model model  trans
     */
    public static function UpdateStatusTrans($pk, $status){
        $model = self::model()->findByPk($pk);
        if($model){
            $model->status = $status;
            $model->update(array('status'));
        }
    }
    
    /**
     * @Author: ANH DUNG Jul 16, 2014
     * @Todo: update status transaction
     * @Param: $model model ProTransactions
     */
    public static function UpdateAdminStatus($model, $statusAdmin){
        $model->admin_approved = $statusAdmin;
        $model->update(array('admin_approved'));
        // next update to transaction commisson
        ProTransactionsSaveCommission::UpdateAdminStatus($model, $statusAdmin);
        if($statusAdmin){
            // 1. email to all new user trong table pro_pro_transactions_vendor_purchaser_detail
            ProTransactions::CreateNewTenantLandlordAndSendMail($model);
            // 1. update status Close listing if it is company listing
            $mListing = $model->rListing;
            if($mListing && $mListing->company_listing_id){
                Listing::SetStatusCloseForCompanyListing($mListing->company_listing_id);
            }
        }
    }
    
    /**
     * @Author: ANH DUNG Mar 05, 2015
     * @Todo: only create tenant and landlord then send mail
     * @Param: $model ProTransactions
     */
    public static function CreateNewTenantLandlordAndSendMail($model) {
        ProTransactionsVendorPurchaserDetail::updateRoleUserAfterCreateUpdateTransaction($model->id);
        ProTransactionsVendorPurchaserDetail::sendMailToNewUser($model->id, $model);
    }
    
    public static function deleteTransExpiredAfterDays(){
        return ;// Feb 02, 2015  sẽ không xóa trans vì còn để user view nữa, vì cũng không có yêu cầu xóa nên kệ nó thôi
        $days = 100;
        if($days<0 || empty($days)) return;
        $criteria=new CDbCriteria;
        $criteria->addCondition("DATE_ADD(t.created_date,INTERVAL $days DAY) < CURDATE() AND t.status=0");
        //select * from `pro_pro_transactions` where  DATE_ADD(created_date,INTERVAL 1 DAY) <= CURDATE() AND  status=0
        $models = ProTransactions::model()->findAll($criteria);
        if(count($models)>0)
            foreach($models as $item)
                $item->delete();
    }
    
    /**
     * @Author: ANH DUNG Aug 13, 2014
     * @Todo: replace link cms to live site
     */
    public static function ReplaceCmsLinkLiveSite(){
        set_time_limit(7200);
        $find = 'verzview.com/verzpropertyinfo/demo';
        $replace = 'propertyinfologic.com.sg/demo';
        $models = Pages::model()->findAll();
        foreach($models as $item){
            $item->external_link = str_replace($find, $replace, $item->external_link);
            $item->content = str_replace($find, $replace, $item->content);
            $item->update(array('content','external_link'));
        }
        echo 'Done: '.count($models);die;
    }
    
 
    /**
     * @Author: ANH DUNG Sep 19, 2014
     * @Todo: get summary report of transaction
     * @Param: $model model ProTransaction
     */
    public function SummaryReport() {
        if(empty($this->date_from)){
            $this->date_from = date("d/m/Y");
        }
        if(empty($this->date_to)){
            $this->date_to = date("d/m/Y");
        }
        $date_from = MyFormat::dateConverDmyToYmd($this->date_from)." 00:00:00";;
        $date_to = MyFormat::dateConverDmyToYmd($this->date_to)." 23:59:59";
        $criteria = new CDbCriteria();
        $criteria->addBetweenCondition("t.created_date",$date_from,$date_to);
        $criteria->compare('t.admin_approved', 1);
//        $criteria->addCondition('t.status > 0');
        $criteria->addInCondition('t.status', ProTransactions::$LIST_STATUS_REAL); // add on Now 28, 2014
        $criteria->order = "t.id DESC";
        $mTransTemp = new ProTransactions();
        $mTransTemp->date_from = $date_from;
        $mTransTemp->date_to = $date_to;
        // get Gross Commission to Company and pass to session
        ProTransactionsSaveCommission::ReportGetAllClientComm($mTransTemp);
        ProTransactionsSaveCommission::ReportGetAll1st2nd($mTransTemp);
        ProTransactionsSaveCommission::ReportGetAllCommCompany($mTransTemp);
        $_SESSION['DATA_SUMMARY_REPORT'] = new CActiveDataProvider('ProTransactions', array(
            'pagination'=>false,
            'criteria'=>$criteria,
        ));
        
        ProTransactionsSaveCommission::SumReportGetInfoExternalCoBroke($_SESSION['DATA_SUMMARY_REPORT']->data);
        
        return new CActiveDataProvider('ProTransactions', array(
            'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=> 50,
            )
        ));
    }
    
     /**
     * @Author: ANH DUNG Sep 21, 2014
     * @Todo: calc report summary
     * @Param: $model model 
     */
    public static function ToExcelReport(){
        if( isset($_SESSION['DATA_SUMMARY_REPORT']) && isset($_GET['to_excel']) && count($_SESSION['DATA_SUMMARY_REPORT']->data)){
            ExportExcel::SummaryReport();
        }
    }    
    
    /**
     * @Author: ANH DUNG Nov 03, 2014
     */
    protected function beforeValidate() {
        $this->tenancy_amount = str_replace(",", "", $this->tenancy_amount);
        $this->deposit_payable = str_replace(",", "", $this->deposit_payable);
        
        $this->transacted_price = str_replace(",", "", $this->transacted_price);
        $this->valuation_price = str_replace(",", "", $this->valuation_price);
        $this->tenancy_amount = str_replace(",", "", $this->tenancy_amount);        
        
        return parent::beforeValidate();
    }    
 
    /**
     * @Author: ANH DUNG Jan 13, 2015
     */
    protected function beforeSave() {
        $this->tenancy_amount = (float)str_replace(",", "", $this->tenancy_amount);
        $this->deposit_payable = (float)str_replace(",", "", $this->deposit_payable);
        
        $this->transacted_price = (float)str_replace(",", "", $this->transacted_price);
        $this->valuation_price = (float)str_replace(",", "", $this->valuation_price);
        $this->created_by = Yii::app()->user->id;
        // Jan 22, 2015 fix track id admin tao company listing lai
        $mListing = Listing::model()->findByPk($this->listing_id);
        if($mListing){
            $this->company_listing_user_created = $mListing->company_listing_user_created;
        }
        // Jan 22, 2015 fix track id admin tao company listing lai
        
        return parent::beforeSave();
    }
    
    /**
     * @Author: ANH DUNG Dec 02, 2014
     * @Todo: update status transaction only tenancy
     * @Param: $model model ProTransactions
     * @Param: $status number
     */
    public static function UpdateTenancyStatus($mTransactions, $status){
        $mTransactions->status = $status;
        $mTransactions->update(array('status'));
        // nexxt update to transaction commisson        
        if( $status == STATUS_TENANCY_APPROVE ){
            // Dec 01, 2014 Once tenancy is submitted, admin need to approve.
            //  Once admin approved, LL and Tenant account will automatically send an email with Login ID and Password (generated) to Tenant and LL. 
            ProTransactionsVendorPurchaserDetail::updateRoleUserAfterCreateUpdateTransaction($mTransactions->id);
            ProTransactionsVendorPurchaserDetail::sendMailToNewUser($mTransactions->id, $mTransactions);
        }        
    }
    
    /**
     * @Author: ANH DUNG Dec 02, 2014
     * @Todo: get Property Name by model transaction
     * @Param: $mTransactions
     */
    public static function GetPropertyNameByModelTrans($mTransactions) {
        $res = '';
        $mTransactonPropertyDetail = $mTransactions->rPropertyDetail;
        if($mTransactonPropertyDetail){
            $res = $mTransactonPropertyDetail->property_name_or_address;
        }
        return $res;
    }
    
    
    /**
     * @Author: ANH DUNG Dec 02, 2014
     * @Todo: Tenancy expiring - system will send email to LL,Tenant, Agent and Admin 
     * on the date when exact date 3 months before expiring.
     * @Param: $model
     * for sql test: SELECT * FROM `pro_users` WHERE expiration_date < DATE_ADD(CURDATE(), INTERVAL 1 MONTH)
        ORDER BY `pro_users`.`expiration_date`  ASC
     */
    public static function GetListTenancyExpiring() {
        $month_expiry_alert = Yii::app()->setting->getItem('month_expiry_alert');
        $criteria =new CDbCriteria;
        $criteria->addCondition(" t.expiring_date = DATE_ADD(CURDATE(), INTERVAL $month_expiry_alert DAY) ");
        $criteria->addInCondition('t.status', ProTransactions::$LIST_STATUS_FOR_TENANT);
        return self::model()->findAll($criteria);
    }
    
    /**
     * @Author: ANH DUNG Dec 02, 2014
     * Tenancy: hợp đồng thuê nhà
     * @Todo: cron  send email to LL,Tenant, Agent and Admin 
     * on the date when exact date 3 months before expiring.
     * lấy những transaction ( Tenancy là hợp đồng thue nhà) dc approved và sắp hết hạn trong 3 tháng và send mail
     */
    public static function CronSendMailTenancyExpiring() {
        /* 1. get list tenant 3 months later will expiring.
         * ProTransactions::GetListTenancyExpiring()
         * 2. foreach transaction and get list id of LL,Tenant, Agent and Admin 
         *  and send with email template
         * 3. send for LL and Tenant
         * 4. send for agent and admin
         */
        $aModelTenancyExpiring = ProTransactions::GetListTenancyExpiring();
        foreach( $aModelTenancyExpiring as $mTransaction ){
            SendEmail::MailToLandlordTenant($mTransaction);
            SendEmail::MailToAgentAdmin($mTransaction);
        }        
    }
    
    /**
     * @Author: ANH DUNG Jan 13, 2015
     * @Todo: FE - get link update tenancy
     * @Params: $mTransaction
     */
    public static function GetLinkUpdateTenancy($mTransaction) {
        return Yii::app()->createAbsoluteUrl("member/member_profile/record_existing_tenancy", array("update_tenancy"=>1,"id"=>$mTransaction->id, "type"=>$mTransaction->type, "listing_id"=>$mTransaction->listing_id, "add_property"=>$mTransaction->add_property ));
    }
    
    /**
     * @Author: ANH DUNG Feb 11, 2015
     * @Todo: FE - get link delete tenancy
     * @Params: $mTransaction
     */
    public static function GetLinkDeleteTenancy($mTransaction) {
        return Yii::app()->createAbsoluteUrl("member/agent/delete_tenancy", array("id"=>$mTransaction->id));
    }
        
    // BE - for update tenancy draft in BE
    public static function GetLinkUpdateTenancyBE($mTransaction, $needMore=array()) {
        if(isset($needMore['update_tenancy_approved'])){
            return Yii::app()->createAbsoluteUrl("admin/tenancy/update", array("id"=>$mTransaction->id, "type"=>$mTransaction->type, "listing_id"=>$mTransaction->listing_id, "add_property"=>$mTransaction->add_property, 'user_id'=>$mTransaction->user_id ));
        }elseif(isset($needMore['update_transactions'])){
            return Yii::app()->createAbsoluteUrl("admin/transactions/update", array("id"=>$mTransaction->id, "type"=>$mTransaction->type, "listing_id"=>$mTransaction->listing_id, "add_property"=>$mTransaction->add_property, 'user_id'=>$mTransaction->user_id ));
        }
        //http://localhost/verz/propertyinfo/admin/transactions/createTenancy/add_property/1/id/517/type/1/listing_id/0/user_id/299
        return Yii::app()->createAbsoluteUrl("admin/tenancy/createTenancy", array("update_tenancy"=>1,"id"=>$mTransaction->id, "type"=>$mTransaction->type, "listing_id"=>$mTransaction->listing_id, "add_property"=>$mTransaction->add_property, 'user_id'=>$mTransaction->user_id ));
    }
    
    /**
     * @Author: ANH DUNG Feb 19, 2015
     * @Todo: BE - for update tenancy approved in BE
     * @Param: $model ProTransactionsVendorPurchaserDetail
     */
    public static function GetLinkUpdateLandlordBE($mVendorPurchaserDetail, $needMore=array()) {
        $mTransaction = $mVendorPurchaserDetail->rTransactionOnly;
        $link = "";
        if( ProTransactions::IsTenancyTransaction($mTransaction) ):
            $link = Yii::app()->createAbsoluteUrl("ajax/agentUpdateLandlord",
                                    array("id"=>$mVendorPurchaserDetail->id, 'from_transactions'=>1));
        else :
            $link = Yii::app()->createAbsoluteUrl("ajax/agentUpdateLandlord",
                                    array("id"=>$mVendorPurchaserDetail->id));
        endif;
        return $link;
        //http://localhost/verz/propertyinfo/admin/transactions/createTenancy/add_property/1/id/517/type/1/listing_id/0/user_id/299
        return Yii::app()->createAbsoluteUrl("admin/tenancy/createTenancy", array("update_tenancy"=>1,"id"=>$mTransaction->id, "type"=>$mTransaction->type, "listing_id"=>$mTransaction->listing_id, "add_property"=>$mTransaction->add_property, 'user_id'=>$mTransaction->user_id ));        
    }
    
    /**
     * @Author: ANH DUNG Feb 02, 2015
     * @Todo: validate can update tenancy
     * @Param: $mTransaction
     * update neu co  receipt thi khong cho update, 
     * Delete thi chi hide tenancy di, con transaction khong xoa
     * @Return: 1:cho update, 0 can not update
     */
    public static function CanUpdateTenancyApproved($mTransaction) {
        if($mTransaction->status == STATUS_GEN_RECEIPT)
            return 0;
        return 1;        
    }
    
    /**
     * @Author: ANH DUNG Feb 02, 2015
     * @Todo: check tenancy transaction or not transaction
     * @Param: $mTransaction
     */
    public static function IsTenancyTransaction($mTransaction) {        
        if($mTransaction->status != STATUS_TENANCY_APPROVE ):
            return true;
        endif;
        return false;
    }
    
    // belong to: actionCreateTenancy xử lý lấy 1 số thông tin của model transaction 
    public static function GetSomeInfoRecord($mTransactions, $add_property){
        $mTransactions->add_property = $add_property;
        $mTransactions->type = isset($_GET['type'])?$_GET['type']:ProTransactions::FOR_RENT;
        $mTransactions->listing_autocompelte = '';
        if(isset($_GET['listing_id']) && $_GET['listing_id']){
            $mTransactions->listing_id = $_GET['listing_id'];
            $mTransactions->listing_autocompelte = $mTransactions->listing?$mTransactions->listing->property_name_or_address:'';
        }
        $mTransactions->mPropertyDetail = $mTransactions->rPropertyDetail?$mTransactions->rPropertyDetail:( new ProTransactionsPropertyDetail() );
        $mTransactions->aModelPropertyDocument = count($mTransactions->rPropertyDocument)?$mTransactions->rPropertyDocument:( ProTransactionsPropertyDocument::getDefaultArrayForCreate($mTransactions->type) );        
        $mTransactions->mTenatDefault = $mTransactions->rTenantDefault?$mTransactions->rTenantDefault:( new ProTransactionsVendorPurchaserDetail() );
        ProTransactionsVendorPurchaserDetail::OverideModel($mTransactions->mTenatDefault);

        $mTransactions->mLandlord = new ProTransactionsVendorPurchaserDetail();
        $mTransactions->mTenant = new ProTransactionsVendorPurchaserDetail();
        $mTransactions->mVendor = new ProTransactionsVendorPurchaserDetail();
        $mTransactions->mPurchaser = new ProTransactionsVendorPurchaserDetail();
        
        $mTransactions->mBillTo = new ProTransactionsBillTo();
        
        $mTransactions->mPropertyDetail->scenario = 'CreateTransactionTenancyOnly';
        $mTransactions->mTenatDefault->scenario = 'AgentAddTenantFromTenancy';
        $mTransactions->scenario = 'CreateTransactionForRentRecordTenancy_new'; // for rent //CreateTransactionForRentRecordTenancy
        ProTransactions::copyFromListingToTransaction($mTransactions);
        ProTransactions::convertToUserDate($mTransactions);
        
        // Feb 02, 2015 , fix for update transaction
        $cAction = Yii::app()->controller->action->id;
        if( $cAction == 'update' && ProTransactions::IsTenancyTransaction($mTransactions) ){
            $mTransactions->mBillTo = $mTransactions->rBillTo?$mTransactions->rBillTo:( new ProTransactionsBillTo());
            $mTransactions->mBillTo->scenario = 'CreateVendorPurchaser';
        }
        // Feb 02, 2015 , fix for update transaction        
    }
    
    /**
     * @Author: ANH DUNG Jan 13, 2015
     * @Todo: get attribute from post
     */
    public static function GetPostOnly( &$mTransactions) {
        $mTransactions->attributes = $_POST['ProTransactions'];
        $mTransactions->mPropertyDetail->attributes = $_POST['ProTransactionsPropertyDetail'];
        $mTransactions->mBillTo->attributes = isset($_POST['ProTransactionsBillTo'])?$_POST['ProTransactionsBillTo']:array();
        $mTransactions->mPropertyDocument = new ProTransactionsPropertyDocument();
        $mTransactions->mPropertyDocument->attributes = $_POST['ProTransactionsPropertyDocument'];
        $mTransactions->mTenatDefault->attributes = isset($_POST['ProTransactionsVendorPurchaserDetail'])?$_POST['ProTransactionsVendorPurchaserDetail']:array();
        //add
        $FileInput = $_FILES["ProTransactionsVendorPurchaserDetail"]["name"]["scanned_employment_pass"];
        $FileInput2 = $_FILES["ProTransactionsVendorPurchaserDetail"]["name"]["scanned_passport"];
        if(!empty($FileInput)){
            $mTransactions->mTenatDefault->scanned_employment_pass  = CUploadedFile::getInstance($mTransactions->mTenatDefault,'scanned_employment_pass');
        }
        if(!empty($FileInput2)){
            $mTransactions->mTenatDefault->scanned_passport  = CUploadedFile::getInstance($mTransactions->mTenatDefault,'scanned_passport');
        }
//        $mTransactions->mTenatDefault->scanned_employment_pass  = CUploadedFile::getInstance($mTransactions->mTenatDefault,'scanned_employment_pass');
//        $mTransactions->mTenatDefault->scanned_passport  = CUploadedFile::getInstance($mTransactions->mTenatDefault,'scanned_passport');
    }    
    
    
    // Dec 01, 2014 xử lý bắt biến post và gọi validate cho các model, tách ra cho dễ nhìn
    public static function GetPostAndValidateTenancy($mTransactions){
        ProTransactions::GetPostOnly($mTransactions);
        $mTransactions->validate();
        $mTransactions->mPropertyDetail->validate();
        if($mTransactions->type==ProTransactions::FOR_RENT){ // it alway for rent
            if(!empty($mTransactions->mTenatDefault->user_id))
                $mTransactions->mTenatDefault->scenario = 'AgentAddTenantExitUid';
            $mTransactions->mTenatDefault->validate();
            Users::validateDefaultTenant($mTransactions->mTenatDefault);
        }
        $cAction = Yii::app()->controller->action->id;
        if( $cAction == 'update' && ProTransactions::IsTenancyTransaction($mTransactions) ){
            if($mTransactions->mBillTo->bill_to_id==ProTransactions::BILL_TO_SOLICITOR){
                $mTransactions->mBillTo->scenario = 'CreateVendorPurchaserSolicitorSelected';
            }elseif($mTransactions->mBillTo->bill_to_id==ProTransactions::BILL_TO_EXTERNAL_CO_BROKE){
                $mTransactions->mBillTo->scenario = 'ExternalCoBrokeSelected';
                ProTransactionsBillTo::ResetVal($mTransactions->mBillTo);
            }
            $mTransactions->mBillTo->validate();
        }

        ProTransactionsPropertyDocument::validateFile($mTransactions);
        if($mTransactions->type==ProTransactions::FOR_RENT){
            ProTransactions::validateLandlordTenant($mTransactions);
        }else{
            // for sale - validate for vendor and purcharser
            ProTransactions::validateVendorPurchaser($mTransactions);
        }
    }
    
    /**
     * @Author: ANH DUNG Jan 13, 2015
     * @Todo: Save Draft Only
     * @Param: $mTransactions
     */
    public static function HandleSaveAsDraftOnlySave( &$mTransactions ) {
        ProTransactions::convertToDbDate($mTransactions);
        $prefix_code = "T".date('Y').date('m');
        if(!isset($_GET['update_transactions'])){
            $mTransactions->transactions_no = MyFormat::getNextId('ProTransactions',$prefix_code,'transactions_no',ProTransactions::LENGTH_TRANS_NO);
        }                    
        $mTransactions->status = STATUS_TENANCY_DRAFT;
        $mTransactions->is_admin_created = 1;
        $mTransactions->update();// save transaction
        // save  mPropertyDetail
        $mTransactions->mPropertyDetail->transactions_id = $mTransactions->id;
        $mTransactions->mPropertyDetail->listing_id = $mTransactions->listing_id;
        $mTransactions->mPropertyDetail->scenario = null;
        $mTransactions->mPropertyDetail->save();
        // save tenant
        if($mTransactions->type==ProTransactions::FOR_RENT){
            $mTransactions->mTenatDefault->transactions_id = $mTransactions->id;
            ProTransactionsVendorPurchaserDetail::saveOneTenant($mTransactions->mTenatDefault, 1, array('scenario_null'=>1));
            // update new expiration date for tenant to check login
            ProTransactionsVendorPurchaserDetail::updateExpirationTenant($mTransactions);
        }
        // end save tenant
        //save ProTransactionsPropertyDocument
        ProTransactionsPropertyDocument::saveRecord($mTransactions);
    }
    
    
    /**
     * @Author: ANH DUNG Jan 13, 2015
     * @Todo: Handle SaveAsDraft tenancy
     */
    public static function HandleSaveAsDraft($mTransactions) {
        if( isset($_POST['SaveAsDraft']) && $_POST['SaveAsDraft'] == 1 ){
            ProTransactions::GetPostOnly($mTransactions);
            ProTransactions::HandleSaveAsDraftOnlySave($mTransactions);
            $link = Yii::app()->createAbsoluteUrl('admin/tenancy/tenancies_draft');
            Yii::app()->controller->redirect( $link );
            // may be redirect to view
        }
    }
    
    /**
     * @Author: ANH DUNG Dec 01, 2014
     * @Todo: handle POST for create tenancy without create transaction
     * @belongto: actionCreateTenancy
     */
    public static function HandlePost($mTransactions) {
        if(isset($_POST['ProTransactionsPropertyDetail'])){
            ProTransactions::HandleSaveAsDraft($mTransactions);
            ProTransactions::GetPostAndValidateTenancy($mTransactions);
            if(!$mTransactions->hasErrors() && 
                        !$mTransactions->mPropertyDetail->hasErrors() &&
                        !$mTransactions->mTenatDefault->hasErrors() &&
                        !$mTransactions->mTenatDefault->hasErrors() &&
                        !$mTransactions->mTenant->hasErrors() &&
                        !$mTransactions->mPropertyDocument->hasErrors() &&
                        !$mTransactions->mBillTo->hasErrors() &&
                        !$mTransactions->mVendor->hasErrors() &&
                        !$mTransactions->mPurchaser->hasErrors()
                        ){                
                ProTransactions::convertToDbDate($mTransactions);
                $prefix_code = "T".date('Y').date('m');
//                if(!isset($_GET['update_transactions'])){
                if( !strlen($mTransactions->transactions_no) ){// Fix Feb 03, 2015 for update tenancy and trans
                    $mTransactions->transactions_no = MyFormat::getNextId('ProTransactions',$prefix_code,'transactions_no',ProTransactions::LENGTH_TRANS_NO);
                }
                
                $link = Yii::app()->createAbsoluteUrl('admin/tenancy/view', array('id'=>$mTransactions->id));
                $cController = strtolower(Yii::app()->controller->id);
                if( $cController == "transactions" ){ // Feb 03, 2015 , fix for update transaction
                    $link = Yii::app()->createAbsoluteUrl('admin/transactions/view', array('id'=>$mTransactions->id));
                }
//                $mTransactions->status = STATUS_TENANCY_NEW;
                // Feb 02, 2015 , fix for update transaction
                $cAction = Yii::app()->controller->action->id;
                if( $cAction != 'update' ){
                    $mTransactions->status = STATUS_TENANCY_APPROVE;
                }
                // Feb 02, 2015 , fix for update transaction
                $mTransactions->save();// save transaction
                // save  mPropertyDetail
                $mTransactions->mPropertyDetail->transactions_id = $mTransactions->id;
                $mTransactions->mPropertyDetail->listing_id = $mTransactions->listing_id;
                $mTransactions->mPropertyDetail->save();
                
                //save mBillTo
                $mTransactions->mBillTo->transactions_id = $mTransactions->id;
                $mTransactions->mBillTo->client_type_id = $mTransactions->client_type_id;
                $mTransactions->mBillTo->type = ProTransactionsBillTo::TYPE_VENDOR_PURCHASER;
                $mUserBillTo = Users::saveUserExternalCoBroke($mTransactions->mBillTo, ROLE_EXTERNAL_CO_BROKE);
                $mTransactions->mBillTo->user_id = $mUserBillTo->id;
                if( $cAction == 'update' && ProTransactions::IsTenancyTransaction($mTransactions) ){
                    $mTransactions->mBillTo->save();// save mBillTo
                }
                
                // save tenant
                if($mTransactions->type==ProTransactions::FOR_RENT){
                    $mTransactions->mTenatDefault->transactions_id = $mTransactions->id;
                    ProTransactionsVendorPurchaserDetail::saveOneTenant($mTransactions->mTenatDefault, 1);
                    // update new expiration date for tenant to check login
                    ProTransactionsVendorPurchaserDetail::updateExpirationTenant($mTransactions);
                }
                // end save tenant
                //save ProTransactionsPropertyDocument
                ProTransactionsPropertyDocument::saveRecord($mTransactions);
                $mTransactions = ProTransactions::LoadModelRelationByPk($mTransactions->id);
                
                // Mar 05, 2015 create landlord and send mail to new user if not yet send
                ProTransactions::CreateNewTenantLandlordAndSendMail($mTransactions);
                // Mar 05, 2015  create landlord and send mail to new user if not yet send
                
                // Feb 02, 2015 , fix for update transaction need for save Comm
                if( $cAction == 'update' && ProTransactions::IsTenancyTransaction($mTransactions) ){
                    // comm here
                    ProTransactionsBillTo::UpdateBillTo($mTransactions);
                    // Jun 16, 2014 đưa bill to lên trên save commission thì mới có đc rExternalCoBrokeCommission
                    // chỗ này find lại model của transaction để lấy hết relation - single query
                    $mTransactions = ProTransactions::LoadModelRelationByPk($mTransactions->id);
                    ProTransactionsSaveCommission::saveOneTransaction($mTransactions);
                    ProTransactionsInvoice::AutoGenInvoice($mTransactions);
                }
                // Feb 02, 2015 , fix for update transaction need for save Comm
                
                Yii::app()->controller->redirect( $link );
                // may be redirect to view
            }
        }
    }
    
    /**
     * @Author: ANH DUNG Feb 04, 2015
     * @Todo: check can update trans or tenancy
     * @Param: $mTransactions
     */
    public static function CanUpdateTrans( $mTransactions ) {
        if(!ProTransactions::CanUpdateTenancyApproved($mTransactions)){
            $link = Yii::app()->createAbsoluteUrl('admin');
            Yii::app()->controller->redirect( $link );
        }
    }
    
    /**
     * @Author: ANH DUNG Feb 11, 2015
     * @Todo: check user can delete tenancy
     */
    public static function CanDeleteTenancy($mTransactions) {
        $res = false;
        $cUid = Yii::app()->user->id;
        if( $mTransactions->user_id == $cUid && $mTransactions->status == STATUS_TENANCY_DRAFT ){
            $res = true;
        }
        return $res;
    }
    //HTram August 18, 2015
    public static function ShowCallsLogList($transaction_id){
        $re = '';
        $callslog = ProCallLog::getCallsLogByTransaction($transaction_id);
        $re .= '<table style="width:100%;">';
                $re .= '<thead>';
                    $re .= '<th class="th-small">S/N</th>';
                    $re .= '<th class="th-normal">Date Time</th>';
                    $re .= '<th class="th-normal">Received By</th>';
                    $re .= '<th class="th-big">Description</th>';
                    $re .= '<th class="th-normal">Person Call Type</th>';
                    $re .= '<th class="th-normal">Name</th>';
                    $re .= '<th class="th-normal">Mobile</th>';
                $re .= '</thead>';
            if($callslog){
                foreach ($callslog as $key=>$item){
                    $re .= '<tr>';
                        $re .= '<td>'.($key+1).'</td>';

                        $re .= '<td>'.$item->date.'</td>';

                        $re .= '<td>'.$item->received_by.'</td>';

                        $re .= '<td>'.MyFormat::replaceNewLineTextArea($item->description).'</td>';

                         $re .= '<td>';
                            $re .= isset(ProCallLog::$ARR_PERSON_CALL_TYPE[$item->person_call_type])?ProCallLog::$ARR_PERSON_CALL_TYPE[$item->person_call_type]:"";
                        $re .= '</td>';

                        $re .= '<td>'.$item->person_called.'</td>';

                        $re .= '<td>'.$item->phone.'</td>';
                    $re .= '</tr>';
                }
            }else{
                $re .= '<tr><td colspan="7"><span class="empty">No results found.</span></td></tr>';
            }
        $re .= '</table>';
        return $re;
    }
    //HTram August 24, 2015
    // belong to: actionUpdateTenancy xử lý lấy 1 số thông tin của model transaction with NO OVERIDEMODEL ProTransactionsVendorPurchaserDetail FROM Users
    public static function GetSomeInfoRecordWithNoOverideModel($mTransactions, $add_property){
        $mTransactions->add_property = $add_property;
        $mTransactions->type = isset($_GET['type'])?$_GET['type']:ProTransactions::FOR_RENT;
        $mTransactions->listing_autocompelte = '';
        if(isset($_GET['listing_id']) && $_GET['listing_id']){
            $mTransactions->listing_id = $_GET['listing_id'];
            $mTransactions->listing_autocompelte = $mTransactions->listing?$mTransactions->listing->property_name_or_address:'';
        }
        $mTransactions->mPropertyDetail = $mTransactions->rPropertyDetail?$mTransactions->rPropertyDetail:( new ProTransactionsPropertyDetail() );
        $mTransactions->aModelPropertyDocument = count($mTransactions->rPropertyDocument)?$mTransactions->rPropertyDocument:( ProTransactionsPropertyDocument::getDefaultArrayForCreate($mTransactions->type) );        
        $mTransactions->mTenatDefault = $mTransactions->rTenantDefault?$mTransactions->rTenantDefault:( new ProTransactionsVendorPurchaserDetail() );

        $mTransactions->mLandlord = new ProTransactionsVendorPurchaserDetail();
        $mTransactions->mTenant = new ProTransactionsVendorPurchaserDetail();
        $mTransactions->mVendor = new ProTransactionsVendorPurchaserDetail();
        $mTransactions->mPurchaser = new ProTransactionsVendorPurchaserDetail();
        
        $mTransactions->mBillTo = new ProTransactionsBillTo();
        
        $mTransactions->mPropertyDetail->scenario = 'CreateTransactionTenancyOnly';
        $mTransactions->mTenatDefault->scenario = 'AgentAddTenantFromTenancy';
        $mTransactions->scenario = 'CreateTransactionForRentRecordTenancy_new'; // for rent //CreateTransactionForRentRecordTenancy
        ProTransactions::copyFromListingToTransaction($mTransactions);
        ProTransactions::convertToUserDate($mTransactions);
        
        // Feb 02, 2015 , fix for update transaction
        $cAction = Yii::app()->controller->action->id;
        if( $cAction == 'update' && ProTransactions::IsTenancyTransaction($mTransactions) ){
            $mTransactions->mBillTo = $mTransactions->rBillTo?$mTransactions->rBillTo:( new ProTransactionsBillTo());
            $mTransactions->mBillTo->scenario = 'CreateVendorPurchaser';
        }
        // Feb 02, 2015 , fix for update transaction        
    }
    

    
}
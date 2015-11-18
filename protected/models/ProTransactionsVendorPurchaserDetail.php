<?php

/**
 * This is the model class for table "{{_pro_transactions_vendor_purchaser_detail}}".
 *
 * The followings are the available columns in table '{{_pro_transactions_vendor_purchaser_detail}}':
 * @property string $id
 * @property string $transactions_id
 * @property integer $type
 * @property string $user_id
 * @property string $name
 * @property string $nric_passportno_roc
 * @property string $contact_no
 * @property string $address
 * @property string $postal_code
 * @property integer $invoice_bill_to
 * @property string $billing_address
 * @property integer $id_type
 * @property string $pass_expiry_date
 * @property string $scanned_employment_pass
 * @property string $scanned_passport
 */
class ProTransactionsVendorPurchaserDetail extends CActiveRecord
{
    public static $AllowFile = 'doc,docx,pdf,jpg,jpeg,png';
    public static $folderUpload='upload/tenant';
    public $property_name_or_address;
    
    public $autocomplete_user_name;
    public $listing_id;
	
    public static function model($className=__CLASS__)
    {
            return parent::model($className);
    }

    public function tableName()
    {
            return '{{_pro_transactions_vendor_purchaser_detail}}';
    }

    public function rules()
    {
        return array(
            array('name, nric_passportno_roc', 'required', 'on'=>'AgentAddVendor, AgentUpdateVendor'),
            array('name, nric_passportno_roc, contact_no,address,postal_code', 'required', 'on'=>'AgentAddPurchaser, AgentUpdatePurchaser'),
            array('name, nric_passportno_roc, contact_no,postal_code', 'required', 'on'=>'AgentAddLandlord, AgentUpdateLandlord'), // default for transaction
            array('name, nric_passportno_roc', 'required', 'on'=>'AgentAddLandlordFromTenancy, AgentUpdateLandlordFromTenancy'), // Jan 12, 2015
            array('name, nric_passportno_roc', 'required', 'on'=>'AgentAddLandlordUnlisted, AgentUpdateLandlordUnlisted'), // Jan 21, 2015
            array('email', 'email', 'on'=>'AgentAddLandlord,AgentUpdateLandlord,AgentAddTenant, AgentUpdateTenant,AgentAddVendor, AgentUpdateVendor'),
                        
            array('email, name, nric_passportno_roc,  contact_no,address,postal_code',
                'required', 'on'=>'AgentAddTenant'),
            array('name, nric_passportno_roc',
                'required', 'on'=>'AgentAddTenantFromTenancy'),// Jan 12, 2014
            
            array('user_id',
                'required', 'on'=>'AgentAddTenantExitUid'),
            
            array('name, nric_passportno_roc',
                'required', 'on'=>'AgentAddTenantUnlisted'),
            array('name, nric_passportno_roc',
                'required', 'on'=>'AgentUpdateTenantUnlisted'),
            
            array('email, name, nric_passportno_roc, contact_no,address,postal_code',
                'required', 'on'=>'AgentUpdateTenant'),
            array('name, nric_passportno_roc, address,postal_code',
                'required', 'on'=>'AgentUpdateTenantFromTenancy'),// Jan 12, 2014
            
            array('pass_expiry_date', 'PassExpiryDateCheck', 
                'on'=>'AgentAddTenant, AgentUpdateTenant,'
                . 'AgentAddTenantFromTenancy, AgentUpdateTenantFromTenancy'),
            
            array('scanned_employment_pass,scanned_passport', 'file','on'=>'AgentAddTenant, AgentUpdateTenant,'
                . 'AgentAddTenantFromTenancy, AgentUpdateTenantFromTenancy',
                'allowEmpty'=>true,
                'types'=> self::$AllowFile,
                'wrongType'=>Yii::t('lang', "Only ".self::$AllowFile." are allowed."),
            ), 
                        
            array('name, nric_passportno_roc, contact_no, address, billing_address, scanned_employment_pass, scanned_passport', 'length', 'max'=>255),
            array('postal_code,nric_passportno_roc, contact_no,postal_code ', 'length', 'max'=>  Users::MAX_LENGTH_NAME),
            array('id, transactions_id, type, user_id, name, nric_passportno_roc, contact_no, address, postal_code, invoice_bill_to, billing_address, id_type, pass_expiry_date, scanned_employment_pass, scanned_passport', 'safe'),
            array('listing_id,property_name_or_address,is_new_user,email', 'safe'),
            
            array('pass_expiry_date,scanned_employment_pass,scanned_passport','PassExpiryDateCheck'),
        );
    }
    //HTram August 20, 2015 : to check validate on some case depend on id_type 
//    public function CheckDateAndUpload($attribute, $params) {
//        if (isset($this->id_type) && trim($this->id_type)!='') {
//            $pass_expiry_date = $this->getAttributeLabel('pass_expiry_date');
//            $scanned_employment_pass = $this->getAttributeLabel('scanned_employment_pass');
//            $scanned_passport = $this->getAttributeLabel('scanned_passport');
//            if($this->id_type == Users::ID_TYPE_OTHER){
//                if(empty($this->pass_expiry_date) || ($this->pass_expiry_date == '0000-00-00' || ($this->pass_expiry_date == NULL))){
//                    $this->addError("pass_expiry_date", "$pass_expiry_date  cannot be blank..");
//                }
//                if(empty($this->scanned_employment_pass)){
//                    $this->addError("scanned_employment_pass", "$scanned_employment_pass  cannot be blank..");
//                }
//                if(empty($this->scanned_passport)){
//                    $this->addError("scanned_passport", "$scanned_passport  cannot be blank..");
//                }
//            }
//        }
//    } 

    public function InvoiceBillToCheck($attribute, $params) {
        if ($this->invoice_bill_to && trim($this->billing_address)=='') {
            $billing_address = $this->getAttributeLabel('billing_address');
            $this->addError("billing_address", "$billing_address  cannot be blank..");
        }
    }   
    
    public function PassExpiryDateCheck($attribute, $params) {
//        if($this->scenario == 'AgentAddTenantFromTenancy' || $this->scenario == 'AgentUpdateTenantFromTenancy'){
//            /**
//             * DTOAN CHANGE 14-5-2015--require orther
//             */
//            //return ; // ANH DUNG May 06, 2015
//            //Make them optional - Tenancy> Tenancy New> Create Tenancy: Tenant's Details-
//            // Pass expiry date, Employment pass Passport
//        }
        $old_pass_expiry_date  = "" ;
        $old_scanned_passport  = "" ;
        $old_upload_employment_pass_passport  = "" ;
        if($this->id){
             $OldModel = self::model()->findByPk($this->id);
             $old_pass_expiry_date = $OldModel->pass_expiry_date;
             $old_scanned_passport = $OldModel->scanned_passport;
             $old_upload_employment_pass_passport = $OldModel->scanned_employment_pass;
         }
        
        // ANH DUNG CLOSE AT Oct 02, 2014
        // ANH DUNG OPEN AT JAN 12, 2014
        if ( $this->id_type != '' && ( !in_array($this->id_type, Users::$ARR_ID_NOT_REQUIRED) )) {
            if((trim($this->pass_expiry_date)=='' || $this->pass_expiry_date=='0000-00-00' || $this->pass_expiry_date==NULL ) ){    
                $label = $this->getAttributeLabel('pass_expiry_date');
                $this->addError("pass_expiry_date", "$label  cannot be blank.");
            }
//            if(empty($this->scanned_passport) && empty($this->user_id)  && trim($old_scanned_passport) == "" ){
            if(empty($this->scanned_passport)  && trim($old_scanned_passport) == "" ){
                $label = $this->getAttributeLabel('scanned_passport');
                $this->addError("scanned_passport", strip_tags($label)." cannot be blank.");
            }
            if(empty($this->scanned_employment_pass)  && trim($old_upload_employment_pass_passport) == ""  ){
                $label = $this->getAttributeLabel('scanned_employment_pass');
                $this->addError("scanned_employment_pass", strip_tags($label)."  cannot be blank.");
            }
        }
    }    

    // to do save file scanned_employment_pass, scanned_passport
    // @param: $model model ProTransactionsVendorPurchaserDetail
    public static function saveSomeFile($model, $fieldName){        
        if(!is_null($model->$fieldName)){
            $count =1;
            if($fieldName=='scanned_passport')
                $count = 2;
            $model->$fieldName = self::saveFile($model, $fieldName, self::$folderUpload, $count);
            $model->update(array($fieldName));            
        }
        return $model->$fieldName;
    }    
    
     /**
     * Apr 01, 2014 - ANH DUNG
     * To do: save file 
     * @param: $model model ProTransactionsVendorPurchaserDetail
     * @param: $nameField ex: scanned_employment_pass, scanned_passport
     * @param: $pathUpload ex: 'upload/tenant'
     * @return: name of image
     */
    public static function  saveFile($model, $nameField, $pathUpload, $count)
    {
        if(is_null($model->$nameField)) return '';        
        $ext = $model->$nameField->getExtensionName();
        $fileName = MyFunctionCustom::slugify($model->$nameField->getName());
        $fileName = str_replace(strtolower($ext), '', $fileName);
        $fileName = trim($fileName, '-');
        $fileName = trim($fileName);
        $fileName = $fileName.'-'.time().$count.'.'.$ext;
//        $fileName = $fileName.'.'.$ext;
        $imageProcessing = new ImageProcessing();
        $imageProcessing->createDirectoryByPath($pathUpload.'/'.$model->id);
        $model->$nameField->saveAs($pathUpload.'/'.$model->id.'/'.$fileName);
        return $fileName;
    }      
    
    /**
     * Apr 01, 2014 - ANH DUNG
     * To do: delete file  of model ProTransactionsVendorPurchaserDetail
     * @param: $model ProTransactionsVendorPurchaserDetail
     * @param: $nameField ex: upload_employment_pass_passport
     * @param: $pathUpload ex: 'upload/tenant' 
     */    
    public static function deleteOldFile($model, $nameField)
    {
        $pathUpload = self::$folderUpload;
        $modelDel = self::model()->findByPk($model->id);
        if(is_null($modelDel) || empty($modelDel->$nameField))return;
        $ImageProcessing = new ImageProcessing();
        $ImageProcessing->folder = '/'.$pathUpload.'/'.$modelDel->id;
        $ImageProcessing->delete($ImageProcessing->folder.'/'.$modelDel->$nameField);
    }
    
    protected function beforeDelete() {
        self::deleteOldFile($this, 'scanned_employment_pass');
        self::deleteOldFile($this, 'scanned_passport');
        return parent::beforeDelete();
    }
    
    public function relations()
    {
        return array(
            'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
            'rUser' => array(self::BELONGS_TO, 'Users', 'user_id'),
            'relation_user' => array(self::BELONGS_TO, 'Users', 'user_id'),
            'rTransaction' => array(self::BELONGS_TO, 'ProTransactions', 'transactions_id',
                'on'=>'t.type='.  ProTransactions::CLIENT_TYPE_TENANT,
                ),// Feb 03, 2015 không rõ relation này có chạy dc ko nữa, nhìn thì thấy sai
                // Note: có dùng cho mấy hàm find all bên dưới
            'rTransactionOnly' => array(self::BELONGS_TO, 'ProTransactions', 'transactions_id'),
        );
    }

    public function attributeLabels()
    {
		$aRes = array(
            'id' => 'ID',
            'transactions_id' => 'Transactions',
            'type' => 'Type',
            'user_id' => 'User',
            'name' => 'Name',
			'nric_passportno_roc'=>'NRIC / FIN / PASSPORT / UEN NO',
            'contact_no' => 'Contact No',
            'address' => 'Address',
            'postal_code' => 'Postal Code',
            'invoice_bill_to' => 'Invoice Bill To',
            'billing_address' => 'Billing Address',
            'id_type' => 'Id Type',
            'pass_expiry_date' => 'Pass Expiry Date',
            'scanned_employment_pass' => 'Upload <span class="label_span_first">scanned Employment Pass</span>',
            'scanned_passport' => 'Upload scanned Passport',
            'id_type' => 'ID Type',
            'property_name_or_address' => 'Property Name',
        );
        
        if($this->scenario == "view_only"){
            $aRes['scanned_employment_pass'] = 'Upload scanned Employment Pass';
        }
        
        if( !empty($this->id_type) ){
            if(in_array($this->id_type, Users::$ARR_ID_NOT_REQUIRED)){
                $aRes['scanned_employment_pass'] = 'Upload '.ProTransactions::TENANT_IS_SINGAPOREAN.' ';
            }
        }
        
        return $aRes;
    }

    public function search()
    {
        $criteria=new CDbCriteria;

        $criteria->compare('t.id',$this->id,true);
        $criteria->compare('t.transactions_id',$this->transactions_id,true);
        $criteria->compare('t.type',$this->type);
        $criteria->compare('t.user_id',$this->user_id,true);
        $criteria->compare('t.name',$this->name,true);
        $criteria->compare('t.nric_passportno_roc',$this->nric_passportno_roc,true);
        $criteria->compare('t.contact_no',$this->contact_no,true);
        $criteria->compare('t.address',$this->address,true);
        $criteria->compare('t.postal_code',$this->postal_code,true);
        $criteria->compare('t.invoice_bill_to',$this->invoice_bill_to);
        $criteria->compare('t.billing_address',$this->billing_address,true);
        $criteria->compare('t.id_type',$this->id_type);
        $criteria->compare('t.pass_expiry_date',$this->pass_expiry_date,true);
        $criteria->compare('t.scanned_employment_pass',$this->scanned_employment_pass,true);
        $criteria->compare('t.scanned_passport',$this->scanned_passport,true);

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
    
    /**
     * @Author: ANH DUNG Apr 28, 2014
     * @Todo: get value field from realation
     */
    public function getField($nameField){
        $res = '';
        if($this->user){
            if($nameField == 'email'){
                return $this->user->email_not_login;
            }elseif($nameField == 'scanned_employment_pass'){
                return $this->user->upload_employment_pass_passport;
            }elseif($nameField == 'name'){
                return $this->user->first_name;
            }elseif($nameField == 'id_type'){
                $id_type = $this->user->id_type;
                return isset(Users::$aIdType[$id_type])?Users::$aIdType[$id_type]:'';
            }
            $res = $this->user->$nameField;
        }
        return $res;
    }
    
    /**
     * @Author: ANH DUNG Apr 28, 2014
     * @Todo: copy info from model user to model ProTransactionsVendorPurchaserDetail
     * by foreign key (user_id), vì các grid và view print hiện tại đang lấy ở model ProTransactionsVendorPurchaserDetail
     * chứ không phải là model user, vì ngại làm ref sang model user nên sẽ làm overide kiểu này cho nhanh
     * @param: $model is ProTransactionsVendorPurchaserDetail
     */
    public static function OverideModel($model){
        if($model && $model->user){
            $mUser = $model->user;
            $model->name = $mUser->first_name;
            $model->email= $mUser->email_not_login ;
            $model->nric_passportno_roc = $mUser->nric_passportno_roc;
            $model->contact_no = $mUser->contact_no;
            $model->address= $mUser->address;
            $model->postal_code = $mUser->postal_code ;
            $model->pass_expiry_date = $mUser->pass_expiry_date ;
            $model->id_type = $mUser->id_type;
			/* Lam Huynh comment these line to fix upload scanned_employment_pass - f*ck that sh*t */
//			$model->scanned_employment_pass = $mUser->upload_employment_pass_passport;            
//			$model->scanned_passport = $mUser->scanned_passport;            
        }
        return $model;
    }


    public function defaultScope()
    {
            return array(
                    //'condition'=>'',
            );
    }
    
    /**
     * @Author: ANH DUNG Mar 28, 2014
     * @Todo: search by transactions_id and type 1: vendor,2: purchaser, 3: Landlord, 4: Tenant
     * @Param: $transactions_id 
     * @Param: $type 1: vendor,2: purchaser, 3: Landlord, 4: Tenant
     * @Return: CActiveDataProvider
     */
    public static function searchByType($transactions_id, $type)
    {
        $criteria=new CDbCriteria;
        $criteria->compare('t.transactions_id', $transactions_id);
        $criteria->compare('t.type', $type);
//        $criteria->compare('t.user_id', $type);
//        $criteria->compare('t.status',$this->name);

        return new CActiveDataProvider('ProTransactionsVendorPurchaserDetail', array(
            'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
            ),
        ));
    } 
    
    /**
     * @Author: ANH DUNG Apr 25, 2014
     * @Todo: send mail to all new user
     * @Param: $transactions_id
     * @Param: $mTransactions
     */    
    public static function GetNewUserOfTransaction($mTransactions){
        $aTypeUser = array(Users::USER_TENANT, Users::USER_LANDLORD);
        $criteria=new CDbCriteria;
        $criteria->compare('t.is_new_user', 1);// new user
        $criteria->compare('t.transactions_id', $mTransactions->id);
        $criteria->addInCondition('t.type', $aTypeUser);
        return self::model()->findAll($criteria);
    }
    
    /**
     * @Author: ANH DUNG Apr 25, 2014
     * @Todo: send mail to all new user
     * @Param: $transactions_id
     * @Param: $mTransactions
     */    
    public static function sendMailToNewUser($transactions_id, $mTransactions){
        /* for new user */
        $aTypeUser = array(Users::USER_TENANT, Users::USER_LANDLORD);
        $criteria=new CDbCriteria;
        $criteria->compare('t.send_mail', 0);
        $criteria->compare('t.is_new_user', 1);// new user
        $criteria->compare('t.transactions_id', $transactions_id);
        $criteria->addInCondition('t.type', $aTypeUser);
        $models = self::model()->findAll($criteria);
        $aUid = CHtml::listData($models, 'user_id', 'user_id');
        if(count($aUid)){
            $criteria=new CDbCriteria;
            $criteria->addInCondition('t.id', $aUid);
            $criteria->addCondition('t.email_not_login <> "" ');
            $mUsers = Users::model()->findAll($criteria);
            if(count($mUsers)){
                foreach($mUsers as $mUser){
                    SendEmail::LandlordTenant($mUser);
//                    $mUser->send_mail=1;
//                    $mUser->update(array('send_mail'));
                }
            }
        }
        
        /* for old user */
        $criteria=new CDbCriteria;
        $criteria->compare('t.send_mail', 0);
        $criteria->compare('t.is_new_user', 0);// old user
        $criteria->compare('t.transactions_id', $transactions_id);
        $criteria->addInCondition('t.type', $aTypeUser);
        $models = self::model()->findAll($criteria);
        $aUid = CHtml::listData($models, 'user_id', 'user_id');
        if(count($aUid)){
            $criteria=new CDbCriteria;
            $criteria->addInCondition('t.id', $aUid);
            $criteria->addCondition('t.email_not_login <> "" ');
            $mUsers = Users::model()->findAll($criteria);
            if(count($mUsers)){
                foreach($mUsers as $mUser){
                    SendEmail::LandlordTenantOld($mUser, $mTransactions);
                }
            }
        }
        self::updateSendMail($transactions_id);
    }
    
    public static function updateSendMail($transactions_id){
        self::model()->updateAll(array('send_mail'=>1),
            "`transactions_id`=$transactions_id ");
    }

    
    protected function afterSave() {
        // update info to user if it is create new at transaction
        Users::updateUserVendorPurchaser($this);
        return parent::afterSave();
    }
    
    protected function beforeValidate() {
        $this->email = trim($this->email);
        $this->name = trim($this->name);
        $this->nric_passportno_roc = trim($this->nric_passportno_roc);
        return parent::beforeValidate();
    }
    
    /**
     * @Author: ANH DUNG Apr 28, 2014
     * @Todo: update role user after create new or update user
     * @Param: $transactions_id
     */
    public static function updateRoleUserAfterCreateUpdateTransaction($transactions_id){
        $criteria=new CDbCriteria;
        $criteria->compare('t.is_new_user', 1);
        $criteria->compare('t.transactions_id', $transactions_id);
        $models = self::model()->findAll($criteria);
        if(count($models)){
            foreach($models as $item){
                $mUser = Users::model()->findByPk($item->user_id);
				if (!$mUser) continue;
                switch ($item->type) {
                    case Users::USER_TENANT:
                        $mUser->role_id = ROLE_TENANT;
                        break;
                    case Users::USER_LANDLORD:
                        $mUser->role_id = ROLE_LANDLORD;
                        break;
                    case Users::USER_VENDOR:
                        $mUser->role_id = ROLE_VENDOR;
                        break;
                    case Users::USER_PURCHASER:
                        $mUser->role_id = ROLE_PURCHASER;
                        break;
                }
                $mUser->update(array('role_id'));
            }
        }
    }
    /**
     * @Author: ANH DUNG May 20, 2014
     * @Todo: updateExpirationTenant new date if bigger
     * @Param: $mTransactions
     */
    public static function updateExpirationTenant($mTransactions){        
        $aTypeUpdate = array(Users::USER_TENANT, Users::USER_LANDLORD);
        $criteria=new CDbCriteria;
        $criteria->addInCondition('t.type', $aTypeUpdate);
        $criteria->compare('t.transactions_id', $mTransactions->id);
        $models = self::model()->findAll($criteria);
        if(count($models)){
            foreach($models as $item){
                Users::updateExpirationDate($item->user_id, $mTransactions->expiring_date);
            }
        }
    }
    
   
    
    /**
     * @Author: ANH DUNG Apr 28, 2014
     * @Todo: delete user of transaction garbage
     * chỉ gọi hàm này khi xóa transaction rác của hệ thống
     * @Param: $transactions_id
     */
    public static function deleteUserOfTransactionGarbage($transactions_id){
        $criteria=new CDbCriteria;
        $criteria->compare('t.is_new_user', 1);
        $criteria->compare('t.transactions_id', $transactions_id);
        $models = self::model()->findAll($criteria);
        if(count($models)){
            foreach($models as $item){
                $mUser = Users::model()->findByPk($item->user_id);
                $mUser->delete;
            }
        }
    }
    
    
    
    /**
     * @Author: ANH DUNG Apr 21, 2014
     * @Todo: save one record of tenant
     * @Param: $model model ProTransactionsVendorPurchaserDetail
     */
    public static function saveOneTenant($model, $is_default=0, $needMore = array())
    {
        $model->type = Users::USER_TENANT;
        $model->is_default = $is_default;
        $model->pass_expiry_date = MyFormat::dateConverDmyToYmd($model->pass_expiry_date);
        $mUser = null;
        if(empty($model->user_id)){
            $mUser = Users::saveUserVendorPurchaser($model, ROLE_TENANT);
            $model->user_id = $mUser->id;
            $model->is_new_user = 1;
        }
        if(isset($needMore['scenario_null'])){
            $model->scenario = null;
        }

        $model->save();
        //add
        $FileInput = $_FILES["ProTransactionsVendorPurchaserDetail"]["name"]["scanned_employment_pass"];
        $FileInput2 = $_FILES["ProTransactionsVendorPurchaserDetail"]["name"]["scanned_passport"];
        if(!empty($FileInput)){
            ProTransactionsVendorPurchaserDetail::saveSomeFile($model,'scanned_employment_pass');
        }
        if(!empty($FileInput2)){
            ProTransactionsVendorPurchaserDetail::saveSomeFile($model,'scanned_passport');       

        }
        
//        if($mUser && $model->is_new_user && $model->id_type!= Users::ID_TYPE_CITIZENSHIP){
        if($mUser && $model->is_new_user){
            // save 2 file upload if have to table user
            Users::saveTwoFileOfTenant($mUser, $model);
        }
    }
    
    /**
     * @Author: Jason Apr 16, 2014
     * @Todo: search by transactions_id and type 1: vendor,2: purchaser, 3: Landlord, 4: Tenant
     * @Param: $transactions_id 
     * @Param: $type 1: vendor,2: purchaser, 3: Landlord, 4: Tenant
     * @Return: CActiveDataProvider
     */
    public static function getTenancyInformation($transactions_id, $type)
    {
        $criteria=new CDbCriteria;
        $criteria->compare('t.transactions_id', $transactions_id);
        if ($type == TYPE_TENANT) {
            $criteria->compare('t.is_default', 1);
        }
        
        $criteria->compare('t.type', $type);
        if ($type == TYPE_LANDLORD) {
//            $criteria->compare('t.invoice_bill_to', 1); // không hiểu cái condition này để làm gì 
        }
        $criteria->limit = 1;
        $criteria->order = 't.id';

        return ProTransactionsVendorPurchaserDetail::model()->find($criteria);
    }
    
    /**
     * <Jason>
     * <To get list tenancy for agent>
     * <Date: 20140506>
     * @param type $status
     * @return \CActiveDataProvider
     */
    public function getListTenanciesAgent() {
        $current_user_id = Yii::app()->user->id;
        $criteria=new CDbCriteria;
        $criteria->with = array('rTransaction');
        
        if ( $this->status == STATUS_LISTING_ACTIVE) {
            $criteria->addCondition('rTransaction.expiring_date >= CURDATE()');
        }
        elseif ($this->status == STATUS_LISTING_EXPIRED) {
            $criteria->addCondition('rTransaction.expiring_date < CURDATE()');
        }
        elseif ($this->status == STATUS_TENANCY_DRAFT) {
            $criteria->compare('rTransaction.status', STATUS_TENANCY_DRAFT);
        }
        $criteria->compare('t.is_default', 1);
//        $criteria->addInCondition( 'rTransaction.status', ProTransactions::$LIST_STATUS_REAL ); // close Dec 10, 2014
        if ($this->status != STATUS_TENANCY_DRAFT) {
            $criteria->addInCondition('rTransaction.status', ProTransactions::$LIST_STATUS_FOR_TENANT); // fix Dec 10, 2014
        }
        $criteria->compare('rTransaction.user_id', $current_user_id);
        if ( trim($this->property_name_or_address) != "" ) {
//            $aListingId = Listing::GetArrListingIdByPropertyName($this->property_name_or_address);            
                $criteria->addInCondition('rTransaction.id', self::GetListTransactionIdSearch(trim($this->property_name_or_address)) ); // change Now 28, 2014            
        }
        
        $sort = new CSort();
        $sort->attributes = array(            
            'tenancy_agreement_date' => array(
                'asc' => 'rTransaction.tenancy_agreement_date',
                'desc' => 'rTransaction.tenancy_agreement_date desc',
            ),
            'commencement_date' => array(
                'asc' => 'rTransaction.commencement_date',
                'desc' => 'rTransaction.commencement_date desc',
            ),
            'expiring_date' => array(
                'asc' => 'rTransaction.expiring_date',
                'desc' => 'rTransaction.expiring_date desc',
            ),
            );    
            $sort->defaultOrder = 't.id DESC';  
        
        return new CActiveDataProvider( $this, array(
            'criteria'=>$criteria,
            'sort' => $sort,
            'pagination'=>array(
                'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
            ),
        ));
    }
    
    /**
     * @Author: ANH DUNG Dec 10, 2014
     * @Todo: get list transaction for seach
     */
    public static function GetListTransactionIdSearch($property_name_or_address) {
       $criteria=new CDbCriteria;
       $criteria->compare(" t.property_name_or_address", $property_name_or_address, true);
       $criteria->with = array('rTransaction');
       $criteria->compare(" rTransaction.user_id", Yii::app()->user->id);
       $criteria->together = true;
       $models = ProTransactionsPropertyDetail::model()->findAll($criteria);
       return CHtml::listData($models, "transactions_id", "transactions_id");
    }
    
    /**
     * @Author: ANH DUNG Oct 02, 2014
     * @Todo: belong to getVendorNameForSolicitor
     * @Param: $mTransactions, $type: 1: vendor,2: purchaser, 3: Landlord, 4: Tenant
     */
    public static function getTransactionFirstUserByType($mTransactions, $type) {
        $criteria=new CDbCriteria;
        $criteria->compare('t.transactions_id', $mTransactions->id);
        $criteria->compare('t.type', $type);
        $criteria->order = "t.id ASC";
        if($type == ProTransactions::CLIENT_TYPE_TENANT){
            $criteria->compare('t.is_default', 1);
        }
        $criteria->limit = 1;
        $model = self::model()->find($criteria);
        if($model){
            return $model->name;
        }
        return '';
    }
    
    /**
     * @Author: ANH DUNG Oct 02, 2014
     * @Todo: get name of Vendors OR Purchaser OR Landlor OR Tenant 
     * when are transaction is submitted and bill to solicitor is selected, the invoice shows bill to : Solicitors name, which is wrong, it shall be bill to as following:
        Vendors name:
        C/O. solicitor's name 
        solicitor's address.
     * @Param: $mTransactions
     */
    public static function getVendorNameForSolicitor($mTransactions) {
        $res = '';
        if($mTransactions->type == ProTransactions::FOR_SALE){
            if($mTransactions->client_type_id == ProTransactions::CLIENT_TYPE_VENDOR){
                $res = "Vendor name: ".self::getTransactionFirstUserByType($mTransactions, ProTransactions::CLIENT_TYPE_VENDOR);
            }elseif ($mTransactions->client_type_id == ProTransactions::CLIENT_TYPE_PURCHASER) {
                $res = "Purchaser name: ".self::getTransactionFirstUserByType($mTransactions, ProTransactions::CLIENT_TYPE_PURCHASER);
            }
            
        }else{
            if($mTransactions->client_type_id == ProTransactions::CLIENT_TYPE_LANLORD){
                $res = "Landlord name: ".self::getTransactionFirstUserByType($mTransactions, ProTransactions::CLIENT_TYPE_LANLORD);
            }elseif ($mTransactions->client_type_id == ProTransactions::CLIENT_TYPE_TENANT) {
                $res = "Tenant name: ".self::getTransactionFirstUserByType($mTransactions, ProTransactions::CLIENT_TYPE_TENANT);
            }
        }
        return $res;
    }
    
    /**
     * @Author: ANH DUNG Dec 02, 2014
     * @Todo: get list uid valid of transaction
     * @Param: $transactions_id
     */
    public static function GetListUidByTransaction( $transactions_id ) {
        $criteria = new CDbCriteria();
        $criteria->compare('t.transactions_id', $transactions_id);
        $models = self::model()->findAll($criteria);
        return CHtml::listData($models, 'user_id', 'user_id');
    }
    
    /**
     * @Author: ANH DUNG Dec 08, 2014
     * @Todo: get list uid valid of transaction
     * @Param: $transactions_id
     * @Param: $aType array type user 
     */
    public static function GetListModelByTypeUser( $transactions_id, $aType ) {
        $criteria = new CDbCriteria();
        $criteria->compare('t.transactions_id', $transactions_id);
        $criteria->addInCondition('t.type', $aType);        
        return self::model()->findAll($criteria);
    }
    
}
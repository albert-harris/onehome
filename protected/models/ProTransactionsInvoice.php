<?php

/**
 * This is the model class for table "{{_pro_transactions_invoice}}".
 *
 * The followings are the available columns in table '{{_pro_transactions_invoice}}':
 * @property string $id
 * @property string $transactions_id
 * @property string $invoice_number
 * @property integer $invoice_type
 * @property integer $invoice_template
 * @property string $trans_bill_to_id
 * @property integer $type
 * @property integer $client_type_id
 * @property integer $invoice_bill_to
 * @property string $created_date
 */
class ProTransactionsInvoice extends CActiveRecord
{
   /**
     * @Author: ANH DUNG Jul 09, 2014
     * @Todo: gen some invoice for transaction
     * @Param: $mTransaction model transaction
     * invoice_type: 1: invoice, 2: voucher, 3: Receipt
     * invoice_template: 1: invoice For Sale normal. 2: invoice For Sale Bill External Co-broke. 
     * 3.: invoice For Rent Bill External Co-broke 4: Voucher 1. 5: Voucher 2. 6: Receipt
     * trans_bill_to_id: bill_to_id if External Co-broke. là id table pro_pro_transactions_bill_to
     * type: 1: for sale, 2: for rent
     * client_type_id: 1: vendor, 2: purchaser, 3: Landlord, 4: Tenant
     * invoice_bill_to: 1: Vendor, 2: Purchaser, 3: Landlord, 4: Tenant, 5:Solicitor, 6: External Co - Broke
     */    
    public $MAX_ID;
    const LENGTH_INVOICE_NO = 13;
    
    const TYPE_INVOICE = 1;
    const TYPE_VOUCHER = 2;
    const TYPE_RECEIPT = 3;
    
    const TEMPLATE_1_NORMAR = 1;
    const TEMPLATE_2_SALE_EXTERNAL = 2;
    const TEMPLATE_3_RENT_EXTERNAL = 3;
    const TEMPLATE_4_VOUCHER_SALEPERSON = 4;
    const TEMPLATE_5_VOUCHER_COBROKE = 5;
    const TEMPLATE_6_RECEIPT = 6;
    
    public static $aTemplateInvoiceExCobroke = array(
        ProTransactionsInvoice::TEMPLATE_2_SALE_EXTERNAL,
        ProTransactionsInvoice::TEMPLATE_3_RENT_EXTERNAL
    );
    
    // Oct 28, 2014
    public static $aTemplateExCobrokeForSummaryReport = array(
//        ProTransactionsInvoice::TEMPLATE_4_VOUCHER_SALEPERSON,
        ProTransactionsInvoice::TEMPLATE_5_VOUCHER_COBROKE
    );
    // Oct 28, 2014
    
    const T_EXTERNAL_CO_BROKE = 1;
    const T_INTERNAL_CO_BROKE_SALEPERSON = 2;
    const T_INTERNAL_CO_BROKE_1ST = 4;
    const T_INTERNAL_CO_BROKE_2ND = 5;
    const T_SALEPERSON = 6;
    const T_SALEPERSON_1ST = 7;
    const T_SALEPERSON_2ND = 8;

    public $transactions_no;
    public $property_address;
    public $date_from;
    public $date_to;
    public static function model($className=__CLASS__)
    {
            return parent::model($className);
                        
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
            return '{{_pro_transactions_invoice}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('id, transactions_id, invoice_number, invoice_type, invoice_template, trans_bill_to_id, type, client_type_id, invoice_bill_to, created_date', 'safe'),
            array('receipt_name, receipt_nric, receipt_contact_no, receipt_date_paid, cheque_no, bank_no', 'safe'),
            array('receipt_name, receipt_nric, receipt_date_paid', 'required', 'on'=>'GenReceipt'),
            array('date_from,date_to,property_address, transactions_no, voucher_pay_to, voucher_no, voucher_cheque_no, voucher_ma_gross_comm', 'safe'),
            array('voucher_pay_to, voucher_no, voucher_cheque_no, receipt_date_paid', 'required', 'on'=>'GenVoucher'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'rTransaction' => array(self::BELONGS_TO, 'ProTransactions', 'transactions_id'),
            'rExternalCobroke' => array(self::BELONGS_TO, 'ProTransactionsBillTo', 'trans_bill_to_id'),
            'rPayToUser' => array(self::BELONGS_TO, 'Users', 'voucher_pay_to'),
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
                    'invoice_number' => 'Invoice Number',
                    'invoice_type' => 'Invoice Type',
                    'invoice_template' => 'Invoice Template',
                    'trans_bill_to_id' => 'Trans Bill To',
                    'type' => 'Type',
                    'client_type_id' => 'Client Type',
                    'invoice_bill_to' => 'Invoice Bill To',
                    'created_date' => 'Created Date',
                    'receipt_name' => 'Name',
                    'receipt_nric' => 'NRIC',
                    'receipt_contact_no' => 'Contact No',
                    'receipt_date_paid' => 'Date Paid',
                    'voucher_pay_to' => 'Pay To',
                    'voucher_no' => 'Voucher No',
                    'voucher_cheque_no' => 'Cheque No',
                    'voucher_ma_gross_comm' => 'M.A Gross Comm',                    
                    'transactions_no' => 'Transactions No',
                    'property_address' => 'Property Address',
                    'date_from' => 'Invoice Date From',
                    'date_to' => 'Invoice Date To',
				'cheque_no' => 'Cheque Number',
				'bank_no' => 'Bank Number',
            );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
            $criteria=new CDbCriteria;
            $criteria->compare('t.id',$this->id,true);
            $criteria->compare('t.transactions_id',$this->transactions_id,true);
            $criteria->compare('t.invoice_number',$this->invoice_number,true);
            $criteria->compare('t.invoice_type',$this->invoice_type);
            $criteria->compare('t.invoice_template',$this->invoice_template);
            $criteria->compare('t.trans_bill_to_id',$this->trans_bill_to_id,true);
            $criteria->compare('t.type',$this->type);
            $criteria->compare('t.client_type_id',$this->client_type_id);
            $criteria->compare('t.invoice_bill_to',$this->invoice_bill_to);
            
            $date_from = '';
            $date_to = '';
            if(!empty($this->date_from)){
                $date_from = MyFormat::dateConverDmyToYmdForSeach($this->date_from)." 00:00:00";
            }
            if(!empty($this->date_to)){
                $date_to = MyFormat::dateConverDmyToYmdForSeach($this->date_to)." 23:59:00";
            }        

            if(!empty($date_from) && empty($date_to))
                $criteria->addCondition("t.created_date>='$date_from'");
            if(empty($date_from) && !empty($date_to))
                $criteria->addCondition("t.created_date<='$date_to'");
            if(!empty($date_from) && !empty($date_to))
                $criteria->addBetweenCondition("t.created_date",$date_from, $date_to);
            
            $aWith = array();
            if(trim($this->transactions_no) != "" ){
                $criteria->compare('rTransaction.transactions_no', trim($this->transactions_no), true);
            }
            if(trim($this->property_address) != ""){
                $criteria->compare('rListing.property_name_or_address', trim($this->property_address), true);
                $aWith[] = 'rListing';
            }
            if(count($aWith)){
                $criteria->with = $aWith;
                $criteria->together = true;
            }
            
            $criteria->order = 't.id DESC';
            return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
                    'pagination'=>array(
                        'pageSize'=> 50,
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
     * @Author: ANH DUNG Jul 09, 2014
     * @Todo: auto gen invoice when create success transaction
     * @Param: $model model transaction
     */
    public static function AutoGenInvoice($model){
        ProTransactionsInvoice::DoGenInvoice($model);        
        $model->status = STATUS_GEN_INVOICE;
        $model->update(array('status'));
    }
    
    /**
     * @Author: ANH DUNG Jul 09, 2014
     * @Todo: gen some invoice for transaction
     * @Param: $mTransaction model transaction
     * invoice_type: 1: invoice, 2: voucher, 3: Receipt
     * invoice_template: 1: invoice For Sale normal. 2: invoice For Sale Bill External Co-broke. 
     * 3.: invoice For Rent Bill External Co-broke 4: Voucher 1. 5: Voucher 2. 6: Receipt
     * trans_bill_to_id: bill_to_id if External Co-broke. là id table pro_pro_transactions_bill_to
     * type: 1: for sale, 2: for rent
     * client_type_id: 1: vendor, 2: purchaser, 3: Landlord, 4: Tenant
     * invoice_bill_to: 1: Vendor, 2: Purchaser, 3: Landlord, 4: Tenant, 5:Solicitor, 6: External Co - Broke
     */
    public static function DoGenInvoice($mTransaction){
        self::DeleteInvoiceByTransId($mTransaction->id);
        $invoice_type = ProTransactionsInvoice::TYPE_INVOICE;
        $invoice_template = ProTransactionsInvoice::TEMPLATE_1_NORMAR;
        // begin for gen invoice
        if($mBillTo = $mTransaction->rBillTo){
            // nếu bill to các đối tượng còn lại ngoài (khác) external co broke
           if($mBillTo->bill_to_id!=ProTransactions::BILL_TO_EXTERNAL_CO_BROKE){
               self::SaveOneInvoice($mTransaction, $invoice_type, 
               $invoice_template, $mBillTo);
           }else{
               // nếu bill to external co broke
               if(count($mTransaction->rExternalCoBroke)){
                   $invoice_template = ProTransactionsInvoice::TEMPLATE_2_SALE_EXTERNAL;
                   if($mTransaction->type == ProTransactions::FOR_RENT){
                       $invoice_template = ProTransactionsInvoice::TEMPLATE_3_RENT_EXTERNAL;
                   }
                   foreach($mTransaction->rExternalCoBroke as $mExternalCoBroke){
                       self::SaveOneInvoice($mTransaction, $invoice_type,
                            $invoice_template, $mExternalCoBroke);
                   }
               }
           }
        }
        // end for gen invoice        
    }
    
    public static function DoGenVoucher($model, $mTransaction){
        $prefix_code = self::getPrefix(ProTransactionsInvoice::TYPE_VOUCHER);
        $model->invoice_number = MyFormat::getNextId('ProTransactionsInvoice', $prefix_code, 'invoice_number', self::getLengthInvoiceNo());
        $model->invoice_type = ProTransactionsInvoice::TYPE_VOUCHER;
        $model->invoice_template = ProTransactionsSaveCommission::getTypeTemplateVoucher($mTransaction->id, $model->voucher_pay_to);
        $model->type = $mTransaction->type;
        $model->type_user = $model->invoice_template;
        $model->save();        
    }
    
    protected function beforeSave() {
        if(!empty($this->receipt_date_paid) && strpos($this->receipt_date_paid, '/')){
            $this->receipt_date_paid = MyFormat::dateConverDmyToYmd($this->receipt_date_paid);
        }
        
        if($this->transactions_id){
            $mTrans = ProTransactions::model()->findByPk($this->transactions_id);
            if($mTrans){
                $this->listing_id = $mTrans->listing_id;
            }
        }
        return parent::beforeSave();
    }
    
    /**
     * @Author: ANH DUNG Jul 16, 2014
     * @Todo: to gen receipt for transaction
     * @Param: $model model ProTransactionsInvoice::
     * @Param: $mTransaction
     */
    public static function DoGenReceipt($model, $mTransaction){
        $prefix_code = self::getPrefix(ProTransactionsInvoice::TYPE_RECEIPT);        
        $model->invoice_number = MyFormat::getNextId('ProTransactionsInvoice', $prefix_code, 'invoice_number', self::getLengthInvoiceNo());
        $model->invoice_type = ProTransactionsInvoice::TYPE_RECEIPT;
        $model->invoice_template = ProTransactionsInvoice::TEMPLATE_6_RECEIPT;
        $model->type = $mTransaction->type;
        $model->save();
        // *** 1. update status table transaction
        ProTransactions::UpdateStatusTrans($mTransaction->id, STATUS_GEN_RECEIPT);
        // *** 2. update status table save commission
        // 1. update cột status receipt qua table saveCommission để chạy thống kê
        // 2. update cột received_on
        ProTransactionsSaveCommission::UpdateStatusOfCommission($mTransaction, $model->receipt_date_paid, STATUS_GEN_RECEIPT);
    }
    
    /**
     * @Author: ANH DUNG Jul 15, 2014
     * @Todo: display full name of user
     * @Param: $mTransaction model transaction 
     * @Param: $invoice_type type invoice
     * @Param: $invoice_template template print
     * @Param: $mTransBillTo model transaction bill to với những invoice có External Co-broke
     * @Return: full name with salution of user
     */
    public static function SaveOneInvoice($mTransaction, $invoice_type,
            $invoice_template, $mTransBillTo
        ){
        //invoice_number sẽ gen ra dựa vào invoice_type
        $prefix_code = self::getPrefix($invoice_type);
        
        $model = new ProTransactionsInvoice();
        $model->transactions_id = $mTransaction->id;
        $model->invoice_number = MyFormat::getNextId('ProTransactionsInvoice', $prefix_code, 'invoice_number', self::getLengthInvoiceNo());
        $model->invoice_type = $invoice_type;
        $model->invoice_template = $invoice_template;        
        $model->type = $mTransaction->type;
        if($mTransBillTo){
            $model->trans_bill_to_id = $mTransBillTo->id; // primary key model bill to
            $model->client_type_id = $mTransBillTo->client_type_id;
            $model->invoice_bill_to = $mTransBillTo->bill_to_id;
        }
        $model->save();
    }
    
    public static function getLengthInvoiceNo(){
        return ProTransactionsInvoice::LENGTH_INVOICE_NO;
    }
    
    public static function DeleteInvoiceByTransId($transactions_id){
        self::model()->deleteAll("transactions_id=$transactions_id");        
    }
    
    public static function getPrefix($invoice_type){
        $prefix_code = 'INV';
        if($invoice_type==ProTransactionsInvoice::TYPE_VOUCHER){
            $prefix_code = 'VOU';
        }elseif ($invoice_type==ProTransactionsInvoice::TYPE_RECEIPT) {
            $prefix_code = 'REC';
        }
        $prefix_code .= date('y').date('m');
        return $prefix_code;
    }
    
    /**
     * @Author: ANH DUNG Jul 16, 2014
     * @Todo: Invoice No” của Invoice, nếu có nhiều invoice no. thì tách ra bằng dấu phẩy
     * @Param: $model model  model ProTransactionsInvoice
     * @Return: full name with salution of user
     */
    public static function getReceiptInvoiceNo($model){
        $res = '';
        if($mTrans = $model->rTransaction){
           foreach($mTrans->rInvoice as $item){
               $res .= "$item->invoice_number, ";
           }
        }
//        $res = trim($res);
        return $res = rtrim($res, ', ');
    }
    
    public static function getPropertyName($model){
        $res = '';
        $cmsFormater = new CmsFormatter();
        if($mTrans = $model->rTransaction){
//            ANH DUNG CLOSE DEC 02, 2014 $res = $mTrans->rListing?$mTrans->rListing->property_name_or_address:'';
            $res = $cmsFormater->formatTransactionPropertyName($mTrans);
        }
        return $res;
    }
    public static function getCommissionAmountTrans($model){
        $res = '';
        if($mTrans = $model->rTransaction){
            $res = ProTransactionsBillTo::getCommissionAmountTrans($mTrans->rBillTo);
        }
        return $res;
    }
 
    /**
     * @Author: ANH DUNG Jul 18, 2014
     * @Todo: calc total net comm for view invoice and list voucher
     * @Param: $mTransactions model Transactions
     * @Return: number
     */
    public static function calcTotalNetComm($model, $mTransactions){
        if(is_null($mTransactions)) return 0;
        $mTransComm = ProTransactionsSaveCommission::getByTransUid($mTransactions->id, $model->voucher_pay_to);
        $ExternalCoBrokeCommission = ProTransactionsSaveCommission::calcClientCommission($mTransactions);
        $InternalCoBrokeCommission = ProTransactionsSaveCommission::calcCommissionInternalCobroke($mTransactions);
        $MA_Gross = $model->voucher_ma_gross_comm; 
        $PrimaySalespersonComm = $mTransComm->received_commission;
        $voucher_number_11 = $PrimaySalespersonComm + $MA_Gross + $ExternalCoBrokeCommission+ $InternalCoBrokeCommission;        
        return $TotalNetComm = $voucher_number_11-$ExternalCoBrokeCommission-$InternalCoBrokeCommission;
    }
    
    /**
     * @Author: ANH DUNG Sep 19, 2014
     * @Todo: get Received Date
     * @Param: $model model 
     */
    public static function ReportGetReceivedInfo($mTransaction) {
        return ;// khong the lam ntn dc
    }    
    
    /**
     * @Author: ANH DUNG Sep 19, 2014
     * @Todo: do Report GetDatePaidExternalCobroke
     * @Param: $model model 
     */
    public static function ReportGetDatePaidExternalCobroke ($mTransaction) {
        $criteria=new CDbCriteria;
        $criteria->addInCondition('t.invoice_template', ProTransactionsInvoice::$aTemplateExCobrokeForSummaryReport);
        $criteria->compare('t.transactions_id', $mTransaction->id);
        $criteria->order = 't.receipt_date_paid DESC';
        $model = self::model()->find($criteria);
        if($model){
            return $model->receipt_date_paid;
        }
        return '';
    }
    
    // ANH DUNG Oct 22, 2014 for update listing id 
    public static function updateAllTransInvoice(){
        $models = self::model()->findAll();
        foreach($models as $item){
            $item->update(array('listing_id'));
        }
        echo count($models);die;
    }
    
}
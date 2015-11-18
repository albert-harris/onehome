<?php

/**
 * This is the model class for table "{{_fi_invoice}}".
 *
 * The followings are the available columns in table '{{_fi_invoice}}':
 * @property string $id
 * @property string $invoice_no
 * @property string $transactions_no
 * @property integer $bill_to
 * @property string $user_id
 * @property string $user_name
 * @property string $user_billing_address
 * @property string $user_postal_code
 * @property string $total_amount_due
 * @property integer $status
 * @property string $created_date
 */
class FiInvoice extends CActiveRecord
{
        
    const FI_BILLTO_SELLER = 1;
    const FI_BILLTO_LANDLORD = 2;
    const FI_BILLTO_CO_BROKE = 3;
    const FI_BILLTO_CO_BROKE_RENTAL = 4;
    const FI_BILLTO_OTHER = 5;
    
    const FI_BILLTO_VENDOR = 6;
    const FI_BILLTO_PURCHASER = 7;
    const FI_BILLTO_TENANT = 8;
    const FI_BILLTO_ASSIGNOR = 9;
    const FI_BILLTO_SOLICITOR = 10;
    
    public static $STA_BILL_TO = array(
//        FiInvoice::FI_BILLTO_SELLER =>'Seller',
        FiInvoice::FI_BILLTO_LANDLORD =>'Landlord',
        FiInvoice::FI_BILLTO_CO_BROKE =>'Co-broke',
//        FiInvoice::FI_BILLTO_CO_BROKE_RENTAL =>'Co-broke Rental',
        FiInvoice::FI_BILLTO_VENDOR =>'Vendor',
        FiInvoice::FI_BILLTO_PURCHASER =>'Purchaser',
        FiInvoice::FI_BILLTO_TENANT =>'Tenant',
        FiInvoice::FI_BILLTO_ASSIGNOR =>'Assignor',
        FiInvoice::FI_BILLTO_SOLICITOR =>'Solicitor',
        
        FiInvoice::FI_BILLTO_OTHER =>'Others',
    );
    
    const UNPAID = 0;
    const PAID = 1;
    
    public static $STA_STATUS = array(
        FiInvoice::UNPAID=>'Unpaid',
        FiInvoice::PAID=>'Paid',
    );
    
    public $aModelDetail;
    public $MAX_ID;
    
    const REPORT_DAILY = 1;
    const REPORT_MONTHLY = 2;
    const REPORT_YEARLY = 3;
    public static $STA_REPORT_TYPE = array(
        FiInvoice::REPORT_DAILY=>'Daily Sales Report',
        FiInvoice::REPORT_MONTHLY=>'Monthly Sales Report',
        FiInvoice::REPORT_YEARLY=>'Yearly Sales Report',
    );
    public $date_from;
    public $date_to;
    public $report_type;
    public $month_from;
    public $month_to;
    public $year_from;
    public $year_to;
    
    public $month_paid;
    public $year_paid;
    public $count_record;
    public $keyword;
    
    /**
     * @Author: ANH DUNG Sep 11, 2014
     * @Todo: get array listoptions of bill to
     */
    public static function getListOptionBillTo(){
        return FiInvoice::$STA_BILL_TO;
    }
    
    public static function getBillToText($bill_to){
        return isset(FiInvoice::$STA_BILL_TO[$bill_to])?FiInvoice::$STA_BILL_TO[$bill_to]:"";
    }
    
    public static function model($className=__CLASS__)
    {
            return parent::model($className);
    }

    public function tableName()
    {
            return '{{_fi_invoice}}';
    }

    public function rules()
    {
        return array(
            array('bill_to, user_name', 'required', 'on'=>'create, update'),
            array('user_name', 'length', 'max'=>200),
            array('user_billing_address', 'length', 'max'=>300),
            array('user_postal_code', 'length', 'max'=>100),
            array('total_amount_due', 'length', 'max'=>16),
            array('id, invoice_no, transactions_no, bill_to, user_id, user_name, user_billing_address, user_postal_code, total_amount_due, status, created_date', 'safe'),
            array('nric,cheque_number, payment_mode, keyword,date_from,date_to,report_type,month_from,month_to,year_from,year_to', 'safe'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'rUser' => array(self::BELONGS_TO, 'Users', 'user_id'),
            'rInvoiceReceipt' => array(self::HAS_ONE, 'FiInvoiceReceipt', 'invoice_id'),
            'rDetail' => array(self::HAS_MANY, 'FiInvoiceDetail', 'invoice_id',
                'order'=>'rDetail.id ASC',
            ),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'invoice_no' => 'Invoice No',
            'transactions_no' => 'Transactions No',
            'bill_to' => 'Bill To',
            'user_id' => 'User',
            'user_name' => 'Full Name',
            'user_billing_address' => 'Billing Address',
            'user_postal_code' => 'Postal Code',
            'total_amount_due' => 'Total Amount',
            'status' => 'Status',
            'created_date' => 'Invoice Date',
            'date_from' => 'Invoice Date From',
            'date_to' => 'Invoice Date To',
            'keyword' => 'Keyword',
            'nric' => 'NRIC/ FIN/ Passport',
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
        $criteria->compare('t.invoice_no',trim($this->invoice_no),true);
        $criteria->compare('t.transactions_no',trim($this->transactions_no),true);
        $criteria->compare('t.bill_to',$this->bill_to);
        $criteria->compare('t.user_id',$this->user_id,true);
        $criteria->compare('t.user_name',$this->user_name,true);
        $criteria->compare('t.user_billing_address',$this->user_billing_address,true);
        $criteria->compare('t.user_postal_code',$this->user_postal_code,true);
        $criteria->compare('t.total_amount_due',$this->total_amount_due,true);
        $criteria->compare('t.status',$this->status);

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
        
        
        if(!empty($this->keyword)){
            $criteria->compare('rDetail.description', $this->keyword, true);
            $criteria->with = array('rDetail');
            $criteria->together = true;
        }
        
        $criteria->order = "t.id desc";

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
            ),
        ));
    }

    public function searchMixed()
    {
        $criteria=new CDbCriteria;
        $criteria->compare('t.id',$this->id,true);
        $criteria->compare('t.invoice_no',trim($this->invoice_no),true);
        $criteria->compare('t.transactions_no',trim($this->transactions_no),true);
        $criteria->compare('t.bill_to',$this->bill_to);
        $criteria->compare('t.user_id',$this->user_id,true);
        $criteria->compare('t.user_name',$this->user_name,true);
        $criteria->compare('t.user_billing_address',$this->user_billing_address,true);
        $criteria->compare('t.user_postal_code',$this->user_postal_code,true);
        $criteria->compare('t.total_amount_due',$this->total_amount_due,true);
        $criteria->compare('t.status',$this->status);

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
        
        
        if(!empty($this->keyword)){
            $criteria->compare('rDetail.description', $this->keyword, true);
            $criteria->with = array('rDetail');
            $criteria->together = true;
        }
        
        $criteria->order = "t.created_date desc";
		$fiInvoices = static::model()->findAll($criteria);
        
		$c2 = new CDbCriteria();
		$c2->compare('invoice_number', trim($this->invoice_no),true);
		$c2->compare('invoice_type', ProTransactionsInvoice::TYPE_INVOICE);
		$c2->order = 'created_date desc';
		$invoices = ProTransactionsInvoice::model()->findAll($c2);
		
		$mixedInvoice = array();
		$f = Yii::app()->format;
		foreach ($fiInvoices as $invoice) {
			$data =	array(
				'id' => $invoice->id,
				'invoice_no' => $invoice->invoice_no,
				'created_date' => $invoice->created_date,
				'transactions_no' => $invoice->transactions_no,
				'property_address' => $f->formatInvoicePropertyAddress($invoice),
				'total_amount_due_gst' => $f->formatPrice($invoice->total_amount_due_gst),
				'status' => FiInvoice::$STA_STATUS[$invoice->status],
				'receipt' => $f->formatInvoiceGenReceipt($invoice),
				'viewUrl' => Yii::app()->createAbsoluteUrl('admin/fiInvoice/view', array('id'=>$invoice->id)),
				'deleteUrl' => Yii::app()->createAbsoluteUrl('admin/fiInvoice/delete', array('id'=>$invoice->id)),
			);
			if (FiInvoice::CanUpdate($invoice)) {
				$data['updateUrl'] = Yii::app()->createAbsoluteUrl('admin/fiInvoice/update', array('id'=>$invoice->id));
			}
			$mixedInvoice[] = $data;
		}
		foreach ($invoices as $invoice) {
			$mixedInvoice[] = array(
				'id' => $invoice->id+200000,
				'invoice_no' => $invoice->invoice_number,
				'created_date' => $invoice->created_date,
				'transactions_no' => $invoice->rTransaction->transactions_no,
				'property_address' => $invoice->rTransaction->rPropertyDetail->property_name_or_address,
				'total_amount_due_gst' => $f->formatTransactionPropertyPrice($invoice->rTransaction),
				'viewUrl' => Yii::app()->createAbsoluteUrl('admin/transactions/viewInvoice', array('id'=>$invoice->id)),
			);
		}
		return new CArrayDataProvider($mixedInvoice, array(
			'sort'=>array(
				'defaultOrder'=>'created_date DESC',
				'attributes'=>array(
					'created_date', 'invoice_no'
				),
			),
			'pagination'=>array(
				'pageSize'=>Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
			)
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
    
    public static function fnUpdateTotalAmount($model){
        $model = self::model()->findByPk($model->id);
        $total_amount_due = 0;
        $total_amount_due_gst = 0;
        foreach($model->rDetail as $item){
            $total_amount_due += $item->amount;
            $total_amount_due_gst += $item->amount_gst;
        }
        
        $model->total_amount_due = $total_amount_due;
        $model->total_amount_due_gst = $total_amount_due_gst;
        $model->update(array('total_amount_due', 'total_amount_due_gst'));
    }
    
    
    /**
     * @Author: ANH DUNG Oct 21, 2014
     * @Todo: get total amount gst at list /admin/fiInvoice/index 
     */
    public static function getTotalAmountGst() {
        $criteria = new CDbCriteria();
        $criteria->select = "sum(total_amount_due_gst) as total_amount_due_gst";
        $model = self::model()->find($criteria);
        return $model->total_amount_due_gst;
    }
    
    protected function beforeValidate() {
        $detailError = false;
        $this->aModelDetail = array();        
        if(isset($_POST['FiInvoiceDetail']['id']) && is_array($_POST['FiInvoiceDetail']['id'])  && count($_POST['FiInvoiceDetail']['id'])){
            foreach($_POST['FiInvoiceDetail']['id'] as $key=>$pk){
                $amount = isset($_POST['FiInvoiceDetail']['amount'][$key])?$_POST['FiInvoiceDetail']['amount'][$key]:0;
                $mDetail = new FiInvoiceDetail('validate_detail');
                $mDetail->id = $pk;
                $mDetail->amount = $amount;
                $mDetail->validate();
                if(!empty($pk)){
                    $this->aModelDetail[] = $mDetail;
                }
                if($mDetail->hasErrors()){
                    $detailError = true;
                }
            }
        }
        
        if(count($this->aModelDetail)<1){
            $this->addError('aModelDetail', 'Details can not be blank');
            $this->aModelDetail = array(new FiInvoiceDetail());
        }
        if($detailError){
            $this->addError('aModelDetail', 'Details error');
        }
        
        return parent::beforeValidate();
    }
    
    protected function beforeSave() {
        if($this->isNewRecord){
            $prefix_code_invoice = "INV".date('y').date('m');
			$oldInvoiceNo = MyFormat::getNextId('FiInvoice',$prefix_code_invoice,'invoice_no',ProTransactions::LENGTH_TRANS_NO);
            $noWithoutPrefix = str_replace($prefix_code_invoice, '', $oldInvoiceNo) + 200000;	// fix to not duplicated with transaction invoice
            $this->invoice_no = $prefix_code_invoice . $noWithoutPrefix;
            $prefix_code_invoice = "TR".date('Y').date('m');
            $this->transactions_no = MyFormat::getNextId('FiInvoice',$prefix_code_invoice,'transactions_no',ProTransactions::LENGTH_TRANS_NO);
            $this->created_by = Yii::app()->user->id;
        }
        return parent::beforeSave();
    }
    
    /**
     * @Author: ANH DUNG Sep 22, 2014
     * @Todo: something
     * @Param: $model
    */
    public static function CanUpdate($model) {
//        if(Yii::app()->user->role_id != ROLE_ADMIN){
//            if(Yii::app()->user->id != $model->user_id){
//                return false;
//            }
//        }
        return true;
    }

    
    protected function beforeDelete(){
        FiInvoiceDetail::DeleteByInvoiceId($this->id);
        FiInvoiceReceipt::DeleteByInvoiceId($this->id);
        return parent::beforeDelete();
    }
    
    /**
     * @Author: ANH DUNG Sep 12, 2014
     * @Todo: upate status paid or unpaid of invoice
     * @Param: $model model 
     * @Return: $status
     */
    public static function UpdateStatusInvoice($model, $status){
        $model->status = $status;
        $model->update(array('status'));
    }
    
    public static function UpdateFieldInvoice($model, $FieldName, $value){
        if(is_null($model)) return;
        $model->$FieldName = $value;
        $model->update(array($FieldName));
    }
    
    /**
     * @Author: ANH DUNG Sep 12, 2014
     * @Todo: calc report
     * @Param: $model model 
     */
    public static function CalcReport($model){
        $aRes = array();
        if(empty($model->date_from)){
            $model->date_from = date("d/m/Y");
        }
        if(empty($model->date_to)){
            $model->date_to = date("d/m/Y");
        }
        $date_from = MyFormat::dateConverDmyToYmd($model->date_from);
        $date_to = MyFormat::dateConverDmyToYmd($model->date_to);
        
        switch ($model->report_type) {
            case FiInvoice::REPORT_DAILY:
                self::ReportDaily($model, $aRes, $date_from, $date_to);
                break;
            case FiInvoice::REPORT_MONTHLY:
                self::ReportMonthly($model, $aRes, $date_from, $date_to);
                break;
            case FiInvoice::REPORT_YEARLY:
                self::ReporYearly($model, $aRes, $date_from, $date_to);
                break;
            default:
                break;
        }
        $_SESSION['REPORT_DATA'] = $aRes;
        $_SESSION['REPORT_TYPE'] = $model->report_type;
        return $aRes;
    }
    
    /**
     * @Author: ANH DUNG Sep 12, 2014
     * @Todo: calc report daily
     * @Param: $model model 
     * @Param: $aRes var return
     * @Param: $date_from 2014-05-25
     * @Param: $date_to model 2014-09-25
     * BA-Tung Hoang: cai sales report cua financial anh 
        lay nhung cai amount cua invoice ma da paid roi tru cho cai amount cua voucher DA PAID
     */
    public static function ReportDaily($model, &$aRes, $date_from, $date_to){
        $criteria = new CDbCriteria();
        $criteria->addBetweenCondition("t.date_paid",$date_from,$date_to);
        $criteria->compare('t.status', FiInvoice::PAID);
        $criteria->select = "sum(total_amount_due) as total_amount_due,"
                . " t.date_paid, count(t.id) as count_record";        
        $criteria->group = "t.date_paid"; 
        $criteria->order = "t.date_paid";
        $models = self::model()->findAll($criteria);
        foreach($models as $item){
            $aRes['TOTAL_AMOUNT_INVOICE'][$item->date_paid] = $item->total_amount_due;
            $aRes['COUNT_TRANS'][$item->date_paid] = $item->count_record;
        }
        
        $criteria->select = "sum(total_amount) as total_amount,"
                . " t.date_paid, count(t.id) as count_record"; 
        $mVoucher = FiPaymentVoucher::model()->findAll($criteria);
        foreach($mVoucher as $item){
            $aRes['TOTAL_AMOUNT_VOUCHER'][$item->date_paid] = $item->total_amount;
        }
        $aRes['LOOP_VAR'] = MyFormat::getArrayDay($date_from, $date_to);
    }
    
    /**
     * @Author: ANH DUNG Sep 12, 2014
     * @Todo: calc report monthly
     * @Param: $model model 
     * @Param: $aRes var return
     * @Param: $date_from 2014-05-25
     * @Param: $date_to model 2014-09-25
     */
    public static function ReportMonthly($model, &$aRes, $date_from, $date_to){
        $criteria = new CDbCriteria();
        $criteria->addBetweenCondition("t.date_paid",$date_from,$date_to);
        $criteria->compare('t.status', FiInvoice::PAID);
        $criteria->select = "sum(total_amount_due) as total_amount_due, "
                . "month(t.date_paid) as month_paid, year(t.date_paid) as year_paid, count(t.id) as count_record";
        $criteria->group = "month(t.date_paid), year(t.date_paid)";
        $criteria->order = "t.date_paid";
        
        $models = self::model()->findAll($criteria);
        foreach($models as $item){
            $aRes['TOTAL_AMOUNT_INVOICE'][$item->year_paid][$item->month_paid] = $item->total_amount_due;
            $aRes['COUNT_TRANS'][$item->year_paid][$item->month_paid] = $item->count_record;
            $aRes['LOOP_VAR'][$item->year_paid][$item->month_paid] = 1;
        }
        
        $criteria->select = "sum(total_amount) as total_amount,"
        . "month(t.date_paid) as month_paid, year(t.date_paid) as year_paid, count(t.id) as count_record"; 
        $mVoucher = FiPaymentVoucher::model()->findAll($criteria);
        foreach($mVoucher as $item){
            $aRes['TOTAL_AMOUNT_VOUCHER'][$item->year_paid][$item->month_paid] = $item->total_amount;
            $aRes['LOOP_VAR'][$item->year_paid][$item->month_paid] = 1;
        }
    }
    
    /**
     * @Author: ANH DUNG Sep 12, 2014
     * @Todo: calc report yearly
     * @Param: $model model 
     * @Param: $aRes var return
     * @Param: $date_from 2014-05-25
     * @Param: $date_to model 2014-09-25
     */
    public static function ReporYearly($model, &$aRes, $date_from, $date_to){
        $criteria = new CDbCriteria();
        $criteria->addBetweenCondition("t.date_paid",$date_from,$date_to);
        $criteria->compare('t.status', FiInvoice::PAID);
        $criteria->select = "sum(total_amount_due) as total_amount_due, "
                . "year(t.date_paid) as year_paid, count(t.id) as count_record";
        $criteria->group = "year(t.date_paid)"; 
        $criteria->order = "t.date_paid";
        $models = self::model()->findAll($criteria);
        foreach($models as $item){
            $aRes['TOTAL_AMOUNT_INVOICE'][$item->year_paid] = $item->total_amount_due;
            $aRes['COUNT_TRANS'][$item->year_paid] = $item->count_record;
            $aRes['LOOP_VAR'][$item->year_paid] = 1;
        }
        
        $criteria->select = "sum(total_amount) as total_amount,"
        . "year(t.date_paid) as year_paid, count(t.id) as count_record"; 
        $mVoucher = FiPaymentVoucher::model()->findAll($criteria);
        foreach($mVoucher as $item){
            $aRes['TOTAL_AMOUNT_VOUCHER'][$item->year_paid] = $item->total_amount;
            $aRes['LOOP_VAR'][$item->year_paid] = 1;
        }
    }
    
    
     /**
     * @Author: ANH DUNG Sep 15, 2014
     * @Todo: calc report
     * @Param: $model model 
     */
    public static function ToExcelReport(){
        if( isset($_SESSION['REPORT_DATA']['COUNT_TRANS']) && isset($_GET['to_excel'])){
            ExportExcel::ReportFinancial();
        }
    }
    
     /**
     * @Author: ANH DUNG Sep 15, 2014
     * @Todo: calc report
     * @Param: $model model 
     */
    public static function ToExcelReportTrans(){
        if( isset($_SESSION['REPORT_TRANSACTION']['COUNT_TRANS']) && isset($_GET['to_excel'])){
            ExportExcel::ReportTrans();
        }
    }
    
 /**
     * @Author: ANH DUNG Sep 12, 2014
     * @Todo: calc report
     * @Param: $model model 
     */
    public static function CalcReportTrans($model){
        $aRes = array();
        if(empty($model->date_from)){
            $model->date_from = date("d/m/Y");
        }
        if(empty($model->date_to)){
            $model->date_to = date("d/m/Y");
        }
        $date_from = MyFormat::dateConverDmyToYmd($model->date_from);
        $date_to = MyFormat::dateConverDmyToYmd($model->date_to);
        
        switch ($model->report_type) {
            case FiInvoice::REPORT_DAILY:
                self::ReportDailyTrans($model, $aRes, $date_from, $date_to);
                break;
            case FiInvoice::REPORT_MONTHLY:
                self::ReportMonthlyTrans($model, $aRes, $date_from, $date_to);
                break;
            case FiInvoice::REPORT_YEARLY:
                self::ReporYearlyTrans($model, $aRes, $date_from, $date_to);
                break;
            default:
                break;
        }
        $_SESSION['REPORT_TRANSACTION'] = $aRes;
        $_SESSION['REPORT_TYPE'] = $model->report_type;
        return $aRes;
    }
    
    /**
     * @Author: ANH DUNG Sep 15, 2014
     * @Todo: calc report daily
     * @Param: $model model 
     * @Param: $aRes var return
     * @Param: $date_from 2014-05-25
     * @Param: $date_to model 2014-09-25
     * BA-Tung Hoang: cai sales report cua financial anh 
        lay nhung cai amount cua invoice ma da paid roi tru cho cai amount cua voucher DA PAID
     */
    public static function ReportDailyTrans($model, &$aRes, $date_from, $date_to){
        $criteria = new CDbCriteria();
        $criteria->addBetweenCondition("t.received_on",$date_from,$date_to);
        $criteria->compare('t.status', STATUS_GEN_RECEIPT);
        $criteria->addCondition('t.received_on IS NOT NULL');
        $criteria->select = "sum(profit_to_property_info) as profit_to_property_info,sum(profit_to_property_info_by_company) as profit_to_property_info_by_company,"
                . " t.received_on, count(DISTINCT t.transactions_id) as count_record";        
        $criteria->group = "t.received_on"; 
        $criteria->order = "t.received_on";
        $models = ProTransactionsSaveCommission::model()->findAll($criteria);
        foreach($models as $item){
            $aRes['TOTAL_AMOUNT_INVOICE'][$item->received_on] = $item->profit_to_property_info+$item->profit_to_property_info_by_company;
            $aRes['COUNT_TRANS'][$item->received_on] = $item->count_record;
        }
        
        $aRes['LOOP_VAR'] = MyFormat::getArrayDay($date_from, $date_to);
    }
    
    /**
     * @Author: ANH DUNG Sep 15, 2014
     * @Todo: calc report monthly
     * @Param: $model model 
     * @Param: $aRes var return
     * @Param: $date_from 2014-05-25
     * @Param: $date_to model 2014-09-25
     */
    public static function ReportMonthlyTrans($model, &$aRes, $date_from, $date_to){
        $criteria = new CDbCriteria();
        $criteria->addBetweenCondition("t.received_on",$date_from,$date_to);
        $criteria->compare('t.status', STATUS_GEN_RECEIPT);
        $criteria->addCondition('t.received_on IS NOT NULL');
        $criteria->select = "sum(profit_to_property_info) as profit_to_property_info,sum(profit_to_property_info_by_company) as profit_to_property_info_by_company,"
                . " month(t.received_on) as month_paid, year(t.received_on) as year_paid, "
                . "count(DISTINCT t.transactions_id) as count_record"; 
        $criteria->group = "month(t.received_on), year(t.received_on)";
        $criteria->order = "t.received_on";
        
        $models = ProTransactionsSaveCommission::model()->findAll($criteria);
        foreach($models as $item){
            $aRes['TOTAL_AMOUNT_INVOICE'][$item->year_paid][$item->month_paid] = $item->profit_to_property_info+$item->profit_to_property_info_by_company;
            $aRes['COUNT_TRANS'][$item->year_paid][$item->month_paid] = $item->count_record;
            $aRes['LOOP_VAR'][$item->year_paid][$item->month_paid] = 1;
        }
    }
    
    /**
     * @Author: ANH DUNG Sep 15, 2014
     * @Todo: calc report yearly
     * @Param: $model model 
     * @Param: $aRes var return
     * @Param: $date_from 2014-05-25
     * @Param: $date_to model 2014-09-25
     */
    public static function ReporYearlyTrans($model, &$aRes, $date_from, $date_to){
        $criteria = new CDbCriteria();
        $criteria->addBetweenCondition("t.received_on",$date_from,$date_to);
        $criteria->compare('t.status', STATUS_GEN_RECEIPT);
        $criteria->addCondition('t.received_on IS NOT NULL');
        $criteria->select = "sum(profit_to_property_info) as profit_to_property_info,sum(profit_to_property_info_by_company) as profit_to_property_info_by_company,"
                . " year(t.received_on) as year_paid, "
                . "count(DISTINCT t.transactions_id) as count_record";         
        
        $criteria->group = "year(t.received_on)"; 
        $criteria->order = "t.received_on";
        $models = ProTransactionsSaveCommission::model()->findAll($criteria);
        foreach($models as $item){
            $aRes['TOTAL_AMOUNT_INVOICE'][$item->year_paid] = $item->profit_to_property_info+$item->profit_to_property_info_by_company;
            $aRes['COUNT_TRANS'][$item->year_paid] = $item->count_record;
            $aRes['LOOP_VAR'][$item->year_paid] = 1;
        }       
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
     * @Author: ANH DUNG Oct 29, 2014
     * @Todo: get text when view invoice of financial module
     * @Param: $model
     */
    public static function getFiTextViewInvoice($model) {
        $res = '';
        if($model->bill_to == FiInvoice::FI_BILLTO_SELLER){
            $res = 'Being commission due to us for services rendered in connection with the sales of the above-mentioned property.';
        }elseif($model->bill_to == FiInvoice::FI_BILLTO_LANDLORD){
            $res = 'Being commission due to us for services rendered in connection with the lease of the above-mentioned property.';
        }elseif($model->bill_to == FiInvoice::FI_BILLTO_CO_BROKE){
            $res = 'Being co-broke commission due to us for services rendered in connection with the sales of the above-mentioned property.';
        }elseif($model->bill_to == FiInvoice::FI_BILLTO_CO_BROKE_RENTAL){
            $res = 'Being co-broke commission due to us for services rendered in connection with the lease of the above-mentioned property.';
        }elseif($model->bill_to == FiInvoice::FI_BILLTO_OTHER){
            $res = 'Being commission due to us for services rendered in connection with the above-mentioned property.';
        }
        return $res;
    }       
    
            
}
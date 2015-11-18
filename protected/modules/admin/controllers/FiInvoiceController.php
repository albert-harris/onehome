<?php

class FiInvoiceController extends AdminController
{
   
    public function actionView($id)
    {
            try{
            $this->render('view',array(
                    'model'=>$this->loadModel($id), 'actions' => $this->listActionsCanAccess,
            ));
            }
            catch (Exception $e)
            {
                Yii::log("Exception ".  print_r($e, true), 'error');
                throw  new CHttpException("Exception ".  print_r($e, true));     
            }
    }
    
    public function fnAddProperty(){
        if(isset($_GET['row_number'])){
            $this->layout='ajax';
            $model=new FiInvoiceDetail('AddProperty');
            if(isset($_POST['FiInvoiceDetail']))
            {
                $model->attributes=$_POST['FiInvoiceDetail'];
                if($model->save()){
                    $returnVal = array();
                    $returnVal[] = array(
                        'id' => $model->id,
                        'row_number' => $_GET['row_number'],
//                        'description' => FiInvoiceDetail::fnBuildDescription($model),
                        'description' => $model->description,
                    );
                    $json = CJSON::encode($returnVal);                                   
                    die("<script type='text/javascript'>parent.$.fn.colorbox.close(); parent.fnUpdateAddProperty('$json');</script>"); 
                }
            }
            
            $this->render('AddProperty',array(
                    'model'=>$model, 'actions' => $this->listActionsCanAccess,
            ));
            die;
        }
    }

    
    public function actionCreate()
    {
        try
        {
            $this->fnAddProperty();
            $model=new FiInvoice('create');
            $model->aModelDetail =  array(new FiInvoiceDetail());
            if(isset($_POST['FiInvoice']))
            {
                $model->attributes=$_POST['FiInvoice'];
                if($model->save()){
                    FiInvoiceDetail::fnUpdateInvoiceId($_POST['FiInvoiceDetail']['id'], $model->id);
                    FiInvoiceDetail::fnUpdateAmount($model);
                    FiInvoice::fnUpdateTotalAmount($model);
                    $this->redirect(array('view','id'=>$model->id));
                }
            }

            $this->render('create',array(
                    'model'=>$model, 'actions' => $this->listActionsCanAccess,
            ));
            }
            catch (Exception $e)
            {
                Yii::log("Exception ".  print_r($e, true), 'error');
                throw  new CHttpException("Exception ".  print_r($e, true));     
            }
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
            try
            {
            $model=$this->loadModel($id);
            $model->scenario = 'update';
            $model->aModelDetail = $model->rDetail;
            if(!FiInvoice::CanUpdate($model)){
                $this->redirect(array('index'));
            }

            if(isset($_POST['FiInvoice']))
            {
                $model->attributes=$_POST['FiInvoice'];
                if($model->save()){
                    FiInvoiceDetail::deleteDetail($model);
                    FiInvoiceDetail::fnUpdateInvoiceId($_POST['FiInvoiceDetail']['id'], $model->id);
                    FiInvoiceDetail::fnUpdateAmount($model);
                    FiInvoice::fnUpdateTotalAmount($model);
                    $this->redirect(array('view','id'=>$model->id));
//                    $this->redirect(array('update','id'=>$model->id));
                }
            }

            $this->render('update',array(
                    'model'=>$model, 'actions' => $this->listActionsCanAccess,
            ));
            }
            catch (Exception $e)
            {
                Yii::log("Exception ".  print_r($e, true), 'error');
                throw  new CHttpException("Exception ".  print_r($e, true));     
            }
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
            try
            {
            if(Yii::app()->request->isPostRequest)
            {
                    // we only allow deletion via POST request
                    if($model = $this->loadModel($id))
                    {
                        if($model->delete())
                            Yii::log("Delete record ".  print_r($model->attributes, true), 'info');
                    }

                    // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
                    if(!isset($_GET['ajax']))
                            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
            }
            else
            {
                Yii::log("Invalid request. Please do not repeat this request again.");
                throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
            }	
            }
            catch (Exception $e)
            {
                Yii::log("Exception ".  print_r($e, true), 'error');
                throw new CHttpException(400,$e->getMessage());
            }
    }

    /**
     * Manages all models.
     */
    public function actionIndex()
    {
        try
        {
            $model=new FiInvoice('search');
            $model->unsetAttributes();  // clear any default values
            if(isset($_GET['FiInvoice']))
                    $model->attributes=$_GET['FiInvoice'];

            $this->render('index',array(
                    'model'=>$model, 'actions' => $this->listActionsCanAccess,
            ));
            }
            catch (Exception $e)
            {
                Yii::log("Exception ".  print_r($e, true), 'error');
                throw  new CHttpException("Exception ".  print_r($e, true));     
            }
    }    
    
    /**
     * @Author: ANH DUNG Oct 22, 2014
     */
    public function actionTransactionInvoice()
    {
        try
        {
            $model=new ProTransactionsInvoice();
            $model->unsetAttributes();  // clear any default values
            if(isset($_GET['ProTransactionsInvoice']))
                    $model->attributes=$_GET['ProTransactionsInvoice'];

            $model->invoice_type = ProTransactionsInvoice::TYPE_INVOICE;
            $this->render('TransactionInvoice',array(
                    'model'=>$model, 'actions' => $this->listActionsCanAccess,
            ));
            }
            catch (Exception $e)
            {
                Yii::log("Exception ".  print_r($e, true), 'error');
                throw  new CHttpException("Exception ".  print_r($e, true));     
            }
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
            try
            {
            $model=FiInvoice::model()->findByPk($id);
            if($model===null)
            {
                Yii::log("The requested page does not exist.");
                throw new CHttpException(404,'The requested page does not exist.');
            }			
            return $model;
            }
            catch (Exception $e)
            {
                Yii::log("Exception ".  print_r($e, true), 'error');
                throw  new CHttpException("Exception ".  print_r($e, true));     
            }
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model)
    {
            try
            {
            if(isset($_POST['ajax']) && $_POST['ajax']==='fi-invoice-form')
            {
                    echo CActiveForm::validate($model);
                    Yii::app()->end();
            }
            }
            catch (Exception $e)
            {
                Yii::log("Exception ".  print_r($e, true), 'error');
                throw  new CHttpException("Exception ".  print_r($e, true));     
            }
    }
    
    
    public function actionAccountsReceivables(){
        try
        {
            $model=new FiInvoice('search');
            $model->unsetAttributes();  // clear any default values
            $model->status = FiInvoice::UNPAID;
            if(isset($_GET['FiInvoice']))
                $model->attributes=$_GET['FiInvoice'];
            $this->render('AccountsReceivables',array(
                    'model'=>$model, 'actions' => $this->listActionsCanAccess,
            ));
        }
        catch (Exception $e)
        {
            Yii::log("Exception ".  print_r($e, true), 'error');
            throw  new CHttpException("Exception ".  print_r($e, true));     
        }
    }        
    
    /**
     * @Author: ANH DUNG Sep 12, 2014
     * @Todo: GenerateReceipt
     * @Param: $invoice_id
     */
    public function actionGenerateReceipt($invoice_id){
    try
    {
        $mInvoice = $this->loadModel($invoice_id);
        $this->layout='ajax';
        $model=new FiInvoiceReceipt('GenerateReceipt');
        $model->receipt_date_paid = date('d/m/Y');
        $model->invoice_id = $mInvoice->id;
        if(isset($_POST['FiInvoiceReceipt']))
        {
            $model->attributes=$_POST['FiInvoiceReceipt'];
            if($model->save()){
                FiInvoice::UpdateStatusInvoice($mInvoice, FiInvoice::PAID);
                die('<script type="text/javascript">parent.$.fn.colorbox.close(); parent.$.fn.yiiGridView.update("fi-invoice-grid");</script>'); 
            }
        }

        $this->render('GenerateReceipt',array(
                'model'=>$model, 'actions' => $this->listActionsCanAccess,
        ));
    }
    catch (Exception $e)
    {
        Yii::log("Exception ".  print_r($e, true), 'error');
        throw  new CHttpException("Exception ".  print_r($e, true));     
    }
    }
    
    public function actionViewReceipt($id){
        try
        {
            $model = MyFormat::loadModelByClass($id, 'FiInvoiceReceipt');
            $this->render('ViewReceipt',array(
                    'model'=>$model, 'actions' => $this->listActionsCanAccess,
            ));
        }
        catch (Exception $e)
        {
            Yii::log("Exception ".  print_r($e, true), 'error');
            throw  new CHttpException("Exception ".  print_r($e, true));     
        }
    }        
    
    /**
     * @Author: ANH DUNG Sep 12, 2014
     * @Todo: show Report
     */    
    public function actionReport(){
        try
        {
            FiInvoice::ToExcelReport();
            $model=new FiInvoice();
            $model->date_from = date("d/m/Y");
            $model->date_to = date("d/m/Y");
            $model->report_type = FiInvoice::REPORT_DAILY;
            $data = array();
            unset($_SESSION['REPORT_DATA']);
            if(isset($_POST['FiInvoice']))
            {
                $model->attributes=$_POST['FiInvoice'];
                $data = FiInvoice::CalcReport($model);
            }
            
            $this->render('report/Report',array(
                'model'=>$model, 'actions' => $this->listActionsCanAccess,
                'data'=>$data
            ));
        }
        catch (Exception $e)
        {
            Yii::log("Exception ".  print_r($e, true), 'error');
            throw  new CHttpException("Exception ".  print_r($e, true));     
        }
    }        
    
    
    /**
     * @Author: ANH DUNG Sep 15, 2014
     * @Todo: show Report
     */    
    public function actionReport_transaction(){
        try
        {
            FiInvoice::ToExcelReportTrans();
            $model=new FiInvoice();
            $model->date_from = date("d/m/Y");
            $model->date_to = date("d/m/Y");
            $model->report_type = FiInvoice::REPORT_DAILY;
            $data = array();
            unset($_SESSION['REPORT_TRANSACTION']);
            if(isset($_POST['FiInvoice']))
            {
                $model->attributes=$_POST['FiInvoice'];
                $data = FiInvoice::CalcReportTrans($model);
            }
            
            $this->render('Report_transaction/Report_transaction',array(
                'model'=>$model, 'actions' => $this->listActionsCanAccess,
                'data'=>$data
            ));
        }
        catch (Exception $e)
        {
            Yii::log("Exception ".  print_r($e, true), 'error');
            throw  new CHttpException("Exception ".  print_r($e, true));     
        }
    }        
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    /*** KU TOAN HERE */
    public function actionPaymentVouchers(){
        try
        {   
            $model = new FiPaymentVoucher();
            $model->unsetAttributes();  // clear any default values
            if(isset($_GET['FiPaymentVoucher'])){
                $model->attributes = $_GET['FiPaymentVoucher'];
            }
            $this->render('index payment_voucher',array(
                 'actions' => $this->listActionsCanAccess,
                 'model'   => $model
            )); 
        }
        catch (Exception $e)
        {
            Yii::log("Exception ".  print_r($e, true), 'error');
            throw  new CHttpException("Exception ".  print_r($e, true));     
        }
    }
    
    public function actionAccountPayable(){
        try
        {   
            $model = new FiPaymentVoucher();
            $model->unsetAttributes();  // clear any default values
            if(isset($_GET['FiPaymentVoucher'])){
                $model->attributes = $_GET['FiPaymentVoucher'];
            }
            $model->status = STATUS_INACTIVE;
            $this->render('account_payable',array(
                 'actions' => $this->listActionsCanAccess,
                 'model'   => $model
            )); 
        }
        catch (Exception $e)
        {
            Yii::log("Exception ".  print_r($e, true), 'error');
            throw  new CHttpException("Exception ".  print_r($e, true));     
        }

        
    }
    
    public function actionUpdateStatusVoucher(){
        // dung ham nay de load model
        MyFormat::loadModelByClass($id, $ClassName);
    }
    
    public function actionViewVoucher($id){
        $model = MyFormat::loadModelByClass($id,'FiPaymentVoucher');
        if($model){
            $dataTmp = FiPaymentVoucherDetail::getDataWithWithVoucherID($id); 
        }else{
            throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
        }
        $this->render('payment_vouchers/view',array(
                 'actions' => $this->listActionsCanAccess,
                 'model'   => $model,
                 'dataTmp' => $dataTmp
        ));
    }
    
    public function actionCreateVoucher(){
        try
        {   
            $model = new FiPaymentVoucher('create_voucher');
            $model->created_date = date('d-m-Y');
            $dataTmp = '';
            if(isset($_POST['FiPaymentVoucher'])) {
                $model->attributes = $_POST['FiPaymentVoucher'];
                if($model->validate()){
                    $model->created_date = date('Y-m-d');
                    if($model->save()){
                        //save detail
                        FiPaymentVoucherDetail::saveDetailWithVoucherID($model->id,$_POST['FiPaymentVoucherDetail']);   
                    } 
                     $this->redirect(Yii::app()->createAbsoluteUrl('admin/fiInvoice/viewvoucher',array('id'=>$model->id)))  ;                       
                }else{
                    $dataTmp = FiPaymentVoucher::converData($_POST['FiPaymentVoucherDetail']);  
                }
            }
            $this->render('payment_voucher',array(
                     'actions' => $this->listActionsCanAccess,
                     'model'   => $model,
                     'dataTmp' => $dataTmp
            )); 
        }
        catch (Exception $e)
        {
            Yii::log("Exception ".  print_r($e, true), 'error');
            throw  new CHttpException("Exception ".  print_r($e, true));     
        }
    }

    public function actionUpdateVoucher($id){
        $model = MyFormat::loadModelByClass($id,'FiPaymentVoucher');
        $cmsFormater = new CmsFormatter();
        if($model){
            if(!FiPaymentVoucher::CanUpdate($model)){
                $this->redirect(array('index'));
            }
            $model->scenario = 'update_voucher';
            $dataTmp = '';
            if(isset($_POST['FiPaymentVoucher'])) {
                $model->attributes = $_POST['FiPaymentVoucher'];
                if($model->validate()){
                    $statusTmp =  MyFormat::loadModelByClass($id,'FiPaymentVoucher');
                    if($statusTmp->status !=STATUS_ACTIVE && $model->status==STATUS_ACTIVE && empty($model->date_paid)){
                        $model->date_paid = date('Y-m-d');
                    }
                    
                    if($model->save()){
                        //save detail
                        FiPaymentVoucherDetail::saveDetailWithVoucherID($model->id,$_POST['FiPaymentVoucherDetail']);   
                    }   
                    $this->redirect(Yii::app()->createAbsoluteUrl('admin/fiInvoice/viewvoucher',array('id'=>$id)))  ;               
                }
            }else{
                $model->created_date = date('d-m-Y',strtotime($model->created_date));
//                $model->date_paid    = ($model->date_paid !='' &&  $model->date_paid !='0000-00-00') ?  date('d-m-Y',strtotime($model->date_paid)) : date('d-m-Y');                
                $model->date_paid = $cmsFormater->formatDatePickerInput($model->date_paid);
                $dataTmp = FiPaymentVoucherDetail::getDataWithWithVoucherID($id); 
            }               
        }else{
            throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
        }
        $this->render('payment_voucher',array(
                 'actions' => $this->listActionsCanAccess,
                 'model'   => $model,
                 'dataTmp' => $dataTmp
        )); 
    }
    
    public function actionDeleteVoucher($id){
        // dung ham nay de load model
         $model = MyFormat::loadModelByClass($id,'FiPaymentVoucher');
       if($model){
            FiPaymentVoucherDetail::model()->deleteAllByAttributes(array('voucher_id'=>$model->id));
            $model->delete();
       }
    }
    
    public  function actionPrintvoucher($id){
        $model = MyFormat::loadModelByClass($id,'FiPaymentVoucher');
        if($model){
            $dataTmp = FiPaymentVoucherDetail::getDataWithWithVoucherID($id,'type'); 
        }else{
            throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
        }
        $this->render('payment_vouchers/print_voucher',array(
             'actions' => $this->listActionsCanAccess,
             'model'   => $model,
             'dataTmp' => $dataTmp
        ));

    }

    
}

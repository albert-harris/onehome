<?php

class TransactionsController extends AdminController
{
    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        try{
            $mTransactions = $this->loadModel($id);
            $mTransactions->mBillTo = $mTransactions->rBillTo?$mTransactions->rBillTo:( new ProTransactionsBillTo());
            $mTransactions->mPropertyDetail = $mTransactions->rPropertyDetail?$mTransactions->rPropertyDetail:( new ProTransactionsPropertyDetail() );
            $mTransactions->aModelPropertyDocument = count($mTransactions->rPropertyDocument)?$mTransactions->rPropertyDocument:( ProTransactionsPropertyDocument::getDefaultArrayForCreate($mTransactions->type) );
            $this->render('view',array(
                    'mTransactions'=> $mTransactions, 'actions' => $this->listActionsCanAccess,
            ));
        }
        catch (Exception $e)
        {
            Yii::log("Exception ".  print_r($e, true), 'error');
            throw  new CHttpException("Exception ".  print_r($e, true));     
        }
    }
    
    
    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
            try
            {
            $model=new ProTransactions('create');

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);

            if(isset($_POST['ProTransactions']))
            {
                    $model->attributes=$_POST['ProTransactions'];
                    if($model->save())
                            $this->redirect(array('view','id'=>$model->id));
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
        ProTransactions::deleteTransExpiredAfterDays();
            try
            {
            $model=new ProTransactions('search');
            $model->unsetAttributes();  // clear any default values
            if(isset($_GET['ProTransactions']))
                    $model->attributes=$_GET['ProTransactions'];
            if(isset($_GET['listing_id']))
                $model->listing_id=$_GET['listing_id'];
            

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
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
            try
            {
            $model=ProTransactions::model()->findByPk($id);
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
            if(isset($_POST['ajax']) && $_POST['ajax']==='pro-transactions-form')
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
    
    /**
     * @Author: ANH DUNG Jul 09, 2014
     * @Todo: gen some invoice for transaction
     * @Param: $transactions_id
     */    
    public function actionAjaxGenInvoice($transactions_id){
        // not use this action, because invoice gen after create transaction success
        if(Yii::app()->request->isPostRequest){
            $model = $this->loadModel($transactions_id);
            if($model->status == STATUS_ACTIVE){
            }
        }
        die;
    }
    
    /**
     * @Author: ANH DUNG Jul 09, 2014
     * @Todo: gen some voucher for transaction
     * @Param: $transactions_id
     */    
    public function actionAjaxGenVoucher($transactions_id){
        if(Yii::app()->request->isPostRequest){
            $model = $this->loadModel($transactions_id);
            if($model->status == STATUS_GEN_INVOICE){
                ProTransactionsInvoice::DoGenVoucher($model);
                $model->status = STATUS_GEN_VOUCHER;
                $model->update(array('status'));                
            }
        }
        die;
    }
    
    /**
     * @Author: ANH DUNG Jul 09, 2014
     * @Todo: gen some voucher for transaction
     * @Param: $transactions_id
     */    
    public function actionAjaxGenReceipt($transactions_id){
        try{            
            $mTrans = $this->loadModel($transactions_id);
            if ($mTrans->status != STATUS_GEN_RECEIPT) {
//            if (1) {
                $model=new ProTransactionsInvoice('GenReceipt');
                $model->transactions_id = $mTrans->id;
                $model->receipt_date_paid = date('d/m/Y');
                $this->layout='ajax';
                if(isset($_POST['ProTransactionsInvoice']))
                {
                    $model->attributes=$_POST['ProTransactionsInvoice'];
                    $model->validate();
                    if(!$model->hasErrors()){
                        ProTransactionsInvoice::DoGenReceipt($model, $mTrans);
                        die('<script type="text/javascript">parent.$.fn.colorbox.close(); parent.$.fn.yiiGridView.update("pro-transactions-grid");</script>'); 
                    }
                }            
                $this->render('receipt/create',array(
                    'model'=>$model, 
                    'mTrans'=>$mTrans,
                    'actions' => $this->listActionsCanAccess,
                ));
            }
            die;
        }
        catch (Exception $e)
        {
            Yii::log("Exception ".  print_r($e, true), 'error');
            throw  new CHttpException("Exception ".  print_r($e, true));     
        }
    }
    
    /**
     * @Author: ANH DUNG Jul 09, 2014
     * @Todo: view invoice for transaction
     * @Param: $id
     */        
    public function actionViewInvoice($id){
        $model = MyFormat::loadModelByClass($id, 'ProTransactionsInvoice');
        $mTransactions = ProTransactions::LoadModelRelationByPk($model->transactions_id);
        $this->render('ViewInvoice/print_invoice',array(
            'model'=>$model,
            'mTransactions'=>$mTransactions,
            'actions' => $this->listActionsCanAccess,
        ));
    }
    
    /**
     * @Author: ANH DUNG Jul 29, 2014
     * @Todo: TENANCIES MANAGEMENT
     */       
    public function actionApproveTransaction($id){
        $model = $this->loadModel($id);
        $model->scenario = "ApproveTransaction";
        $this->layout='ajax';
        if(isset($_POST['ProTransactions'])){
            $model->attributes=$_POST['ProTransactions'];
            $model->validate();
            if( !$model->hasErrors() ){
                if($model->admin_approved){
                    ProTransactions::UpdateAdminStatus($model, $model->admin_approved);
                    ProTransactionsInvoice::AutoGenInvoice($model);
                }
                die('<script type="text/javascript">parent.$.fn.colorbox.close(); parent.$.fn.yiiGridView.update("pro-transactions-grid");</script>'); 
            }
        }
        $this->render('ApproveTransaction',array(
            'model'=>$model,
            'actions' => $this->listActionsCanAccess,
        ));
    }
    
    /**
     * @Author: ANH DUNG Sep 03, 2014
     * @Todo: under construction page
     */
    public function actionFinancial(){
        $this->render('Financial',array(
            'actions' => $this->listActionsCanAccess,
        ));
    }
    
    /**
     * @Author: ANH DUNG Sep 19, 2014
     * @Todo: show summayry report transaction approved
     */
    public function actionSummaryReport(){
    try
    {
            set_time_limit(3600);
            ProTransactions::ToExcelReport();
            $model=new ProTransactions();
            $model->date_from = date("d/m/Y");
            $model->date_to = date("d/m/Y");
            $data = array();
//            unset($_SESSION['DATA_SUMMARY_REPORT']);
            if(isset($_POST['ProTransactions']))
            {
                $model->attributes=$_POST['ProTransactions'];
//                $data = ProTransactions::SummaryReport($model);
            }
            
            $this->render('SummaryReport/SummaryReport',array(
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
     * @Author: ANH DUNG Feb 03, 2015
     * @Todo: update transaction
     * @Param: $id
     * @sample link: /admin/tenancy/update/add_property/1/id/555/type/1/listing_id/0/user_id/266
     */
    public function actionUpdate($id)
    {
        try
        {
            $mTransactions = $this->loadModel($id);
            ProTransactions::CanUpdateTrans($mTransactions);
            if(isset($_GET['user_id'])){ // Jan 02, 2014 For backend
                $add_property = isset($_GET['add_property'])?$_GET['add_property']:$mTransactions->add_property;
//                ProTransactions::GetSomeInfoRecord($mTransactions, $add_property);
                ProTransactions::GetSomeInfoRecordWithNoOverideModel($mTransactions, $add_property);
                ProTransactions::HandlePost($mTransactions);
            }
            
            $this->render('update/record_existing_tenancy',array(
                    'mTransactions'=>$mTransactions, 'actions' => $this->listActionsCanAccess,
            ));
        }
        catch (Exception $e)
        {
            Yii::log("Exception ".  print_r($e, true), 'error');
            throw  new CHttpException("Exception ".  print_r($e, true));     
        }
    }
    
}

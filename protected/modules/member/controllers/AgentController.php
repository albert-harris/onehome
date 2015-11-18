
<?php

class AgentController extends MemberController{

    protected function beforeAction($event)
    {
        $role = Yii::app()->user->role_id;
        if ($role != ROLE_AGENT) {
            switch($role){
                case ROLE_REGISTER_MEMBER:
                    $this->redirect(Yii::app()->createAbsoluteUrl('member/member_profile/myprofile'));
                    break;
                case ROLE_TENANT:
                    $this->redirect(Yii::app()->createAbsoluteUrl('member/tenant/property'));
                    break;
                case ROLE_LANDLORD:
                    $this->redirect(Yii::app()->createAbsoluteUrl('member/landlord/property'));
                    break;
            }
        }
        return parent::beforeAction($event);
    }
    
    /**
     * <Create By Jason>
     * <TO show list of tenancies in agent user>
     */
    public function actionTenancy($status=null) {
        try {
            $this->pageTitle =  'Tenancy Management - '.Yii::app()->params['title'];

            if (!isset(Yii::app()->user->id)) {
                $this->redirect(Yii::app()->createAbsoluteUrl('/'));
            }
            $model = new ProTransactionsVendorPurchaserDetail();
            $model->status = $status;
            
            if($status == null || $status == STATUS_LISTING_ALL){
                $view = 'tenancy';
            }
            elseif($status == STATUS_LISTING_ACTIVE)
            {
                $view = 'index_active';
            }
            else{
                $view = 'index_expired';
            }
            if (isset($_GET['ProTransactionsVendorPurchaserDetail']))
                $model->attributes = $_GET['ProTransactionsVendorPurchaserDetail'];
//            $model = ProTransactionsVendorPurchaserDetail::getListTenanciesAgent($status);
            $this->render($view, array('model' => $model));

        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    /**
     * <Create By Jason>
     * <TO show list of document in tenant user>
     */

    public function actionDownload() {
        try {
            $this->pageTitle = 'Download - '.Yii::app()->params['title'];

            if (!isset(Yii::app()->user->id)) {
                $this->redirect(Yii::app()->createAbsoluteUrl('/'));
            }
            
            $document = ProUploadDocument::getListDocument();
            
            $this->render('download', array(
                'document'=>$document, 
            ));

        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }
    
    /**
     * <Create By Jason>
     * <TO show list of tenancies detail in tenant user>
     */
    public function actionTenancies_detail() {
        try {
            $this->pageTitle = 'Tenencies Details - '.Yii::app()->params['title'];

            if (!isset(Yii::app()->user->id)) {
                $this->redirect(Yii::app()->createAbsoluteUrl('/'));
            }
            
            $transaction = MyFormat::loadModelByClass($_GET['transaction_id'], 'ProTransactions');
            MyFormat::CheckValidRequest($transaction);
            $calllog = ProCallLog::getListCallLog($_GET['transaction_id']);
            $document = ProTransactionsPropertyDocument::getListDocument($_GET['transaction_id']);
            $report = ProReportDefect::getListReport($_GET['transaction_id']);
            $landlordInformation = ProTransactionsVendorPurchaserDetail::getTenancyInformation($_GET['transaction_id'], TYPE_LANDLORD);
            $tenantInformation = ProTransactionsVendorPurchaserDetail::getTenancyInformation($_GET['transaction_id'], TYPE_TENANT);
            
            $this->render('tenancies_detail', array(
                'report'=>$report, 
                'transaction' => $transaction, 
                'document'=>$document, 
                'calllog'=>$calllog,
                'landlordInformation'=>$landlordInformation,
                'tenantInformation'=>$tenantInformation
            ));

        } catch (Exception $exc) {            
            throw new CHttpException('404', $exc->getMessage());
        }
    }

    /**
     * <Jason>
     * <To show defect and calllog>
     */
    public function actionCalllog() {
        try {
            $this->pageTitle = 'Defect(s) and Call Log - '.Yii::app()->params['title'];

            if (!isset(Yii::app()->user->id)) {
                $this->redirect(Yii::app()->createAbsoluteUrl('/'));
            }
            
            $transaction = MyFormat::loadModelByClass($_GET['transaction_id'], 'ProTransactions');
            MyFormat::CheckValidRequest($transaction);
//            $transaction = ProTransactions::getByPk($_GET['transaction_id']);
            $calllog = ProCallLog::getListCallLog($_GET['transaction_id']);
            $report = ProReportDefect::getListReport($_GET['transaction_id']);            

            $this->render('calllog', array('report'=>$report, 
                'calllog'=>$calllog, 
                'transaction' => $transaction
            ));

        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }
    
    public function actionDelete() {
        try {
            if (isset($_GET['report_id'])) {
                $report = ProReportDefect::model()->findByPk($_GET['report_id']);
                if($report){
                    $report->delete();
                }
            }
            elseif(isset($_GET['document_id'])) {
                $document = ProTransactionsPropertyDocument::model()->findByPk($_GET['document_id']);
                if($document){
                    $document->delete();
                }
            }
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    /**
     * <Jason>
     * <My profile of user, who created by admin>
     */
    public function actionMyprofile(){
        try {
            $this->pageTitle = 'My Profile - '.Yii::app()->params['title'];
            $this->layout = 'application.views.layouts.layout_user';
            $mUser = Users::model()->findByPk(Yii::app()->user->id);
            $old_avartar = $mUser->avatar;
            $old_logo = $mUser->agent_company_logo;
            $mUser->scenario = 'myprofile_agent';

            if(isset($_POST['Users']))
            {
                $mUser->attributes=$_POST['Users'];
                $mUser->avatar = CUploadedFile::getInstance($mUser, 'avatar');
                $mUser->agent_company_logo = CUploadedFile::getInstance($mUser, 'agent_company_logo');
                
                if($mUser->validate()){
                    if ($_POST['Users']['newpassword'] != null && $_POST['Users']['password_confirm'] != null) {
                        if($mUser->password_hash == md5($_POST['Users']['newpassword'])){
                            $mUser->addError('newpassword', 'New password cannot be duplicate with current password.');
                        }
                        else{
                            $mUser->password_hash = md5(trim($_POST['Users']['newpassword']));
                            $mUser->temp_password = ($_POST['Users']['newpassword']);
                        }
                    }
                    if(!$mUser->getErrors()){
                        if (!is_null($mUser->avatar)) {
                            $mUser->avatar = Users::saveImage($mUser, 'avatar');
                            Users::resizeImage($mUser, 'avatar', Users::$aSize);
                            $mUser->update(array('avatar'));
                        }
                        else{
                            if (isset($_POST['delete_current_image']) && $_POST['delete_current_image'] == 'on') {
                                Users::deleteImage($mUser, 'avatar', Users::$aSize);
                                $mUser->avatar = NULL;
                                $mUser->update(array('avatar'));
                            }
                            else{
                                $mUser->avatar = $old_avartar;
                            }
                        }
                        
                        //For company logo
                        if (!is_null($mUser->agent_company_logo)) {
                            $mUser->agent_company_logo = Users::saveImage($mUser, 'agent_company_logo');
                            Users::resizeImage($mUser, 'agent_company_logo', Users::$aSizeLogo);                            
                            $mUser->update(array('agent_company_logo'));
                        }
                        else{
                            if (isset($_POST['delete_current_logo']) && $_POST['delete_current_logo'] == 'on') {
                                Users::deleteImage($mUser, 'agent_company_logo', Users::$aSizeLogo);
                                $mUser->agent_company_logo = NULL;
                                $mUser->update(array('agent_company_logo'));
                            }
                            else{
                                $mUser->agent_company_logo = $old_logo;
                            }
                        }
                            
                        if($mUser->save('agent_company_name', 'agent_cea' ,'nric_passportno_roc', 'email_not_login', 'last_name', 'first_name', 'password_hash', 'temp_password', 'phone', 'title', 'address', 'country_id', 'postal_code')){
                            Yii::app()->user->setFlash('success', "My Profile has changed!");
                            $mUser->newpassword = '';
                            $mUser->password_confirm = '';
                        }
                    }
                }
            }

            $this->render('myprofile',
                array('model'=>$mUser)
            );

        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }
    
    
    /**
     * @Author: ANH DUNG  Jan 23, 2015
     * @Todo: validate link user type for create new transaction
     */
    public function validateLinkView($transactions_id){
        $valid = true;
        // 3. check transaction id
        $mTransactions = ProTransactions::getByPk($transactions_id);
        if(is_null($mTransactions) || ( $mTransactions && Yii::app()->user->id!=$mTransactions->user_id) )
            $valid=false;
        
        if(!$valid){
//            throw new CHttpException(404, 'Invalid Request');
            $this->redirect(Yii::app()->createAbsoluteUrl('member/member_profile/myprofile'));
        }
        return $mTransactions;
    }
    
    /**
     * @Author: ANH DUNG Jan 23, 2015
     * @Todo: View tenancy
     * @Param: $tenancy: id transaction - transaction_id
     */    
    public function actionView($tenancy){
        MyFormat::validateUserAccess(ROLE_AGENT);
        $this->pageTitle = "View Tenancy - ".Yii::app()->params['title'];
        try {
            $mTransactions = $this->validateLinkView($tenancy);
            if($mTransactions->status == STATUS_TENANCY_DRAFT){
                $this->redirect(Yii::app()->createAbsoluteUrl('member/agent/tenancy'));
            }
            
            $type = $mTransactions->type;
            $mTransactions->mBillTo = $mTransactions->rBillTo?$mTransactions->rBillTo:( new ProTransactionsBillTo());
//            $mTransactions->mInternalCoBroke = $mTransactions->rInternalCoBroke?$mTransactions->rInternalCoBroke:( array() );
            $mTransactions->mPropertyDetail = $mTransactions->rPropertyDetail?$mTransactions->rPropertyDetail:( new ProTransactionsPropertyDetail() );
            $mTransactions->aModelPropertyDocument = count($mTransactions->rPropertyDocument)?$mTransactions->rPropertyDocument:( ProTransactionsPropertyDocument::getDefaultArrayForCreate($type) );            
//            $mTransactions->mVendorPurchaserDetail = $mTransactions->rVendorPurchaserDetail?$mTransactions->rVendorPurchaserDetail:( array() );
            
//            $mTransactions->mPropertyDetail->scenario = 'CreateTransaction';
//            $mTransactions->mBillTo->scenario = 'CreateVendorPurchaser';
//            $mTransactions->scenario = 'CreateTransaction'; // default for sale
//            ProTransactions::convertToUserDate($mTransactions);
            
            $this->render('ViewTransaction/ViewTransaction',array(
                'mTransactions'=>$mTransactions,
            ));
            
        } catch (Exception $exc) {
            throw new CHttpException(404,'The requested page does not exist.');
        }
    }
    
    /**
     * @Author: ANH DUNG Feb 11, 2015
     * @Todo: delete tenancy
     * @Param: $id
     */
    public function actionDelete_tenancy($id)
    {
        try
        {
        if(Yii::app()->request->isPostRequest)
        {
            // we only allow deletion via POST request
            $model = MyFormat::loadModelByClass($id,'ProTransactions');
            if($model && ProTransactions::CanDeleteTenancy($model))
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
    //HTram
    public function actionCallsLog($transaction_id){
        $this->pageTitle = "CallsLog - ".Yii::app()->params['title'];
        $this->layout = "application.views.layouts.layout_callslog";
        try{
            $model=new ProCallLog();
            $model->unsetAttributes();  // clear any default values
            if(isset($_GET['ProCallLog']))
                    $model->attributes=$_GET['ProCallLog'];
            $model->transaction_id = $transaction_id;
            
            $this->render('callslog/list',array(
                'model'=>$model,
            ));
            
        } catch (Exception $ex) {
            Yii::log("Exception ".  print_r($e, true), 'error');
            throw new CHttpException(400,$e->getMessage());
        }
    }
    //HTram August 28,2015
    public function actionReportDefect($transaction_id){
        $this->pageTitle = "Report Defects - ".Yii::app()->params['title'];
        $this->layout = "application.views.layouts.layout_callslog";
        try{
            $model=new ProReportDefect();
            $model->unsetAttributes();  // clear any default values
            if(isset($_GET['ProReportDefect']))
                    $model->attributes=$_GET['ProReportDefect'];
            $model->transaction_id = $transaction_id;
            
            $this->render('report/list',array(
                    'model'=>$model, 'actions' => $this->listActionsCanAccess,
            ));
        }
        catch (Exception $e)
        {
            Yii::log("Exception ".  print_r($e, true), 'error');
            throw  new CHttpException("Exception ".  print_r($e, true));     
        }
    }
    //HTram August 28,2015
    public function actionInventoryPhoto($transaction_id){
        $this->pageTitle = "Inventory Photo - ".Yii::app()->params['title'];
        $this->layout = "application.views.layouts.layout_callslog";
        try{
            $model = new ProInventoryPhoto();
            $model->transaction_id = $transaction_id;
            $aModelPhoto = ProInventoryPhoto::GetByUidAndTransactionId(0, $transaction_id);
            $this->render('inventoryphoto/list',array(
                'model'=>$model,
                'aModelPhoto'=>$aModelPhoto,
                'actions' => $this->listActionsCanAccess,
            ));
        }
        catch (Exception $e)
        {
            Yii::log("Exception ".  print_r($e, true), 'error');
            throw  new CHttpException("Exception ".  print_r($e, true));     
        }
    }
    //HTram August 28,2015
    public function actionAirconServices($transaction_id){
        $this->pageTitle = "Aircon Services - ".Yii::app()->params['title'];
        $this->layout = "application.views.layouts.layout_callslog";
        try{
            $model=new ProAirconService();
            $model->unsetAttributes();  // clear any default values
            if(isset($_GET['ProAirconService']))
                    $model->attributes=$_GET['ProAirconService'];
            $model->transaction_id = $transaction_id;
           
            $this->render('airconservices/list',array(
                    'model'=>$model, 'actions' => $this->listActionsCanAccess,
            ));
        }
        catch (Exception $e)
        {
            Yii::log("Exception ".  print_r($e, true), 'error');
            throw  new CHttpException("Exception ".  print_r($e, true));     
        }
    }

}


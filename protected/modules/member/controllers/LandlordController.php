
<?php
/**
 * Class LandlordController
 * <Created by Jason>
 */

class LandlordController extends MemberController{

    protected function beforeAction($event)
    {
        $role = Yii::app()->user->role_id;
        if ($role != ROLE_LANDLORD) {
            switch($role){
                case ROLE_REGISTER_MEMBER:
                    $this->redirect(Yii::app()->createAbsoluteUrl('member/member_profile/myprofile'));
                    break;
                case ROLE_TENANT:
                    $this->redirect(Yii::app()->createAbsoluteUrl('member/tenant/property'));
                    break;
                case ROLE_AGENT:
                    $this->redirect(Yii::app()->createAbsoluteUrl('member/dashboard'));
                    break;
            }
        }
        return parent::beforeAction($event);
    }
    
    
    
    public function actionMyprofile(){
        try {
            if(Yii::app()->user->role_id == ROLE_AGENT){
                $this->redirect(Yii::app()->createAbsoluteUrl('member/agent/myprofile'));
            }
            
            $this->pageTitle = 'My Profile - '.Yii::app()->params['title'];           
            $this->layout = 'application.views.layouts.layout_user';
            $mUser = Users::model()->findByPk(Yii::app()->user->id);            
            $mUser->scenario = 'myprofile_admin';

            if(isset($_POST['Users']))
            {
                $mUser->attributes=$_POST['Users'];
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
                        if($mUser->save('nric_passportno_roc', 'email_not_login', 'first_name', 'password_hash', 'temp_password', 'contact_no', 'id_type', 'address')){
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
    
    public function actionDeleteEngage(){

        try {
            if (isset($_GET['engage_id'])) {
                $engage = ProEngageUs::model()->findByPk($_GET['engage_id']);
                if($engage){
                    $engage->delete();
                }
            }
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    public function actionProperty() {
        try {
            $this->pageTitle = 'List of Tenancy - '.Yii::app()->params['title'];
            $this->layout = 'application.views.layouts.layout_user';

            if (!isset(Yii::app()->user->id)) {
                $this->redirect(Yii::app()->createAbsoluteUrl('/'));
            }
            $model = ProTransactions::getListTenanciesLandlord();
            $engage = ProEngageUs::getListEngage();

            $this->render('property', array('model' => $model, 'engage'=>$engage));
        } catch (Exception $exc) {
            throw new CHttpException('404', $exc->getMessage());
        }
    }

    public function actionTenancies_Detail() {
        try {
            $this->pageTitle = 'Tenancy Details - '.Yii::app()->params['title'];
            $this->layout = 'application.views.layouts.layout_user';

            if (!isset(Yii::app()->user->id)) {
                $this->redirect(Yii::app()->createAbsoluteUrl('/'));
            }
            if(!isset($_GET['transaction_id']))
                $_GET['transaction_id'] = 0;
            //HTram add
            $role_id = '';
            if(isset(Yii::app()->user->id)){
                $role_id = Yii::app()->user->roleid;
            }
            $calllog = ProCallLog::getListCallLog($_GET['transaction_id'],$role_id);
            //
            $document = ProTransactionsPropertyDocument::getListDocument($_GET['transaction_id']);
            $transaction = ProTransactions::getByPk($_GET['transaction_id']);
            $tenantInformation = ProTransactionsVendorPurchaserDetail::getTenancyInformation($_GET['transaction_id'], TYPE_TENANT);
            $report = ProReportDefect::getListReport($_GET['transaction_id']);
            $mAirconService = new ProAirconService();
            $mAirconService->transaction_id = $_GET['transaction_id'];
            MyFormat::CheckValidRequest($transaction);
            
            $this->render('tenancies_detail', array(
                'transaction' => $transaction, 
                'document'=>$document, 
                'calllog'=>$calllog,
                'tenantInformation'=>$tenantInformation,
                'report'=>$report,
                'mAirconService'=>$mAirconService,
            ));

        } catch (Exception $exc) {
            throw new CHttpException('404', $exc->getMessage());
        }
    }

    public function ajaxValidateRegister($model){
        echo CActiveForm::validate($model);
        Yii::app()->end();
    }

    public function getPropertyDetail($tran_id){
        $trans = ProTransactions::model()->findByPk($tran_id);
        if($trans){
            return '<a href="'.Yii::app()->createAbsoluteUrl('site/listingdetail', array('slug'=>$trans->listing->slug)).'" >'.$trans->listing->property_name_or_address.'</a>';
        }        
    }
    public function sendMailToAdmin($engage){
        try {
            $mUser = Users::model()->findByPk(Yii::app()->user->id);
            $aBody = array(
                '{PROPERTY_NAME}'=>$this->getPropertyDetail($engage->transaction_id),
                '{NAME}'=>$mUser->title. ' '.$mUser->first_name.' '.$mUser->last_name,
                '{REMARK}'=>$engage->remark,
                '{PRICE}'=> $engage->price,
                '{NRIC}'=> $mUser->nric_passportno_roc,
            );

            CmsEmail::sendmail(MAIL_LANDLORD_SEND_ENGAGE_US, $aBody, $aBody, Yii::app()->params['adminEmail']);
            
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
    
    public function actionEngageus() {
        try {
            $this->pageTitle = 'Engage - '.Yii::app()->params['title'];
            $this->layout = 'application.views.layouts.ajax';

            $model = new ProEngageUs('engage');

            if(isset($_POST['ProEngageUs']))
            {
                $model->attributes=$_POST['ProEngageUs'];
                $model->transaction_id = $_GET['transaction_id'];
                $model->listing_id = $_GET['listing_id'];

                if($model->validate()){
                    if(!$model->getErrors()){
                        $model->list_on = date('Y-m-d H:i:s');
                        $model->user_id = Yii::app()->user->id;

                        if($model->save('user_id', 'price', 'remark', 'list_on', 'transaction_id', 'listing_id')){
                            $this->sendMailToAdmin($model);
                            Yii::app()->user->setFlash('success', "Your Engage has been sended!");
                            $model->price = '';
                            $model->remark = '';
                            $model->termandcondition = 0;
                            if(isset($_GET['tenancies_detail'])){
                                die('<script type="text/javascript">parent.location.reload();</script>');
                            }else{
                                die('<script type="text/javascript">parent.$.fancybox.close(); parent.fnUpdateGridView("#list-engage-grid");   </script>');
                            }
                        }
                    }
                }
            }

            $this->render('engageus', array('model'=>$model));
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }
    
    
    public function actionRequestBankEvaluation() {
        try {

            $this->pageTitle = 'Request Bank Evaluation - '.Yii::app()->params['title'];
            $this->layout = 'application.views.layouts.ajax_width_auto';

            $model = new BankRequest('blank_valuation_request');
            $model->transaction_id = $_GET['transaction_id'];
            $this->OverideModel($model);

            if(isset($_POST['BankRequest']))
            {
                $model->attributes=$_POST['BankRequest'];
                $model->choosetype = isset($_POST['choosetype'])?$_POST['choosetype']:0;
                $model->property_type_code = isset($_POST['property_type_code'])?is_array($_POST['property_type_code'])?implode(',', $_POST['property_type_code']):"":'';
                
                $model->validate();
                if(!$model->hasErrors()){
                    $model->tenancy_expiry_datepicker = MyFormat::indexDateToDbDate($model->tenancy_expiry_datepicker);
                    if($model->save()){
                        //email to Admin
                        SendEmail::sendMailBankRequestToAdmin($model);
                        die('<script type="text/javascript">parent.$.fancybox.close();</script>');
//                        die('<script type="text/javascript">parent.$.fancybox.close(); parent.fnUpdateGridView("#list-tenancy-grid");</script>');
                    }
                }                
            }

            $this->render('RequestBankEvaluation', array('model'=>$model));
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }
    
    public function OverideModel($model){
        if(isset(Yii::app()->user->id)){
            $cmsFormater = new CmsFormatter();
            $mUser = Users::model()->findByPk(Yii::app()->user->id);
            $model->fullname = $cmsFormater->formatFullNameRegisteredUsers($mUser);
            $model->nric = $mUser->nric_passportno_roc;
            $model->contact_no = $mUser->phone;
            $model->email = $mUser->email;
            if(Yii::app()->user->role_id==ROLE_LANDLORD || Yii::app()->user->role_id==ROLE_TENANT){
                $model->contact_no = $mUser->contact_no;
                $model->email = $mUser->email_not_login;
            }
            if(Yii::app()->user->role_id==ROLE_AGENT){
                $model->email = $mUser->email_not_login;
            }
        }
        
        $mTrans = ProTransactions::model()->findByPk($model->transaction_id);
        if(is_null($mTrans)) return;
        $mListing = Listing::model()->findByPk($mTrans->listing_id);
        if(is_null($mListing)) return;
        $model->property_name_or_address = $mListing->property_name_or_address;
        $model->unit_from = $mListing->unit_from;
        $model->unit_to = $mListing->unit_to;
        $model->postal_code = $mListing->postal_code;
        $model->location_id = $mListing->location_id;
        $model->property_type_id = $mListing->property_type_1;
        $model->tenure = $mListing->tenure;
        $model->floor_area = $mListing->floor_area;
        $model->of_bedroom_from = $mListing->of_bedroom;        
        $model->of_bathrooms_from = $mListing->of_bathrooms;        
    }
    

    public function actionUpdateEngage() {
        try {

            $this->pageTitle = 'Update Engage - '.Yii::app()->params['title'];
            $this->layout = 'application.views.layouts.ajax';

            $model = ProEngageUs::model()->findByPk($_GET['engage_id']);
            $model->scenario = 'engage';

            if(isset($_POST['ProEngageUs']))
            {
                $model->attributes=$_POST['ProEngageUs'];

                if($model->validate()){
                    if(!$model->getErrors()){

                        if($model->save('price', 'remark')){
                            Yii::app()->user->setFlash('success', "Your Engage has been sended!");
                            $model->price = '';
                            $model->remark = '';
                            $model->termandcondition = 0;

                            die('<script type="text/javascript">parent.$.fancybox.close(); parent.fnUpdateGridView("#list-engage-grid");   </script>');
                        }
                    }
                }
            }

            $this->render('engageus', array('model'=>$model));
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }
    
 /**
     * <Jason>
     * <To upload document>
     */
    public function actionUploadFile() {
        try {

            $this->pageTitle = 'Upload Document - '.Yii::app()->params['title'];
            $this->layout = 'application.views.layouts.ajax';

            $model = new ProTransactionsPropertyDocument('upload');

            if(isset($_POST['ProTransactionsPropertyDocument']))
            {
                $model->attributes=$_POST['ProTransactionsPropertyDocument'];
                $model->transactions_id = $_GET['transaction_id'];
                $model->user_id = Yii::app()->user->id;
                $model->file_name  = CUploadedFile::getInstance($model,'file_name');

                if($model->validate()){
                    if(!$model->getErrors()){
                        if($model->save()){
                            if(!is_null($model->file_name)){
                                $model->file_name = ProTransactionsPropertyDocument::saveFile($model, 'file_name', ProTransactionsPropertyDocument::$folderUpload, $model->order_no) ;
                                $model->update(array('file_name'));
                            }

                            Yii::app()->user->setFlash('success', "Your report defect has been insert successfully!");
                            $model->title = '';
//
                            die('<script type="text/javascript">parent.$.fancybox.close(); parent.fnUpdateGridView("#document-grid");   </script>');
                        }
                    }
                }
            }

            $this->render('upload', array('model'=>$model));
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }
    
    public function actionUpdateDefectStatus($id)
    {
        try{            
            $model =ProReportDefect::model()->findByPk($id);
            if(is_null($model))
            {
                throw new Exception('id not valid');
            }
            $model->scenario = 'UpdateDefectStatus';
            $this->layout = 'application.views.layouts.ajax';
            $cmsFormater = new CmsFormatter();
            $model->approved_date = $cmsFormater->formatDatePickerInput($model->approved_date);
            if(isset($_POST['ProReportDefect']))
            {
                $attUpdate = array('status');
                $model->attributes=$_POST['ProReportDefect'];
                if($model->status == CmsFormatter::COMPLETE_REPORT){
                    $model->approved_by_complete = Yii::app()->user->id;
                    $model->scenario = 'UpdateDefectStatusComplete';
                    $attUpdate[] = 'approved_by_complete';
                    $attUpdate[] = 'approved_date';
                    $attUpdate[] = 'remark';
                }elseif($model->status == CmsFormatter::PROGESS_REPORT){
                    $model->approved_by_progess = Yii::app()->user->id;
                    $attUpdate[] = 'approved_by_progess';
                }
                $model->validate();
                if(!$model->hasErrors()){
                    $model->update($attUpdate);
                    die('<script type="text/javascript">parent.$.fancybox.close(); parent.fnUpdateGridView("#defect-grid");</script>');
                }
            }            
            $this->render('UpdateDefectStatus',array(
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


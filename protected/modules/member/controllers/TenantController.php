<?php

class TenantController extends MemberController{

    protected function beforeAction($event)
    {
        $role = Yii::app()->user->role_id;
        $aActionNotCheck = array('delete');
        $cAction = Yii::app()->controller->action->id;
        if ($role != ROLE_TENANT && !in_array($cAction, $aActionNotCheck)) {
            switch($role){
                case ROLE_REGISTER_MEMBER:
                    $this->redirect(Yii::app()->createAbsoluteUrl('member/member_profile/myprofile'));
                    break;
                case ROLE_LANDLORD:
                    $this->redirect(Yii::app()->createAbsoluteUrl('member/landlord/property'));
                    break;
                case ROLE_AGENT:
                    $this->redirect(Yii::app()->createAbsoluteUrl('member/dashboard'));
                    break;
            }
        }
        return parent::beforeAction($event);
    }
    
    /**
     * <Create By HThoa>
     * <Edit By Jason>
     * Sep 05, 2014 ANH DUNG edit
     * use at propertyfinal/member/tenant/property
     * <TO show list of tenancies in tenant user>
     */
    public function actionProperty() {
        try {
            $this->pageTitle = 'List of Tenancies - '.Yii::app()->params['title'];
            $this->layout = 'application.views.layouts.layout_user';

            if (!isset(Yii::app()->user->id)) {
                $this->redirect(Yii::app()->createAbsoluteUrl('/'));
            }
            $model = ProTransactions::getListTenancies();

            $this->render('property', array('model' => $model));

        } catch (Exception $exc) {
            throw new CHttpException('404', $exc->getMessage());
        }
    }

    /**
     * <Create By Jason>
     * <TO show list of tenancies detail in tenant user>
     */

    public function actionTenancies_Detail() {
        try {
            $this->pageTitle = 'Tenancies Details - '.Yii::app()->params['title'];
            $this->layout = 'application.views.layouts.layout_user';

            if (!isset(Yii::app()->user->id)) {
                $this->redirect(Yii::app()->createAbsoluteUrl('/'));
            }
            if(!isset($_GET['transaction_id']))
                $_GET['transaction_id'] = 0;
            //HTram add: to load call log by role users
            $role_id = '';
            if(isset(Yii::app()->user->id)){
                $role_id = Yii::app()->user->roleid;
            }
            $calllog = ProCallLog::getListCallLog($_GET['transaction_id'],$role_id);
            //
            $document = ProTransactionsPropertyDocument::getListDocument($_GET['transaction_id']);
            $transaction = ProTransactions::getByPk($_GET['transaction_id']);
            $report = ProReportDefect::getListReport($_GET['transaction_id']);
            $landlordInformation = ProTransactionsVendorPurchaserDetail::getTenancyInformation($_GET['transaction_id'], TYPE_LANDLORD);
            $mAirconService = new ProAirconService();
            $mAirconService->transaction_id = $_GET['transaction_id'];
            MyFormat::CheckValidRequest($transaction);
            
            $this->render('tenancies_detail', array(
                'report'=>$report, 
                'transaction' => $transaction, 
                'document'=>$document, 
                'calllog'=>$calllog,
                'landlordInformation'=>$landlordInformation,
                'mAirconService'=>$mAirconService,
            ));

        } catch (Exception $exc) {
            throw new CHttpException('404', $exc->getMessage());
        }
    }

    public function actionDelete() {
        try {
            if (isset($_GET['report_id'])) {
                $report = ProReportDefect::model()->findByPk($_GET['report_id']);
                if($report && $report->user_id == Yii::app()->user->id){
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
            throw new CHttpException('404', $exc->getMessage());
        }
    }

    /**
     * <Jason>
     * <My profile of user, who created by admin>
     */
    public function actionMyprofile(){
        try {
            if(Yii::app()->user->role_id == ROLE_AGENT){
                $this->redirect(Yii::app()->createAbsoluteUrl('member/agent/myprofile'));
            }
            $this->pageTitle = 'My Profile - '.Yii::app()->params['title'];

            $this->layout = 'application.views.layouts.layout_user';
            $mUser = Users::model()->findByPk(Yii::app()->user->id);
            $old_upload_employment_pass_passport = $mUser->upload_employment_pass_passport;
            $old_scanned_passport = $mUser->scanned_passport;
            $mUser->scenario = 'myprofile_tenant';

            if(isset($_POST['Users']))
            {
                $mUser->attributes=$_POST['Users'];
                $mUser->upload_employment_pass_passport = CUploadedFile::getInstance($mUser, 'upload_employment_pass_passport');
                $mUser->scanned_passport = CUploadedFile::getInstance($mUser, 'scanned_passport');
                $mUser->pass_expiry_date = DateHelper::toDbDateFormat($mUser->pass_expiry_date);

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
                        //upload_employment_pass_passport
                        if (!is_null($mUser->upload_employment_pass_passport)) {
                            Users::save_upload_employment_pass_passport($mUser);                            
                        }
                        else{
                            if (isset($_POST['delete_current_file']) && $_POST['delete_current_file'] == 'on') {
                                $path = Users::$folderUpload;
                                Users::deleteOldFile($mUser, 'upload_employment_pass_passport', $path);
                                $mUser->upload_employment_pass_passport = NULL;
                                $mUser->update(array('upload_employment_pass_passport'));
                            }
                            else{
                                $mUser->upload_employment_pass_passport = $old_upload_employment_pass_passport;
                            }                            
                        }
                        
                        //scanned_passport
                        if (!is_null($mUser->scanned_passport)) {
                            Users::save_scanned_passport($mUser);                            
                        }
                        else{
                            if (isset($_POST['delete_scanned_passport']) && $_POST['delete_scanned_passport'] == 'on') {
                                $path = Users::$folderUpload;
                                Users::deleteOldFile($mUser, 'scanned_passport', $path);
                                $mUser->scanned_passport = NULL;
                                $mUser->update(array('scanned_passport'));
                            }
                            else{
                                $mUser->scanned_passport = $old_scanned_passport;
                            }                            
                        }
                        
                        if($mUser->save('pass_expiry_date, nric_passportno_roc', 'email_not_login', 'first_name', 'password_hash', 'temp_password', 'contact_no', 'id_type', 'address')){
                            Yii::app()->user->setFlash('success', "My Profile has changed!");
                            $mUser->newpassword = '';
                            $mUser->password_confirm = '';
                        }
                    }
                }
                else{
                    $mUser->scanned_passport = $old_scanned_passport;
                    $mUser->upload_employment_pass_passport = $old_upload_employment_pass_passport;
                }
            }

            $this->render('myprofile',
                array('model'=>$mUser)
            );

        } catch (Exception $exc) {
            throw new CHttpException('404', $exc->getMessage());
        }
    }

}


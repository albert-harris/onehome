<?php

class MemberModule extends CWebModule {

    public $defaultController = 'site';
    public $layout='application.views.layouts.layout_member';
   
    public function init() {
        // this method is called when the module is being created
        // you may place code here to customize the module or the application
        // import the module-level models and components
        $this->setImport(array(
            'member.models.*',
            'member.components.*',
        ));

        $this->setComponents(array(
            'user' => array(
                'class' => 'WebUser',
                'loginUrl' => Yii::app()->createUrl('member/site/login/'),
            ),
        ));
    }

    public function beforeControllerAction($controller, $action) {
        
        //dtoan login tam
//        Yii::app()->user->id=100000;
//        return parent::beforeControllerAction($controller, $action);

        if (parent::beforeControllerAction($controller, $action)) {
            // this method is called before any module controller action is performed
            // you may place customized code here
            Yii::app()->errorHandler->errorAction = 'site/error';

            // set pageTitle
            $act = explode('_', strtolower($action->id));
            $controller->pageTitle = '' . implode(' ', $act);

            $route = $controller->id . '/' . $action->id;
            // echo $route;
            $publicPages = array(
//                'users/profile',
//                'users/account_doctor',
//                'users/edit_profile',
//                'users/doctor_profile',
//                'users/DoctorShowAppointment',
//                'users/DoctorChangeAppointmentStatus',
//                'users/DoctorAddAppointment',
//                'site/cancel_appointment',
//                'site/error',
//                'site/forgot_password',
//                'site/change_password',
//		'site/register_confirm_code',
//                'site/captcha'
            );

            if (!isset(Yii::app()->user->id)) {

                if (isset($_COOKIE[VERZ_COOKIE_MEMBER])) {
                    $data = json_decode($_COOKIE[VERZ_COOKIE_MEMBER], true);
                    $model = new LoginForm();
                    $model->scenario = 'login_admin';

                    $model->email = $data[VERZLOGIN_MEMBER];
                    $model->password = $data[VERZLPASS_MEMBER];

                    if ($model->validate()) {

                        if (strpos(Yii::app()->user->returnUrl, '/index.php') === false)
                            Yii::app()->controller->redirect(Yii::app()->user->returnUrl);
                        switch (Yii::app()->user->role_id) {
                            case ROLE_REGISTER_MEMBER:
                                $this->redirect(Yii::app()->createAbsoluteUrl('member/member_profile/myprofile'));
                                break;
                            case ROLE_TENANT:
                                $this->redirect(Yii::app()->createAbsoluteUrl('member/member_profile/myprofileadmin'));
                                break;
                            case ROLE_AGENT:
                                $this->redirect(Yii::app()->createAbsoluteUrl('member/member_profile/myprofileadmin'));
                                break;
                            case ROLE_LANDLORD:
                                $this->redirect(Yii::app()->createAbsoluteUrl('member/member_profile/myprofileadmin'));
                                break;
                            case ROLE_ADMIN:
                                $this->redirect(Yii::app()->createAbsoluteUrl('admin'));
                                break;
                            default :$this->redirect(Yii::app()->createAbsoluteUrl('/'));
                        }
                    }
                }
            }

            if (!isset(Yii::app()->user->id))
                Yii::app()->user->loginRequired();
            if (isset(Yii::app()->user->id)) {
                $mUser = Users::model()->findByPk(Yii::app()->user->id);
//                if (is_null($mUser) || $mUser->status == STATUS_INACTIVE || $mUser->role_id == ROLE_REGISTER_MEMBER) {
                if (is_null($mUser) || $mUser->status == STATUS_INACTIVE) {
                    Yii::app()->user->logout();
                    Yii::app()->controller->redirect(Yii::app()->createAbsoluteUrl('site/login'));
                }
            }
            if (in_array($route, $publicPages))
                if (!isset(Yii::app()->user->id))
                    Yii::app()->user->loginRequired();
            //die;
            /* if (!Yii::app()->user->isMember && !in_array($route, $publicPages)){
              //Yii::app()->getModule('member')->user->loginRequired();

              }
              else */
            return true;
        }
        else
            return false;
    }

}

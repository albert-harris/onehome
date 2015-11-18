<?php
/**
 * DTOAN
 * DashboardController
 * Manager listing for user Agent
 * Date 21-03-2014
 */

class DashboardController extends MemberController {
    
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
    
    public function actionIndex() {
        $this->pageTitle =  'Dashboard - '.Yii::app()->params['title'];
        $this->render('index');
    }
}
?>
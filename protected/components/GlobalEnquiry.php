<?php

/**
 * User: Kvan
 * Date: 4/3/14
 * Time: 2:32 PM
 * To change this template use File | Settings | File Templates.
 */
class GlobalEnquiry extends CWidget {

    public function run() {
        $model = new ProGlobalEnquiry('create');

        $model->country_id = ActiveRecord::getDefaultAreaCode();
        if (isset(Yii::app()->user->id)) {
            $model->name = Yii::app()->user->title . ' ' . Yii::app()->user->first_name . ' ' . Yii::app()->user->last_name;
            $model->email = Yii::app()->user->email;
            if (Yii::app()->user->role_id != ROLE_REGISTER_MEMBER) {
                $model->email = Yii::app()->user->email_not_login;
            }
            $model->phone = Yii::app()->user->phone;
            $model->country_id = Yii::app()->user->country;
        }
        
        if(isset(Yii::app()->user->id)){
            $cmsFormater = new CmsFormatter();
            $mUser = Users::model()->findByPk(Yii::app()->user->id);
            $model->name = $cmsFormater->formatFullNameRegisteredUsers($mUser);
            $model->email = $mUser->email;
            $model->nric = $mUser->nric_passportno_roc;
            $model->phone = $mUser->phone;
            if(Yii::app()->user->role_id==ROLE_LANDLORD || Yii::app()->user->role_id==ROLE_TENANT){
                $model->phone = $mUser->contact_no;
                $model->email = $mUser->email_not_login;
            }
            if(Yii::app()->user->role_id==ROLE_AGENT){
                $model->email = $mUser->email_not_login;
            }
        }        
//        $model->type_selling= 'Tenancy';
        $box = Pages::getPageById(PAGE_ENGAGE_US_BOX);
        $this->render("global_enquiry", array(
            'model' => $model,
            'box' => $box
        ));
    }

}

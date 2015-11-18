<?php 
class BlankvaluationRequestWidget extends CWidget
{
    public function run()
    {
        $this->getContent();
    }
    public function getContent()
    {
        $model = new BankRequest('blank_valuation_request');
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
//        $model->type_selling = 'Tenancy';
        
        $this->render("blank_valuation_request",array(
            'model'=>$model
        ));
    }
    
}
?>
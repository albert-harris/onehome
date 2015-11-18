<?php
Yii::import('zii.widgets.CPortlet');
class LoginFormWid extends CPortlet
{
    private $_assetsUrl;

    //public $fullname;

    public function init()
    {
        parent::init();
        //$this->fullname = 'x';
    }

    public function renderContent()
    {
        if(Yii::app()->user->isMember){
            $this->render('bank');
        }else{
            $model=new LoginForm;

            // collect user input data
            if(isset($_POST['LoginForm']))
            {
                $model->attributes=$_POST['LoginForm'];
                // validate user input and redirect to the previous page if valid
                //if($model->validate() && $model->login())
                if($model->validate())
                {

                    switch (Yii::app()->user->role_id){
                        case ROLE_MEMBER:
                            Yii::app()->controller->redirect(Yii::app()->createAbsoluteUrl('member'));
                            break;
                        case ROLE_ADMIN:
                            Yii::app()->controller->redirect(Yii::app()->createAbsoluteUrl('admin/login'));
                            break;

                        default : Yii::app()->controller->redirect(Yii::app()->createAbsoluteUrl('member'));
                    }
                    Yii::app()->end();
                }
            }
            // display the login form
            $this->render('form',array('model'=>$model));
        }

    }



    public function getAssetsUrl()
    {
        if ($this->_assetsUrl === null)
            $this->_assetsUrl = Yii::app()->getAssetManager()->publish(
                Yii::getPathOfAlias('ext.loginFormWid.assets'), true, -1, true );
        return $this->_assetsUrl;
    }
}
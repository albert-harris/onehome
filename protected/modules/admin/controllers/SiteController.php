<?php

class SiteController extends AdminController
{
    public function accessRules()
    {
        return array(
            array('allow',  // allow all users to perform  actions
                'actions'=>array('ForgotPassword', 'ResetPassword', 'Login', 'Logout', 'Error'),
                'users'=>array('*'),
            ),  
            array('allow',   //allow authenticated user to perform actions
                'actions'=>array('index', 'Update_my_profile', 'Change_my_password'),
                'users'=>array('@'),
            ),
            array('deny',  // deny all users
                    'users'=>array('*'),
            ),            
                      
        );
    }

    public function actionForgotPassword()
    {
        $model=new ForgotPasswordForm;
        if(isset($_POST['ForgotPasswordForm']))
        {
            $model->attributes=$_POST['ForgotPasswordForm'];
            if($model->validate()) 
            {
                //check Email
                $user = Users::model()->findByAttributes(array(
                    'email' => trim($model->email), 'application_id' => BE,
                ));
                if(!$user){
                    $model->addError('email','Email does not exist.');
                } else {
                    $name = $user->first_name.' '.$user->last_name;
                    $key = ForgotPasswordForm::generateKey($user);
                    $forgot_link = '<a href="'.Yii::app()->createAbsoluteUrl('/admin/site/ResetPassword',array('id'=>$user->id, 'key'=>$key)).'">'.Yii::app()->createAbsoluteUrl('/admin/site/ResetPassword',array('id'=>$user->id, 'key'=>$key)).'</a>';
                    
                    $aBody = array(
                        '{NAME}'=>$name,
                        '{USERNAME}'=>$user->username,
                        '{EMAIL}'=>$user->email,
                        '{LINK}' =>$forgot_link,
                    );                        
                    //public static function sendmail($iEmailTemplateID, $aSubject, $aBody, $sTo)
                    if(CmsEmail::sendmail(1,array(),$aBody, $user->email))
                        Yii::app()->user->setFlash("success", "An email has sent to: $model->email. Please check email to verify this action.");
                    else 
                        $model->addError('email','Can not send email.');
                }                                

            }
        }
		$this->render('forgotPassword',array('model'=>$model));
    }
	
    public function actionResetPassword()
    {
        $id = Yii::app()->request->getParam('id'); 
        $key = Yii::app()->request->getParam('key'); 
        $model = Users::model()->findByPk((int)$id);
        
        if($model !== null && $key == ForgotPasswordForm::generateKey($model))
        {
            $pass = ActiveRecord::randString(6);
            $model->password_hash = md5($pass);
            $model->temp_password = $pass;
            $model->update();
            $name = $model->first_name.' '.$model->last_name;
            $login_link = '<a href="'.Yii::app()->createAbsoluteUrl("admin/site/login").'">'.Yii::app()->createAbsoluteUrl("admin/site/login").'</a>';
            $aBody = array(
                '{NAME}'=>$name,
//                '{USERNAME}'=>$model->username,
                '{PASSWORD}'=>$model->temp_password,
                '{LINK_LOGIN}' =>$login_link,
            );    
            
            if(CmsEmail::sendmail(2,array(),$aBody, $model->email))
                Yii::app()->user->setFlash("success", "An email has sent to: $model->email. Please check email to get new password.");
            else 
                $model->addError('email','Can not send email to: '.$model->email);
        }
        else
        {
            Yii::log('Invalid request. Please do not repeat this request again.');
            throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
        }
        $this->render('ResetPassword',array('model'=>$model));
        
    }    

	public function actionError()
	{
        if($error=Yii::app()->errorHandler->error)
        {
            if(Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
	}

	public function actionIndex()
	{
		$this->render('index');
	}

    /**
     * Displays the login page
     */
    public function actionLogin()
    {    

        $model=new AdminLoginForm;
        if(isset($_POST['AdminLoginForm']))
	    {
            //var_dump($_POST['LoginForm']);die;
            $model->attributes=$_POST['AdminLoginForm'];
            if($model->validate()){
                /* Change at yii 1.1.13:
                 * we not use: if (strpos(Yii::app()->user->returnUrl,'/index.php')===false) to check returnUrl
                 */    
                if (strtolower(Yii::app()->user->returnUrl)!==strtolower(Yii::app()->baseUrl.'/'))
                    $this->redirect(Yii::app()->user->returnUrl);
                
                switch (Yii::app()->user->role_id){
                    case ROLE_MANAGER:
                        $this->redirect(Yii::app()->createAbsoluteUrl('admin'));
                    break;
                    case ROLE_ADMIN:
                        $this->redirect(Yii::app()->createAbsoluteUrl('admin'));
                    break;

                    default :$this->redirect(Yii::app()->createAbsoluteUrl('admin'));
                }
            }
        }
        $this->render('login', array('model'=>$model));
    }
    
    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout()
    {
        Yii::app()->user->logout();
         //xoa cookie
        if(isset($_COOKIE[VERZ_COOKIE_ADMIN])){
            setcookie(VERZ_COOKIE_ADMIN, '', 1);
            setcookie(VERZ_COOKIE_ADMIN, '', 1, '/');
        }        
        
        $this->redirect(Yii::app()->createAbsoluteUrl('admin/login/'));
    }
    
    public function actionUpdate_my_profile()
    {
        if(Yii::app()->user->id == '')
         $this->redirect(array('login'));
            $model = MyFormat::loadModelByClass(Yii::app()->user->id,'Users');
            $model->scenario = 'updateAdminProfile';
            //$model->md5pass = $model->password_hash;

            if(isset($_POST['Users']))
            {
                $model->attributes=$_POST['Users'];
                if($model->validate())
                {
                    if($model->save()) {
                        Yii::app()->user->setFlash('successUpdateMyProfile', "Your profile information has been successfully updated.");
                        $this->redirect(array('update_my_profile'));
                    }
                }
            }

            $this->render('update_my_profile',array(
                    'model'=>$model,
            ));
    }

    public function actionChange_my_password()
    {
        if(Yii::app()->user->id == '')
         $this->redirect(array('login'));
            $model = MyFormat::loadModelByClass(Yii::app()->user->id,'Users');
            $model->scenario = 'changeMyPassword';
            $model->md5pass = $model->password_hash;

            if(isset($_POST['Users']))
            {
                $model->currentpassword=$_POST['Users']['currentpassword'];
                $model->newpassword=$_POST['Users']['newpassword'];
                $model->password_confirm=$_POST['Users']['password_confirm'];
                if($model->validate())
                {
                    $model->newpassword = $_POST['Users']['newpassword'];
                    $model->password_hash = md5($model->newpassword);
                    $model->temp_password = $model->newpassword;
                    if($model->save()) {
                        Yii::app()->user->setFlash('successChangeMyPassword', "Your password has been successfully changed.");
                        $this->redirect(array('change_my_password'));
                    }
                }
            }

            $this->render('change_my_password',array(
                    'model'=>$model,
            ));
    }      
    
}
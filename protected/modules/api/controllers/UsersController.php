<?php
class UsersController extends ApiController
{
    public function actionLogin()
    {
        $result = ApiModule::$defaultResponse;
        $this->checkRequest();        
        $q = $this->q;
        $this->checkRequiredParams($q, array('nric','password'));

//==================LOGIN=================

        $model =  new ApiLoginForm;
        $model->scenario = 'login_admin';

        $model->nric = trim($q->nric);
        $model->password = $q->password;
        $model->role_id = ROLE_AGENT;
        if(!$model->validate())
        {
            $result['message'] = Yii::t('systemmsg','Login ID or password is wrong');
            $result['record_error_key'] = array_keys($model->getErrors());
            $result['record_error'] = $model->getErrors();
            ApiModule::sendResponse($result);
        }
        
        $mUser = ApiUsers::model()->getByNric($q->nric);
        
        
//=================SAVE TOKEN=============        
        //create token
        $mUsersTokens = new UsersTokens();
        $mUsersTokens->user_id = $mUser->id;
        $mUsersTokens->token = md5($mUser->id.time().rand(100000, 1000000));
        $mUsersTokens->last_login = date('Y-m-d H:i:s');
        $mUsersTokens->has_expired = 0;
        $mUsersTokens->language = 'en';
        if(!empty($q->apns_device_token))
            $mUsersTokens->apns_device_token = $q->apns_device_token;
        if(!empty($q->gcm_device_token))
            $mUsersTokens->gcm_device_token = $q->gcm_device_token;
        $mUsersTokens->save();
        $mUsersTokens->token = $mUsersTokens->token.$mUsersTokens->id;
        $mUsersTokens->update(array('token'));
//==================RESPONSE==============
        $result = ApiModule::$defaultSuccessResponse;        
        $result['message'] = Yii::t('systemmsg','Login success');
        $result['token'] = $mUsersTokens->token;
        
        $result['record'] = array('nric'=>$mUser->nric_passportno_roc,
                                'email'=>$mUser->email,
        );
        ApiModule::sendResponse($result);
    }

    public function actionLogout()
    {
        $result = ApiModule::$defaultResponse;
        $this->checkRequest();
        $q = $this->q;
        $this->checkRequiredParams($q, array('token'));
        $this->handleRequestParams($q);
        
        ApiUsers::model()->logout($q->token);
        
        $result = ApiModule::$defaultSuccessResponse;
        $result['message'] = Yii::t('systemmsg','Logout success');
        ApiModule::sendResponse($result);
    }

	public function actionForgotPass() {
		$result = ApiModule::$defaultSuccessResponse;
		$this->checkRequest();
		$q = $this->q;
		$this->checkRequiredParams($q, array('email'));

		$model = new ForgotPasswordForm();
		$model->email = trim($q->email);
		if ($model->validate ()) {
			//check Email
			$criteria = new CDbCriteria();
			$criteria->compare('t.email_not_login', $model->email);
			$criteria->compare('t.role_id', ROLE_AGENT);
			$mUser = Users::model ()->find($criteria);
			if ( !$mUser) {
				$model->addError ( 'email', 'Email does not exist.' );
			} elseif ($mUser->status == STATUS_ACTIVE ) {
				$password = substr ( uniqid ( rand (), 1 ), 1, 10 );
				$pass_en = md5 ($password);
				$mUser->password_hash = $pass_en;
				$mUser->temp_password = $password;
				$mUser->update (array('password_hash', 'temp_password'));
				SendEmail::forgotPassword($mUser, $password, ROLE_AGENT);
				$result['message'] = Yii::t('systemmsg', 'An email with your new password has been sent to "{email}". '
					. 'Please check your inbox. If you do not receive the email, '
					. 'please add "@properyinfo.sg" to your mailbox safe list and check your Junk/Spam mailbox.',
					array('{email}'=>$mUser->email_not_login));
			} else {
				$model->addError( 'email', 'Email does not exist.' );
			}
		}

		$result['record_error_key'] = array_keys($model->getErrors());
		$result['record_error'] = $model->getErrors();
		ApiModule::sendResponse($result);
	}
}

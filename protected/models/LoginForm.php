<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class LoginForm extends CFormModel
{
	public $nick_name;
        public $username;
	public $password;
	public $rememberMe;
        public $role_id;
        public $email;
        public $verifyCode;
        public $nric;

	private $_identity;

	/**
	 * Declares the validation rules.
	 * The rules state that nick_name and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// nick_name and password are required
			array('email, password', 'required', 'on'=>'login'),
			array('nric, password', 'required', 'on'=>'login_admin'),
			// rememberMe needs to be a boolean
			array('rememberMe', 'boolean'),
			// password needs to be authenticated
			array('password', 'authenticate', 'on'=>'login'),
			array('password', 'authenticate_admin', 'on'=>'login_admin'),
            array('email', 'email'),
        );
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'rememberMe'=>'Remember me',
			'email'=>'Email Address',
			'nric'=>'FIN / NRIC',
		);
	}

	/**
	 * Authenticates the password.
	 * This is the 'authenticate' validator as declared in rules().
	 */
	public function authenticate($attribute,$params)
	{
		if(!$this->hasErrors()) // we only want to authenticate when no input errors
		{
            $this->_identity=new UserIdentity($this->email,$this->password);
            $this->_identity->authenticate();
            switch($this->_identity->errorCode)
            {
                case UserIdentity::ERROR_NONE:
                        $duration = $this->rememberMe ? 3600*24*30 : 0; // 30 days
                        Yii::app()->user->login($this->_identity,$duration);
                        break;
                case UserIdentity::ERROR_FAILURE_MAX_TIMES:
                        $times = Yii::app()->setting->getItem('login_limit_times');
                        $time_refresh = Yii::app()->setting->getItem('time_refresh_login');
                        $this->addError("username","You can't login more than $times times. Wait $time_refresh minutes!.");
                        break;
                case UserIdentity::ERROR_USERNAME_INVALID:
                        $this->addError("email","Email address is invalid.");
                        break;

                case UserIdentity::ERROR_USERNAME_BLOCKED:
                        $this->addError("email","Account has been blocked.");
                        break;
                case UserIdentity::ERROR_PASSWORD_INVALID:
                        $this->addError("password","Password is wrong. Please enter password again.");
                        break;
            }
		}
	}

    /**
     * Authenticates the password.
     * This is the 'authenticate' validator as declared in rules().
     */
    public function authenticate_admin($attribute,$params)
    {
        if(!$this->hasErrors()) // we only want to authenticate when no input errors
        {
            $this->_identity=new UserIdentity($this->nric,$this->password);
            $this->_identity->role_id = $this->role_id;

            $this->_identity->authenticate_admin();
            $linkContactUs = Yii::app()->createAbsoluteUrl('site/contact');
            $link = "<a target='_blank' href='$linkContactUs'>contact us</a>";
            switch($this->_identity->errorCode)
            {
                case UserIdentity::ERROR_NONE:
                    $duration = $this->rememberMe ? 3600*24*30 : 0; // 30 days
                    Yii::app()->user->login($this->_identity,$duration);
                    break;
                case UserIdentity::ERROR_FAILURE_MAX_TIMES:
                    $times = Yii::app()->setting->getItem('login_limit_times');
                    $time_refresh = Yii::app()->setting->getItem('time_refresh_login');
                    $this->addError("username","You can't login more than $times times. Wait $time_refresh minutes!.");
                    break;
                case UserIdentity::ERROR_USERNAME_INVALID:
                    $this->addError("nric","FIN / NRIC is invalid.");
                    break;

                case UserIdentity::ERROR_USERNAME_BLOCKED:
                    $this->addError("nric","Account has been blocked.");
                    break;
                case UserIdentity::ERROR_PASSWORD_INVALID:
                    $this->addError("password","Password is wrong. Please enter password again.");
                    break;
                case UserIdentity::ERROR_USERNAME_EXPIRED_LANDLORD:
                    $this->addError("nric","Landlords are able to access the Landlord portal even if their own tenancies has been expired.");
                    break;                
                case UserIdentity::ERROR_USERNAME_EXPIRED_TENANT:
                    
                    $this->addError("nric","Your All Tenancies periods have been expired. You are not allowed to access the <i>Tenant Portal</i> of PropertyInfologic.sg</br> Please ".$link." if you need further clarification.");
                    break;                
            }
        }
    }
}

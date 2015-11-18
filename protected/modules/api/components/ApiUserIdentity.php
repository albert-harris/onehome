<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class ApiUserIdentity extends CUserIdentity
{
    protected $_id;
    protected $_isAdmin = false;
	//private $applicationId = 2;
	//private $status = 1;
    public $role_id;
    const ERROR_USERNAME_BLOCKED=35; // verz custom by Nguyen Dung
    const ERROR_USERNAME_EXPIRED_LANDLORD=36; // verz custom by Jason
    const ERROR_USERNAME_EXPIRED_TENANT=37; // verz custom by Jason
    const ERROR_FAILURE_MAX_TIMES = 4;

    
    public function authenticate_admin()
    {
        $this->username = str_replace("'", "''", $this->username);
        //user ip login more than X times can't login
        $iplogin = new IpLogins();
        $iplogin->deleteOldRecords();
        // if(!$iplogin->limitLoginTimes($this->username, Yii::app()->request->getUserHostAddress()))
        // {
        //     $this->errorCode = self::ERROR_FAILURE_MAX_TIMES;
        //     return !$this->errorCode;
        // }

        $record=Users::model()->findByAttributes(array('nric_passportno_roc'=>$this->username, 'role_id'=>$this->role_id));

        if($record===null)
        {
            $this->errorCode=  self::ERROR_USERNAME_INVALID;
        }
        else if(trim($record->password_hash) != md5(trim($this->password)))
        {
            $this->errorCode=  self::ERROR_PASSWORD_INVALID;
            $record->login_attemp = $record->login_attemp + 1;
            $record->update();
        }
        else if(($record->role_id==ROLE_REGISTER_MEMBER || $record->role_id==ROLE_TENANT || $record->role_id==ROLE_LANDLORD ||
                $record->role_id==ROLE_AGENT) && $record->status==0 )
        {
//            $this->errorCode=  self::ERROR_USERNAME_BLOCKED;
            $this->errorCode=  self::ERROR_USERNAME_INVALID;
        }
        else if(($record->role_id==ROLE_REGISTER_MEMBER || $record->role_id==ROLE_TENANT || $record->role_id==ROLE_LANDLORD ||
                $record->role_id==ROLE_AGENT) && $record->status==2 )
        {
            $this->errorCode=  self::ERROR_USERNAME_BLOCKED;
        }
        else if($record->role_id==ROLE_LANDLORD && $this->checkExpired ($record))
        {
            $this->errorCode=  self::ERROR_USERNAME_EXPIRED_LANDLORD;
        }        
        else if($record->role_id==ROLE_TENANT && $this->checkExpired ($record))
        {
            $this->errorCode=  self::ERROR_USERNAME_EXPIRED_TENANT;
        }        
        else
        {
            $this->_id=$record->id;
            //  $this->setState('title', $record->nick_name);
            $this->errorCode=self::ERROR_NONE;
            $this->_isAdmin = false;
            // Update last IP and time
            $record->last_logged_in = date('Y-m-d H:i:s');
            $record->ip_address = Yii::app()->request->getUserHostAddress();
            $record->login_attemp = 0;
            Yii::app()->session['LOGGED_USER'] = $record;
            
            if(!$record->update())
                Yii::log(print_r($record->getErrors(), true), 'error', 'UserIdentity.authenticate_admin');
        }

        if($this->errorCode && $this->errorCode != self::ERROR_USERNAME_INVALID)
        {
            //write ip and username
            $iplogin->username = $this->username;
            $iplogin->ip_address = Yii::app()->request->getUserHostAddress();
            $iplogin->time_login = time();
            $iplogin->save();
        }

        if(isset($_POST['LoginForm']['rememberMe'])){
            if($_POST['LoginForm']['rememberMe']==1 && $record != NULL){
                ActiveRecord::setCookie(VERZ_COOKIE_MEMBER, $record, 'nric_passportno_roc');
            }
        }

        return !$this->errorCode;
    }

    public function getId()
    {
        return $this->_id;
    }

    public function getIsAdmin()
    {
        return $this->_isAdmin;
    }

    public function getRoleId()
    {
        return $this->role_id;
    }
}
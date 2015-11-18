<?php

class FacebookIdentity extends CUserIdentity
{
	/**
	 * @var string facebook user id
	 */
	public $fbid;
	
	/**
	 * @var string user id
	 */
	public $id;

	/**
	 * @var string display name
	 */
	public $name;

	/**
	 * @var int role
	 */
	public $role_id;

	/**
	 * Constructor.
	 * @param string $fbid facebook user id
	 */
	public function __construct($fbid)
	{
		$this->fbid=$fbid;
	}

	/**
	 * Authenticates a user based on {@link username} and {@link password}.
	 * Derived classes should override this method, or an exception will be thrown.
	 * This method is required by {@link IUserIdentity}.
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		$record = Users::model()->findByAttributes(array(
			'oauth_provider' => 'facebook',
			'oauth_uid' => $this->fbid
		));
		if($record===null) {
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		} else{
			$this->id = $record->id;
			$this->name = $record->first_name . ' ' . $record->last_name;
			$this->role_id = $record->role_id;
			$this->errorCode=self::ERROR_NONE;
		}
		return !$this->errorCode;
	}

	/**
	 * Returns the unique identifier for the identity.
	 * The default implementation simply returns {@link username}.
	 * This method is required by {@link IUserIdentity}.
	 * @return string the unique identifier for the identity.
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Returns the display name for the identity.
	 * The default implementation simply returns {@link username}.
	 * This method is required by {@link IUserIdentity}.
	 * @return string the display name for the identity.
	 */
	public function getName()
	{
		return $this->name;
	}
	
    public function getIsAdmin()
    {
        return false;
    }

    public function getRoleId()
    {
        return $this->role_id;
    }
	
}
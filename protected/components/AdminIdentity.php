<?php

/**
 * AdminIdentity represents the data needed to identity an admin user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class AdminIdentity extends CUserIdentity
{
	private $_id;
	public $display_name;
	public $last_login;
	
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		$objAdmin = Admin::model()->find('LOWER(admin_username)=:admin_username AND admin_status=:admin_status', array(':admin_username' => strtolower($this->username), ':admin_status'=> Admin::ACTIVE));

		if($objAdmin === null){
			$this->errorCode = self::ERROR_USERNAME_INVALID;
		}
		else{

			if(isset($objAdmin->admin_password) && $objAdmin->admin_password === sha1($this->password)){
				$this->_id			= $objAdmin->admin_id;
				$this->username		= $objAdmin->admin_username;
				$this->display_name	= $objAdmin->admin_display_name;
				$this->last_login	= $objAdmin->admin_last_login;
				$this->errorCode	= self::ERROR_NONE;

				// Store the user info in session
				$this->setState('id', $this->_id);
				$this->setState('username', $this->username);
				$this->setState('display_name', $this->display_name);
				$this->setState('last_login', $this->last_login);
				$this->setState('priv', $objAdmin->admin_priv);

				// Update the last login datetime
				$objAdmin -> admin_last_login = get_current_datetime();
				$objAdmin -> save();
			}
			else {
				$this->errorCode = self::ERROR_PASSWORD_INVALID;
			}
		}
		
		return $this->errorCode==self::ERROR_NONE;
	}
	
	public function getId()
    {
        return $this->_id;
    }	
}
<?php
/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class LoginForm extends CFormModel
{
	const ALLOWED_LOGIN_RETRY_TIMES = 10;
		
	public $admin_username;
	public $admin_password;

	private $_identity;

	/**
	 * Declares the validation rules.
	 * The rules state that admin_username and admin_password are required,
	 * and admin_password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// admin_username and admin_password are required
			array('admin_username, admin_password', 'required'),
			// admin_password needs to be authenticated
			array('admin_password', 'authenticate'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			//'rememberMe'=>'Remember me next time',
		);
	}

	/**
	 * Authenticates the admin_password.
	 * This is the 'authenticate' validator as declared in rules().
	 */
	public function authenticate($attribute,$params)
	{
		if(!$this->hasErrors())
		{
			$this->_identity=new AdminIdentity($this->admin_username, $this->admin_password);
			
			if(!$this->_identity->authenticate()){
				$this->addError('admin_password', Yii::t('app', 'Password is incorrect!'));
			}
		}
	}

	/**
	 * Logs in the user using the given admin_username and admin_password in the model.
	 * @return boolean whether login is successful
	 */
	public function login()
	{
		if($this->_identity===null)
		{
			$this->_identity=new AdminIdentity($this->admin_username, $this->admin_password);
			$this->_identity->authenticate();
		}
		
		if($this->_identity->errorCode===AdminIdentity::ERROR_NONE)
		{
			Yii::app()->user->login($this->_identity);
			return true;
		}
		else{
			return false;
		}
	}
}

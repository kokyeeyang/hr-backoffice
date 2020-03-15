<?php
Yii::import('application.vendor.*');

class SiteController extends Controller
{	
	/**
	 * Declares class-based actions.
	 */
	/*public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}*/
	
    public function filters()
    {
        return array(
            'accessControl',
        );
    }	

	public function accessRules()
	{
		return array(
			array(
				'allow',  // allow all users to perform the RoleHelper's returned actions
				'actions'=>RoleHelper::GetRole(self::$strController, false),
				'users'=>array('*'),
			),
			array(
				'allow', // allow authenticated admin user to perform the RoleHelper's returned actions
				'actions'=>RoleHelper::GetRole(self::$strController, true),
				'users'=>array('@'),
			),
			array(
				'deny',  // deny all other users access
				'users'=>array('*'),
			),
		);		
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest){
				
				if(Yii::app()->user->isGuest === false){
					echo $error['message'];
				} // - end: if
				Yii::app()->end();
			}
			else{
				$this->render('error', $error);
			}
		}
	}
	
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		self::forward('site/welcome');
	}	

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model = new LoginForm;
		$whiteListIpCheck = WhitelistedIp::model()->checkWhitelistExist();

		$visibility = "block";
		if($whiteListIpCheck == true){
			$visibility = "none";
		}

		// collect user input data
		if(!empty($_POST) && Yii::app()->request->isAjaxRequest){
			$strEmailAddress 	= $this->getParam('login_emailaddress', '', array('name' => Yii::t('app', 'Username'), 'required' => true));

			$strPassword 	= $this->getParam('login_password', '', array('name' => Yii::t('app', 'Password'), 'required' => true));
			$strCaptcha	 	= strtolower($this->getParam('login_captcha',''));

			$aResult 			= array();
			$aResult['result'] 	= 0;
			$aResult['title'] 	= Yii::t('app', 'Login Failed');
			$aResult['msg'] 	= Yii::t('app', 'Login Failed') . '<hr/>' . Yii::t('app', 'Username or password is incorrect!');
	
			$aResult['url']		= '';

			//check to see current user ip address has already been whitelisted inside the whitelisted_ip table
			$whiteListIpCheck = WhitelistedIp::model()->checkWhitelistExist();

			//if current ip address has already been whitelisted inside database, then bypass recaptcha
			if(!$error = $this->objError->getError()){
				if($whiteListIpCheck == false){
					if(isset(Yii::app()->session['captcha_key']) && $strCaptcha == Yii::app()->session['captcha_key']) {
						$model->attributes = array('admin_username' => $strEmailAddress, 'admin_password' => $strPassword);
						
						// validate user input and redirect to the previous page if valid
						if($model->validate() && $model->login()){
							$aResult['result'] 	= 1;
							$aResult['title'] 	= Yii::t('app', 'Login Success');
							$aResult['msg'] 	= Yii::t('app', 'Login Success') . '<br/>' . Yii::t('app', 'HR Back Office');
							$aResult['url']		= $this->createUrl('site/welcome');
							//$aResult['url']		= Yii::app()->user->returnUrl;
							Admin::resetLoginRetryTimes($strEmailAddress);
							AdminLoginLog::InsertLog($strEmailAddress, AdminLoginLog::STATUS_SUCCESS, get_ip());
						} else {
							Admin::increaseLoginRetryTimes($strEmailAddress);
							
							if(Admin::getLoginRetryTimes($strEmailAddress) > LoginForm::ALLOWED_LOGIN_RETRY_TIMES){ 
								// Automatically deactivates the account when the failed login exceeded the allow limit
								Admin::deactivateRecord($strEmailAddress);
								AdminLoginLog::InsertLog($strEmailAddress, AdminLoginLog::STATUS_RETRY_OVER, get_ip());
								$aResult['msg'] = Yii::t('app', 'Login Failed') . '<hr/>' . Yii::t('app', 'Your account has been deactivated!');
							} else {
								$aResult['msg'] = Yii::t('app', 'Login Failed') . '<hr/>' . Yii::t('app', 'Username or password is incorrect!');
								AdminLoginLog::InsertLog($strEmailAddress, AdminLoginLog::STATUS_FAIL, get_ip());
							} // - end: if else					
						} // - end: if else
					} else {
						$aResult['msg'] = Yii::t('app', 'Login Failed') . '<hr/>' . Yii::t('app', 'Please re-enter the verification code');
					} // - end: if else		
				} elseif ($whiteListIpCheck == true){

						$model->attributes = array('admin_username' => $strEmailAddress, 'admin_password' => $strPassword);
						
						// validate user input and redirect to the previous page if valid
						if($model->validate() && $model->login()){
							$aResult['result'] 	= 1;
							$aResult['title'] 	= Yii::t('app', 'Login Success');
							$aResult['msg'] 	= Yii::t('app', 'Login Success') . '<br/>' . Yii::t('app', 'HR Back Office');
							$aResult['url']		= $this->createUrl('site/welcome');
							//$aResult['url']		= Yii::app()->user->returnUrl;
							Admin::resetLoginRetryTimes($strEmailAddress);
							AdminLoginLog::InsertLog($strEmailAddress, AdminLoginLog::STATUS_SUCCESS, get_ip());
						} else {
							Admin::increaseLoginRetryTimes($strEmailAddress);
							
							if(Admin::getLoginRetryTimes($strEmailAddress) > LoginForm::ALLOWED_LOGIN_RETRY_TIMES){ 
								// Automatically deactivates the account when the failed login exceeded the allow limit
								Admin::deactivateRecord($strEmailAddress);
								AdminLoginLog::InsertLog($strEmailAddress, AdminLoginLog::STATUS_RETRY_OVER, get_ip());
								$aResult['msg'] = Yii::t('app', 'Login Failed') . '<hr/>' . Yii::t('app', 'Your account has been deactivated!');
							} else {
								$aResult['msg'] = Yii::t('app', 'Login Failed') . '<hr/>' . Yii::t('app', 'Username or password is incorrect!');
								AdminLoginLog::InsertLog($strEmailAddress, AdminLoginLog::STATUS_FAIL, get_ip());
							} // - end: if else					
						} // - end: if else
				}
			} else {
				$aResult['msg'] = Yii::t('app', 'Login Failed') . '<hr/>' . $error;
			} // - end: if else
			
			echo(json_encode($aResult));
			Yii::app()->end();
		}
		

		if(Yii::app()->user->isGuest === false){

			self::forward('site/welcome');
		}
		else{
			// display the login form
			$this->render('login',array('model'=>$model, 'whiteListIpCheck' => $whiteListIpCheck, "visibility" => $visibility));
		} // - end: if else
	}
	
	/**
	 * Displays the welcome page
	 */
	public function actionWelcome()
	{	
		$arrRecords = AdminLoginLog::model() -> findAll(array('order'=>'admin_login_log_id DESC', 'condition' => 'admin_login_log_username = :admin_username', 'limit'=>10, 'params' => array(':admin_username' => Yii::app()->user->username)));
		$purgeUnusedTokens = EmploymentLinkToken::model()->purgeUnusedTokens();

		$this->render('welcome', array('model'=>$arrRecords));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
	
	/**
	 * This is the 'captcha' action
	 */
	public function actionCaptcha()
	{
		require_once('ydl/captcha/Captcha.php');
		Captcha::genCaptcha();
	}


}
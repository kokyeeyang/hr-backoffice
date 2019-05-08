<?php
	/***
	Define your project configurations here
	*/
	/*** Session */
	session_start();
	//session_regenerate_id(true);
	
	/*** Theme Settings */
	define('THEME_DEFAULT', 'default');
	
	if(!empty($_REQUEST['theme'])){
		$_SESSION['theme'] = $_REQUEST['theme'];
	}
	else if(isset($_SESSION['theme']) === false){
		$_SESSION['theme'] = null;
	}
	
	switch($_SESSION['theme']){		
		default:
			$_SESSION['theme'] = THEME_DEFAULT;
		break;
	}

	/*** Miscellaneous Constants */
	define('DEFAULT_CURRENCY', 'AUD');
	define('THEME', $_SESSION['theme']);
			
	/*** Physical Paths */
	define('DIR_CONFIG', dirname(__FILE__));
	define('DIR_PROTECTED', dirname(dirname(__FILE__)));
	define('DIR_RUNTIME', dirname(dirname(dirname(__FILE__))).DIRECTORY_SEPARATOR.'runtime');
	define('DIR_LOGS', DIR_RUNTIME.DIRECTORY_SEPARATOR.'logs');
	define('DIR_LOGS_CONSOLE', DIR_LOGS.DIRECTORY_SEPARATOR.'console');
	define('DIR_LOGS_ETC', DIR_LOGS.DIRECTORY_SEPARATOR.'etc');
	
	define('CONSOLE_YIIC', DIR_PROTECTED.DIRECTORY_SEPARATOR.'yiic');
	define('CONSOLE_PASSKEY', '8azr8qc293b9175d012e15e03b270t0bv');
	define('TIME_ZONE', 'UTC');
	
	// To determine the environment API
	if(PHP_SAPI === 'cli'){ // CLI Mode
		define('ENV_API', 'console');
		$strEnvMode = Basiclib::get_console_opt('mode');
	}
	else{ // Web Mode
		define('ENV_API', 'web');
		define('SERVER_NAME', (isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : ''));
		
		if(preg_match('/dev\./', SERVER_NAME)){
			$strEnvMode	= 'dev';
		}
		else{
			$strEnvMode	= strstr(SERVER_NAME, '.', true);
		} // - end: if else
	} // - end: if else

	// To determine the environment mode
	switch($strEnvMode){
		case 'dev': // Development Mode
			define('ENV_MODE', 'dev');
			// remove the following lines when in production mode
			defined('YII_DEBUG') or define('YII_DEBUG', true);
			// specify how many levels of call stack should be shown in each log message
			defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', 3);	
			define('HTTP_MEDIA_SERVER', '');
		break;

		case 'prod': // Production Mode
		default:
			define('ENV_MODE', 'prod');
			// remove the following lines when in production mode
			 defined('YII_DEBUG') or define('YII_DEBUG',true);
			// specify how many levels of call stack should be shown in each log message
			 defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);			
			define('HTTP_MEDIA_SERVER', '');	
		break;
	} // - end: switch
	
	// Application Constants
	define('NUM_PER_PAGE', 10);
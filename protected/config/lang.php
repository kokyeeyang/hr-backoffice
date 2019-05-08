<?php	
	$strProtectedDir 	= realpath(dirname(dirname(__FILE__)));
	$strModelsDir 		= $strProtectedDir . '/models';
	
	define('LANG_CN', 'cn');
	define('LANG_HK', 'hk');
	define('LANG_EN', 'en');

	//Set Default Language
	define('LANG_DEFAULT', LANG_EN);
	
	require_once($strModelsDir.'/Language.php');

	if(ENV_API === 'console'){
		$strLang = Basiclib::get_console_opt('lang');
		
		if(isset(Language::$arrLang[$strLang])) {
			define('LANG',$strLang);
			define('LANG_ID', Language::$arrLang[$strLang]);
		}
		else{
			define('LANG', LANG_DEFAULT);
			define('LANG_ID', Language::$arrLang[LANG_DEFAULT]);
		} // - end: if else
	}
	else{
	
		if(isset($_POST['lang']) && isset(Language::$arrLang[$_POST['lang']])) {
			define('LANG', $_POST['lang']);
			define('LANG_ID', Language::$arrLang[$_POST['lang']]);
		}
		else if(isset($_GET['lang']) && isset(Language::$arrLang[$_GET['lang']])) {
			define('LANG', $_GET['lang']);
			define('LANG_ID', Language::$arrLang[$_GET['lang']]);			
		}
		else if(isset($_SESSION['lang']) && isset(Language::$arrLang[$_SESSION['lang']])) {
			define('LANG', $_SESSION['lang']);
			define('LANG_ID', Language::$arrLang[$_SESSION['lang']]);				
		}
		else{
			define('LANG', LANG_DEFAULT);
			define('LANG_ID', Language::$arrLang[LANG_DEFAULT]);
		} // - end: if else
		$_SESSION['lang'] = LANG;
	} // - end: if else	
?>
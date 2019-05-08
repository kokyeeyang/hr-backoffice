<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class AppConsoleCommand extends CConsoleCommand
{
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */	
	static $strController;
	static $strAction;
	
	public $verbose	= false;
	public $strCurrentDatetime;
	
    public function init(){
		parent::init();
		self::setConstants();
		$this -> strCurrentDatetime	= get_current_datetime();
    }
	
	public function beforeAction($objAction, $aParams = array()){
		return parent::beforeAction($objAction, $aParams);
	}	
	
	public static function setConstants(){
		
		if(!defined('HTTP_MEDIA_WEBROOT')){
			define('HTTP_MEDIA_WEBROOT', HTTP_MEDIA_SERVER . Yii::app()->request->baseUrl);
		} // - end: if
		
		if(!defined('HTTP_MEDIA_CURRENT_THEME')){
			define('HTTP_MEDIA_CURRENT_THEME', HTTP_MEDIA_WEBROOT . '/themes/'.THEME);
		} // - end: if
		
		if(!defined('HTTP_MEDIA_IMAGES')){
			define('HTTP_MEDIA_IMAGES', HTTP_MEDIA_WEBROOT . '/images');
		} // - end: if	
		
		if(!defined('HTTP_MEDIA_JS')){
			define('HTTP_MEDIA_JS', HTTP_MEDIA_WEBROOT . '/js');
		} // - end: if

		if(!defined('HTTP_MEDIA_CSS')){
			define('HTTP_MEDIA_CSS', HTTP_MEDIA_WEBROOT . '/css');
		} // - end: if

		if(!defined('DIR_MEDIA_CURRENT_THEME')){
			define('DIR_MEDIA_CURRENT_THEME', Yii::getPathOfAlias('webroot.themes.'.THEME));
			define('DIR_MEDIA_CURRENT_THEME_SECTIONS', Yii::getPathOfAlias('webroot.themes.'.THEME.'.sections'));
		} // - end: if
		
		if(!defined('DIR_MEDIA_JS')){
			define('DIR_MEDIA_JS', Yii::getPathOfAlias('webroot.js'));
			define('DIR_MEDIA_JS_SECTIONS', Yii::getPathOfAlias('webroot.js.sections'));
		} // - end: if		
	}
	
	//================================================================================================
	// To validate the access of the console requests
	// 1st param: used for passkey(i.e. authentication)
	// 2nd param: used for languague setting(e.g. en, cn...)
	//================================================================================================ 	
	public static function validateAccess($strPassKey){

		if($strPassKey != CONSOLE_PASSKEY){
			exit("Invalid Access!\r\n");
		} // - end: if
	}	

	public static function setLanguage($strLang = null){
		// Prevent Re-defined LANG Constants
		if(defined('LANG')){
			return false;
		}
		
		if(isset(Language::$arrLang[$strLang])) {
			define('LANG', $strLang);
			define('LANG_ID', Language::$arrLang[$strLang]);			
		}
		else{
			define('LANG', LANG_DEFAULT);
			define('LANG_ID', Language::$arrLang[LANG_DEFAULT]);	
		}
		return true;
	}	
}
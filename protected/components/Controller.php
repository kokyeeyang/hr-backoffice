<?php
	Yii::import('application.vendor.ydl.sanitizer.*');
	Yii::import('application.vendor.ydl.filemanager.*');
	require_once 'Validator.class.php';
	require_once 'FormError.class.php';
	require_once 'FileManager.class.php';
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column2';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
	
	public $objValidator;
	public $objError;
	public $objFileManager;
	
	static $strController;
	static $strAction;
	
	public $strCurrentDatetime;

	public $intPage;

	static $arrThemes = [THEME_DEFAULT => 'Default'];
	
	//static $arrLang = array(LANG_CN => 1, LANG_HK => 2, LANG_EN => 3); // The valid laguagues for the site

    public function init(){
		
		// Force HTTPS connection
		if(isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] !== 'https'){
			header('Location: https://'.SERVER_NAME);
			exit;
		}
		parent::init();
		self::controlAccess();
		
		// Put your codes here for the things that should be applied to all Controllers
		self::$strController = Yii::app()->getController()->getId();
		$this -> strCurrentDatetime	= get_current_datetime();
		
		$this->setConstants();
		
		self::setLanguage();
		
		self::setErrorHandler();
		
		$this->setPage();
		$this->setPageMeta();
    }
	
	public function beforeAction($objAction){
		self::$strAction = $objAction -> getid();
		$this -> setActivityLog();
		
		self::registerScripts();
				
		return parent::beforeAction($objAction);
	}
	
	public function setConstants(){
		defined('HTTP_MEDIA_WEBROOT') or define('HTTP_MEDIA_WEBROOT', HTTP_MEDIA_SERVER . Yii::app()->request->baseUrl);
		defined('HTTP_MEDIA_CURRENT_THEME') or define('HTTP_MEDIA_CURRENT_THEME', HTTP_MEDIA_WEBROOT . '/themes/'.THEME);
		defined('HTTP_MEDIA_IMAGES') or define('HTTP_MEDIA_IMAGES', HTTP_MEDIA_WEBROOT . '/images');
		defined('HTTP_MEDIA_JS') or define('HTTP_MEDIA_JS', HTTP_MEDIA_WEBROOT . '/js');
		defined('HTTP_MEDIA_CSS') or define('HTTP_MEDIA_CSS', HTTP_MEDIA_WEBROOT . '/css');
		
		defined('DIR_MEDIA_CURRENT_THEME') or define('DIR_MEDIA_CURRENT_THEME', Yii::getPathOfAlias('webroot.themes.'.THEME));
		defined('DIR_MEDIA_CURRENT_THEME_SECTIONS') or define('DIR_MEDIA_CURRENT_THEME_SECTIONS', Yii::getPathOfAlias('webroot.themes.'.THEME.'.sections'));
		defined('DIR_MEDIA_JS') or define('DIR_MEDIA_JS', Yii::getPathOfAlias('webroot.js'));
		defined('DIR_MEDIA_JS_SECTIONS') or define('DIR_MEDIA_JS_SECTIONS', Yii::getPathOfAlias('webroot.js.sections'));	
	}
	
	public function setPage(){
		$this -> intPage = (int)$this->getParam('page', 0, array('name' => Yii::t('app', 'Page')));
		$this -> intPage = ($this -> intPage < 0) ? 0 : $this -> intPage; // For zero-based pagination, page 0 stands for 1st page.
	}
	
	public function setPageMeta(){
		$this -> pageTitle = Yii::t('app', Yii::app()->name) . ' - ' . Yii::t('app', 'Back Office');
	}
	
	// Function : setErrorHandler
	// Desc. 	: To set the error handler for detecting and displaying the error in the customized error page(i.e. site/error).
	// 			  This 'setErrorHandler' will overwrite the 'errorHandler' set in the config file(i.e. config/env/web/master.php). 
	// 			  As the config's 'ErrorHandler' is unable to show the 'CDbException' errors in the customized error page(i.e. site/error).
	public static function setErrorHandler(){
	
		if($arrError=Yii::app()->errorHandler->error){
			self::$strController = 'site';
			self::$strAction	 = 'error';
			
			// To overwrite the errorAction by the errorHandler's setting in the config
			if(preg_match('/^([A-z0-9_]+)\/([A-z0-9_]+)$/', Yii::app()->errorHandler->errorAction, $aMatch) && !empty($aMatch[2])){
				self::$strController = $aMatch[1];
				self::$strAction	 = $aMatch[2];
			} // - end: if
			
			if(($objController = Yii::app()->createController(self::$strController)) !== null){				
				// To render the css for the site-error page
				if(!Yii::app()->request->isAjaxRequest){		
					self::registerScripts();
				} // - end: if
				
				list($objController, $strActionId) = $objController;
				//$objController->init();
				$objController->render(self::$strAction, $arrError);
			}
			unset($objController);
			Yii::app()->end();
		}	
	}
	
	public static function controlAccess(){
		// Access Control for Test Environment
		if(ENV_MODE !== 'prod'){
			$arrIP = (array)Yii::app()->params['allowedAccessIP'];

			if(!in_array(get_ip(), $arrIP)){
				//throw new CHttpException(401,'Access Denied');
				exit('401 Access Denied');
			} // - end: if
		} // - end: if
	}
	
	public static function registerScripts(){
		
		if(!Yii::app()->request->isAjaxRequest){ // For non-ajax requests only
			$strNormalizedController = str_normalize(self::$strController);
			$strNormalizedAction	 = str_normalize(self::$strAction);
			
			$objCS = Yii::app()->getClientScript();
			
			// To disable some yii autoload libs
			$objCS->scriptMap['jquery.js'] 		= false;
			$objCS->scriptMap['jquery.min.js'] 	= false;
			
			$objCS->registerScriptFile(HTTP_MEDIA_JS.'/stdlib.js?sv='.SITE_VERSION, CClientScript::POS_HEAD);
			$objCS->registerScriptFile(HTTP_MEDIA_JS.'/jquery-1.9.1.min.js?sv='.SITE_VERSION, CClientScript::POS_HEAD);
			$objCS->registerScriptFile(HTTP_MEDIA_JS.'/jquery-migrate-1.1.1.js?sv='.SITE_VERSION, CClientScript::POS_HEAD);
			$objCS->registerScriptFile(HTTP_MEDIA_JS.'/jquery.mousewheel-3.0.6.pack.js?sv='.SITE_VERSION, CClientScript::POS_HEAD);
			$objCS->registerCssFile(HTTP_MEDIA_JS.'/jquery-ui-1.10.1/themes/base/minified/jquery-ui.min.css?sv='.SITE_VERSION, 'screen, projection');
			$objCS->registerScriptFile(HTTP_MEDIA_JS.'/jquery-ui-1.10.1/ui/minified/jquery-ui.min.js?sv='.SITE_VERSION, CClientScript::POS_HEAD);
			$objCS->registerScriptFile(HTTP_MEDIA_JS.'/jquery-ui-timepicker-addon.js?sv='.SITE_VERSION, CClientScript::POS_HEAD);

			if(LANG === LANG_CN){
				$objCS->registerScriptFile(HTTP_MEDIA_JS.'/jquery-ui-1.10.1/ui/minified/i18n/jquery.ui.datepicker-zh-CN.min.js?sv='.SITE_VERSION, CClientScript::POS_HEAD);			
				$objCS->registerScriptFile(HTTP_MEDIA_JS.'/jquery-ui-timepicker-zh-CN.js?sv='.SITE_VERSION, CClientScript::POS_HEAD);
			} // - end: if
			
			$objCS->registerCssFile(HTTP_MEDIA_JS.'/fancybox/jquery.fancybox.css?sv='.SITE_VERSION, 'screen, projection');
			$objCS->registerScriptFile(HTTP_MEDIA_JS.'/fancybox/jquery.fancybox.pack.js?sv='.SITE_VERSION, CClientScript::POS_HEAD);
			
			$objCS->registerScriptFile(HTTP_MEDIA_JS.'/jquery.placeholder.js?sv='.SITE_VERSION, CClientScript::POS_HEAD);
			$objCS->registerScriptFile(HTTP_MEDIA_JS.'/jquery.form.min.js?sv='.SITE_VERSION, CClientScript::POS_HEAD);

			if(Yii::app()->user->isGuest === false){ // Already Login then chosse project.php
				$objCS->registerScriptFile(HTTP_MEDIA_JS.'/project.php?sv='.SITE_VERSION, CClientScript::POS_HEAD);
			}
			else{
				$objCS->registerScriptFile(HTTP_MEDIA_JS.'/project.js?sv='.SITE_VERSION, CClientScript::POS_HEAD);
			} // - end: if else

			if(in_array($strNormalizedController, ['registration'])){
				if(Yii::app()->user->isGuest === true){
					$objCS->registerCssFile(HTTP_MEDIA_CURRENT_THEME.'/registration-add_candidate.css?sv='.SITE_VERSION, 'screen, projection');
				}else if (Yii::app()->user->isGuest === false){
					$objCS->registerCssFile(HTTP_MEDIA_CURRENT_THEME.'/common.css?sv='.SITE_VERSION, 'screen, projection');
				}
			}  
			else {
				if(Yii::app()->user->isGuest === false){
					// echo('you are logged in!');
					$objCS->registerCssFile(HTTP_MEDIA_CURRENT_THEME.'/common.css?sv='.SITE_VERSION, 'screen, projection');
				}
			}

			if(is_file(DIR_MEDIA_CURRENT_THEME_SECTIONS . '/' . $strNormalizedController . '.css')){ 
				$objCS->registerCssFile(HTTP_MEDIA_CURRENT_THEME . '/sections/' . $strNormalizedController . '.css?sv='.SITE_VERSION, 'screen, projection');
			} // end: if

			if(is_file(DIR_MEDIA_JS_SECTIONS . '/' . $strNormalizedController . '.js') && !in_array($strNormalizedController, array('admin', 'setting', 'setting_profit_margin'))){
				$objCS->registerScriptFile(HTTP_MEDIA_JS . '/sections/' . $strNormalizedController . '.js?sv='.SITE_VERSION, CClientScript::POS_HEAD);
			} // end: if
			
			if(is_file(DIR_MEDIA_CURRENT_THEME_SECTIONS . '/' . $strNormalizedController .'-'. $strNormalizedAction . '.php')){ 
				$objCS->registerCssFile(HTTP_MEDIA_CURRENT_THEME . '/sections/' . $strNormalizedController .'-'. $strNormalizedAction . '.php?sv='.SITE_VERSION.'&lang='.LANG, 'screen, projection');
			}			
			else if(is_file(DIR_MEDIA_CURRENT_THEME_SECTIONS . '/' . $strNormalizedController .'-'. $strNormalizedAction . '.css')){ 
				$objCS->registerCssFile(HTTP_MEDIA_CURRENT_THEME . '/sections/' . $strNormalizedController .'-'. $strNormalizedAction . '.css?sv='.SITE_VERSION, 'screen, projection');
			} // end: if			

			if(is_file(DIR_MEDIA_JS_SECTIONS . '/' . $strNormalizedController .'-'. $strNormalizedAction . '.js')){
				$objCS->registerScriptFile(HTTP_MEDIA_JS . '/sections/' . $strNormalizedController .'-'. $strNormalizedAction . '.js?sv='.SITE_VERSION, CClientScript::POS_HEAD);
			} // end: if
			
			if(!in_array($strNormalizedController .'-'. $strNormalizedAction, array('site-login', 'site-welcome'))){
				$objCS->registerCssFile(HTTP_MEDIA_JS . '/scroller/jquery.jscrollpane.css?sv='.SITE_VERSION, 'screen, projection');
				$objCS->registerCssFile(HTTP_MEDIA_JS . '/scroller/jquery.jscrollpane.lozenge.css?sv='.SITE_VERSION, 'screen, projection');
				$objCS->registerScriptFile(HTTP_MEDIA_JS . '/scroller/jquery.jscrollpane.min.js?sv='.SITE_VERSION, CClientScript::POS_HEAD);
			}
			else{
				$objCS->registerScriptFile(HTTP_MEDIA_JS . '/jquery.arttextlight.js?sv='.SITE_VERSION, CClientScript::POS_HEAD);
			} // end: if else		
			
			$objCS->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css', 'screen, projection');
			
			//ADDED BY jjjl ON 2018-11-01
			$objCS->registerScriptFile(HTTP_MEDIA_JS . '/sweetalert2/dist/sweetalert2.min.js?sv='.SITE_VERSION, CClientScript::POS_HEAD);
			$objCS->registerCssFile(HTTP_MEDIA_JS . '/sweetalert2/dist/sweetalert2.min.css?sv='.SITE_VERSION, 'screen, projection');
			
			$objCS->registerScriptFile('https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js', CClientScript::POS_HEAD);			
			
			//$objCS->registerCssFile(CHtml::asset(Yii::getPathOfAlias('system.web.widgets.pagers.pager').'.css').'?sv='.SITE_VERSION, 'screen, projection');
		} // - end: if
	}

	public static function setLanguage(){
		Yii::app()->session->add('lang', LANG);
		Yii::app()->session->add('lang_id', LANG_ID);
		Yii::app()->setLanguage(LANG);
		//define('LANG', Yii::app()->session->itemAt('lang'));
		//define('LANG_ID', Yii::app()->session->itemAt('lang_id'));
	}
	
	public function getParam($paramkey, $param_default = '', $arrAtt = null, $requestmethod = '') {
		$this->objValidator 	= ($this->objValidator !== null) ? $this->objValidator : new Validator();
		$this->objError 		= ($this->objError !== null) ? $this->objError : new FormError();

		// New get param
		// Need to use FormError.class.php and Validator.class.php
		// both must instantiate outside this function
		switch(strtolower($requestmethod)) {
			case 'post':
				$param = isset($_POST[$paramkey])? $_POST[$paramkey] : '';
				break;
			case 'get':
				$param = isset($_GET[$paramkey])? $_GET[$paramkey] : '';
				break;
			case 'cookie':
				$param = isset($_COOKIE[$paramkey])? $_COOKIE[$paramkey] : '';
				break;
			case 'server':
				$param = isset($_SERVER[$paramkey])? $_SERVER[$paramkey] : '';
				break;
			case 'session':
				$param = isset($_SESSION[$paramkey])? $_SESSION[$paramkey] : '';
				break;
			default:
				switch(strtolower($_SERVER['REQUEST_METHOD'])) {
					case 'post':
						$param = isset($_POST[$paramkey])? $_POST[$paramkey] : '';
						break;
					case 'get':
					default:
						$param = isset($_GET[$paramkey])? $_GET[$paramkey] : '';
				}
			break;
		}
		$this->objValidator -> clean();
		$this->objValidator -> set('test_value', $param);
		$this->objValidator -> set('default_value', $param_default);
		
		// Reset Attribute
		$this->objValidator -> set('arrAtt', $arrAtt);
		$this->objValidator -> execute();
		/*
		if($error = $objValidator -> getError())
			$objError -> add($error);
			
		if($errorkey = $objValidator -> getErrorKey())
			$objError -> addKey($errorkey);
		*/
		if($error = $this->objValidator -> getError()) {
			$this->objError -> addKeyError($paramkey, $error);
		}
		
		return $this->objValidator -> getCleanValue();
	}
	
	public function uploadFile($strFilename, $strTmpFilename, $strPath, $strType = null) {
		$objFileManager = ($this->objFileManager !== null) ? $this->objFileManager : new FileManager();
		$this->objError = ($this->objError !== null) ? $this->objError : new FormError();
		
		if($strUploadedFilename = $objFileManager -> upload($strFilename, $strTmpFilename, $strPath, $strType)) {
			return $strUploadedFilename;
		}
		else {
			$this->objError -> addKeyError('file_upload', $objFileManager -> getError());
			return false;
		}
	}	

	public function setActivityLog(){
		AdminActivityLog::InsertLog((isset(Yii::app()->user->id) ? (int)Yii::app()->user->id : 0), self::$strController, self::$strAction, get_ip());
	}	
}
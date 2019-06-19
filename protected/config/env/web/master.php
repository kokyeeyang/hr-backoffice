<?php
return array(
	'basePath'=> $protectedPath, // Changed by KC 2013-10-01
	'runtimePath'=> $runtimePath, // Added by KC 2013-10-01
	'name'=>'HR Back Office',
	'sourceLanguage'=> LANG,
	'language' => LANG,
	'timeZone' => TIME_ZONE,
	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.helpers.*',
		'ext.YiiMailer.YiiMailer',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool(KC: Uncommented on 2013-10-14)
		/*'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'uwontno',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			//'ipFilters'=>array('127.0.0.1','::1'),
			'ipFilters'=>array('192.168.56.1'), // KC: Added 2013-10-14
		),*/
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>false,
			// the user auth session will be timeout in seconds(i.e. the idle time in seconds)
			'authTimeout'=>30*60,
			'loginUrl'=>array('site/login')
		),
		// uncomment the following to enable URLs in path-format
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:(\d+|\w+)>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
				'my-admin'=>'site/login',
			),
		),
		'errorHandler'=>array(
			'class'=>'ErrorHandler',
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
		),
		'file'=>array(
			'class'=>'application.extensions.file.CFile',
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		'adminEmail'	=> MAIL_WEBMASTER_ADDRESS,
		'numPerPage'	=> NUM_PER_PAGE
	),
);
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

	// application components
	'components'=>array(		
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
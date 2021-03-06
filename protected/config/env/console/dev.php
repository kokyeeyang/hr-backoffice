<?php
return array(
		'components'=>array(
			'fixture'=>array(
				'class'=>'system.test.CDbFixtureManager',
			),
			'db'=>array(
				'connectionString' => 'mysql:host='.DB_HOST.';dbname='.DB_NAME,
				'emulatePrepare' => true,
				//'enableParamLogging' => true,
				'username' => DB_USERNAME,
				'password' => DB_PASSWORD,
				'charset' => DB_CHARSET,
			),
			'log'=>array(
				'routes'=>array(
					array(
						'class'=>'CFileLogRoute',
						'levels'=>'error, warning',
					),
					// uncomment the following to show log messages on web pages
					/*array(
						'class'=>'CWebLogRoute',
					),*/
				),
			),			
		),
		// application-level parameters that can be accessed
		// using Yii::app()->params['paramName']
		'params'=>array(
			'allowedAccessIP' 	=> array('192.168.56.1', '192.168.6.106', '192.168.6.107', '211.24.92.109', '175.136.85.79') // The IPs that are allowed to access the application for doing testing
		),
	);

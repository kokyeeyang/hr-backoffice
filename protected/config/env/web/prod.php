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
						'except'=>'exception.CHttpException.404,exception.CHttpException.403',
					),
					array(
						'class'=>'CEmailLogRoute',
						'levels'=>'error, warning',
						'except'=>'exception.CHttpException.404,exception.CHttpException.403',
						'emails' =>array(MAIL_ERROR_RECEIVER),
						'sentFrom'=>MAIL_SENDER_ADDRESS,
						'subject'=>'HRBO Error Mailer - BO(WEB)',
					),					
					// uncomment the following to show log messages on web pages
					/*array(
						'class'=>'CWebLogRoute',
					),*/
				),
			),			
		)
	);

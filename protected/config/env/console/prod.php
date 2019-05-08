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
					array(
						'class'=>'CEmailLogRoute',
						'levels'=>'error, warning',
						'emails' =>array(MAIL_ERROR_RECEIVER),
						'sentFrom'=>MAIL_SENDER_ADDRESS,
						'subject'=>'HRBO Error Mailer - BO(CLI)',	
					),
					// uncomment the following to show log messages on web pages
					/*array(
						'class'=>'CWebLogRoute',
					),*/
				),
			),			
		)
	);

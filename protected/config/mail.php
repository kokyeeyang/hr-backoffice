<?php
if(!defined('SMTP_MODE')){
	// send via SMTP, else send via native mail()
	define('SMTP_MODE', false);						

	// To determine the environment mode
	switch(ENV_MODE){
		
		case 'dev': // Development Mode
			// define required parameters for SMTP_MODE, if chosen
			if (SMTP_MODE) {
				define('SMTP_HOST', '');
				define('SMTP_SECURE', 'ssl'); // Sets connection prefix. Options are "", "ssl" or "tls"
				define('SMTP_PORT', '465'); // Sets the default SMTP server port.
				define('SMTP_AUTH', true);
				define('SMTP_USER', '');
				define('SMTP_PASS', '');
			}
			// sender's name and email address
			define('MAIL_SENDER_NAME', 'HRBO Mailer');
			define('MAIL_SENDER_ADDRESS', 'dev@onwardprojects.com');
			
			// webmaster's name and email address
			define('MAIL_WEBMASTER_NAME', 'HRBO Webmaster');
			define('MAIL_WEBMASTER_ADDRESS', 'dev@onwardprojects.com');			

			// error handler sender
			define('MAIL_ERROR_SENDER_NAME', 'Error Mailer');
			define('MAIL_ERROR_SUBJECT', 'HRBO - MAIL');			
			
			// error handler recevier
			define('MAIL_ERROR_RECEIVER', 'dev@onwardprojects.com');
		break;
		
		case 'beta': // Beta Mode
			// define required parameters for SMTP_MODE, if chosen
			if (SMTP_MODE) {
				define('SMTP_HOST', '');
				define('SMTP_SECURE', 'ssl'); // Sets connection prefix. Options are "", "ssl" or "tls"
				define('SMTP_PORT', '465'); // Sets the default SMTP server port.
				define('SMTP_AUTH', true);
				define('SMTP_USER', '');
				define('SMTP_PASS', '');
			}
			// sender's name and email address
			define('MAIL_SENDER_NAME', 'HRBO Mailer');
			define('MAIL_SENDER_ADDRESS', 'dev@onwardprojects.com');
			
			// webmaster's name and email address
			define('MAIL_WEBMASTER_NAME', 'HRBO Webmaster');
			define('MAIL_WEBMASTER_ADDRESS', 'dev@onwardprojects.com');

			// error handler sender
			define('MAIL_ERROR_SENDER_NAME', 'Error Mailer');
			define('MAIL_ERROR_SUBJECT', 'HRBO - MAIL');			
			
			// error handler recevier
			define('MAIL_ERROR_RECEIVER', 'dev@onwardprojects.com');
		break;
		
		case 'prod': // Production Mode
		default:
			// define required parameters for SMTP_MODE, if chosen
			if (SMTP_MODE) {
				define('SMTP_HOST', '');
				define('SMTP_SECURE', 'ssl'); // Sets connection prefix. Options are "", "ssl" or "tls"
				define('SMTP_PORT', '465'); // Sets the default SMTP server port.
				define('SMTP_AUTH', true);
				define('SMTP_USER', '');
				define('SMTP_PASS', '');
			}
			// sender's name and email address
			define('MAIL_SENDER_NAME', 'HRBO Mailer');
			define('MAIL_SENDER_ADDRESS', 'dev@onwardprojects.com');
			
			// webmaster's name and email address
			define('MAIL_WEBMASTER_NAME', 'HRBO Webmaster');
			define('MAIL_WEBMASTER_ADDRESS', 'dev@onwardprojects.com');		

			// error handler sender
			define('MAIL_ERROR_SENDER_NAME', 'Error Mailer');
			define('MAIL_ERROR_SUBJECT', 'HRBO - MAIL');		
			
			// error handler recevier
			define('MAIL_ERROR_RECEIVER', 'dev@onwardprojects.com');
		break;
	} // - end: switch
}
else{
	// Utilized in ext.YiiMailer.YiiMailer
	return array(
		'viewPath' => 'application.views.mail',
		'layoutPath' => 'application.views.layouts',
		'baseDirPath' => 'webroot.images.mail',
		'savePath' => 'application.assets.mail',
		'testMode' => false,
		'layout' => 'mail',
		'CharSet' => 'UTF-8',
		'AltBody' => Yii::t('YiiMailer','You need an HTML capable viewer to read this message.'),
		'language' => array(
			'authenticate'         => Yii::t('YiiMailer','SMTP Error: Could not authenticate.'),
			'connect_host'         => Yii::t('YiiMailer','SMTP Error: Could not connect to SMTP host.'),
			'data_not_accepted'    => Yii::t('YiiMailer','SMTP Error: Data not accepted.'),
			'empty_message'        => Yii::t('YiiMailer','Message body empty'),
			'encoding'             => Yii::t('YiiMailer','Unknown encoding: '),
			'execute'              => Yii::t('YiiMailer','Could not execute: '),
			'file_access'          => Yii::t('YiiMailer','Could not access file: '),
			'file_open'            => Yii::t('YiiMailer','File Error: Could not open file: '),
			'from_failed'          => Yii::t('YiiMailer','The following From address failed: '),
			'instantiate'          => Yii::t('YiiMailer','Could not instantiate mail function.'),
			'invalid_address'      => Yii::t('YiiMailer','Invalid address'),
			'mailer_not_supported' => Yii::t('YiiMailer',' mailer is not supported.'),
			'provide_address'      => Yii::t('YiiMailer','You must provide at least one recipient email address.'),
			'recipients_failed'    => Yii::t('YiiMailer','SMTP Error: The following recipients failed: '),
			'signing'              => Yii::t('YiiMailer','Signing Error: '),
			'smtp_connect_failed'  => Yii::t('YiiMailer','SMTP Connect() failed.'),
			'smtp_error'           => Yii::t('YiiMailer','SMTP server error: '),
			'variable_set'         => Yii::t('YiiMailer','Cannot set or reset variable: ')
		),
	);
} // - end: if else
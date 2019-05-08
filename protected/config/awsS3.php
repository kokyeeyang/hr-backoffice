<?php
defined('AWS_VERSION') or define('AWS_VERSION', '2006-03-01');
defined('AWS_REGION') or define('AWS_REGION', 'ap-southeast-1'); // Asia Pacific (Singapore)

// To determine the environment mode
switch(ENV_MODE){
	case 'dev': // Development Mode
		defined('AWS_ACCESS_KEY_ID') or define('AWS_ACCESS_KEY_ID', 'xxxx');
		defined('AWS_SECRET_ACCESS_KEY') or define('AWS_SECRET_ACCESS_KEY', 'xxxx');
		defined('S3_BUCKET') or define('S3_BUCKET', 'hrbo-dev');
	break;

	case 'prod': // Production Mode
	default:
		defined('AWS_ACCESS_KEY_ID') or define('AWS_ACCESS_KEY_ID', 'xxxx');
		defined('AWS_SECRET_ACCESS_KEY') or define('AWS_SECRET_ACCESS_KEY', 'xxxx');
		defined('S3_BUCKET') or define('S3_BUCKET', 'hrbo-prod');
	break;
} // - end: switch

defined('S3_UPLOAD_FOLDER') or define('S3_UPLOAD_FOLDER', S3_BUCKET.'/upload');
<?php
// To determine the environment mode
switch(ENV_MODE){
	case 'dev': // Development Mode
		define('DB_HOST', 'hrbo.cluster-cqznxey9gyrd.ap-southeast-1.rds.amazonaws.com');
		define('DB_USERNAME', 'hr_bo_dev_user');
		define('DB_PASSWORD', 'a2ARM3c6kvm-X5$n');
		define('DB_NAME', 'hr_bo_dev');
		define('DB_CHARSET', 'utf8');
	break;

	case 'prod': // Production Mode
	default:
		define('DB_HOST', 'hrbo.cluster-cqznxey9gyrd.ap-southeast-1.rds.amazonaws.com');
		define('DB_USERNAME', 'hr_bo_prod_user');
		define('DB_PASSWORD', 'kztRdMNN7Ld$RB4b');
		define('DB_NAME', 'hr_bo_prod');
		define('DB_CHARSET', 'utf8');
	break;
} // - end: switch

define('DB_TBL_PREFIX', '');
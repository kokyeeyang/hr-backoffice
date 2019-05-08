<?php
// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.

// Start: Added by KC 2013-10-01
// Set up path variable to reflect the new directory structure
//   $WEBHOME/             -- $homePath
//   $WEBHOME/webroot/     -- $webrootPath
//   $WEBHOME/protected/   -- $protectedPath
//   $WEBHOME/runtime/     -- $runtimePath
		
$homePath      = realpath(dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..');
$protectedPath = $homePath . DIRECTORY_SEPARATOR . 'protected';
$webrootPath   = $homePath . DIRECTORY_SEPARATOR . 'webroot';
$runtimePath   = $homePath . DIRECTORY_SEPARATOR . 'runtime';
define('APP_LIB_PATH', $protectedPath. DIRECTORY_SEPARATOR .'vendor');
// End: Added by KC 2013-10-01

// Added by KC 2013-11-29
require_once($protectedPath . '/functions/Basiclib.php');
require_once($protectedPath . '/config/core.php');
require_once($protectedPath . '/config/db.php');
require_once($protectedPath . '/config/lang.php');
require_once($protectedPath . '/config/mail.php');
require_once($protectedPath . '/config/awsS3.php');
require_once($protectedPath . '/config/redis.php');
require_once($protectedPath . '/functions/Stdlib.php');
require_once($protectedPath . '/functions/Projectlib.php');

if(class_exists('CMap')){
	return CMap::mergeArray(
		require(dirname(__FILE__).'/env/'.ENV_API.'/master.php'), // Import the master configurations
		require(dirname(__FILE__).'/env/'.ENV_API.'/'.ENV_MODE.'.php') // Import the specific environment configurations
	);
} // - end: if
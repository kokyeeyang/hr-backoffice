<?php
exit; // By kc 2014-05-21, remove this line when it's ready for testing...

// change the following paths if necessary
require_once(dirname(__FILE__).'/../config/version.php');
$yiit=dirname(__FILE__).'/../../../../yii/'.YII_VERSION.'/framework/yiit.php';
//$config=dirname(__FILE__).'/../config/test.php';
$config=dirname(__FILE__).'/../config/main.php';

require_once($yiit);
require_once(dirname(__FILE__).'/WebTestCase.php');

Yii::createWebApplication($config);
<?php
// change the following paths if necessary
ini_set ("display_errors", true);
error_reporting(E_ALL);

require_once(dirname(__FILE__).'/../protected/config/version.php');
$yii=dirname(__FILE__).'/../yii/'.YII_VERSION.'/framework/yii.php';
$config=dirname(__FILE__).'/../protected/config/main.php';

require_once($yii);

Yii::createWebApplication($config)->run();
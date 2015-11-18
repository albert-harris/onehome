<?php
//error_reporting(0);
ob_start();
date_default_timezone_set('Asia/Singapore');
// change the following paths if necessary
define('DS', DIRECTORY_SEPARATOR);
define('PS', PATH_SEPARATOR);
define('ROOT', dirname(__FILE__));
define('YII_PROTECTED_DIR',  ROOT . DS . 'protected');
define('YII_THEMES_DIR',  ROOT . DS . 'themes');
define('YII_UPLOAD_DIR',  ROOT . DS . 'upload');
define('YII_UPLOAD_FOLDER', 'upload');

//$yii='yii-framework-1.1.15/yii.php';	// live
//$yii='../yii-framework-1.1.15/yii.php';	// test
$yii='../yii-1.1.15/yii.php';	// local
$config=dirname(__FILE__).'/protected/config/dev.php';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require(__DIR__ . '/vendor/autoload.php');	// register vendor autoload
require_once($yii);
Yii::createWebApplication($config);

SettingForm::applySettings();//override settings by values from database
Yii::app()->run();
<?php
defined('YII_DEBUG') or define('YII_DEBUG',true);

// including Yii
define('ROOT', dirname(__FILE__));
//$yii='yii-framework-1.1.15/yii.php'; // live
$yii='../yii-1.1.15/yii.php';	// local
require_once($yii);
require(__DIR__ . '/vendor/autoload.php');

// we'll use a separate config file
$config=dirname(__FILE__).'/protected/config/cron.php';

// creating and running console application
Yii::createConsoleApplication($config);
SettingForm::applySettings();//override settings by values from database
Yii::app()->run();

<?php
include_once 'config.local.php';

return array(
	'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
	'name' => 'Cron',
	'preload' => array('log'),
	'import' => array(
		'application.components.*',
		'application.models.*',
		'ext.yii-mail.YiiMailMessage',
		'application.cms.components.*',
	),
	'components' => array(
		'urlManager' => array(
			'urlFormat' => 'path',
			'rules' => array(
				'thank-you' => array('site/contactThankyou'),
				'our-team' => array('agent/index'),
				'agent/detail/<slug:[a-zA-Z0-9-]+>' => array('agent/view'),
				
				'opportunity_view_job/<slug:[a-zA-Z0-9-]+>' => array('site/view_job'),
				'<url:(admin|member)>' => '<url>/site/index',
				'member/<action:(myprofile|myshortlist|myprofileadmin)>' => 'member/member_profile/<action>',
				'login/<role:[a-zA-Z0-9-]+>' => array('site/login'),
				'forgot-password/<role:[a-zA-Z0-9-]+>' => array('site/forgot_password'),
				'member/<action:(myprofile|change_password)>' => 'member/profile/<action>',
				'salepersonlogin' => array('site/agentlogin'),
				'userlogin' => array('site/login'),
				'saleperson_forgot_password' => array('site/agent_forgot_password'),
				'address_listing/<slug:[a-zA-Z0-9-]+>' => array('site/addressListing'),
				'salesperson_listings/<slug:[a-zA-Z0-9-]+>' => array('site/salesperson_listing'),
				'listing-type/<listing_type:[a-zA-Z0-9-]+>' => array('site/index'),
				'gii' => 'gii',
				'gii/<controller:[\w\-]+>' => 'gii/<controller>',
				'gii/<controller:[\w\-]+>/<action:\w+>' => 'gii/<controller>/<action>',
				//listing
				'detail-<m:[a-zA-Z0-9-]+>/<slug:[a-zA-Z0-9-]+>/<type:[a-zA-Z0-9-]+>' => array('site/listingdetail'),
				'detail-<m:[a-zA-Z0-9-]+>/<slug:[a-zA-Z0-9-]+>' => array('site/listingdetail'),
				'detail/<slug:[a-zA-Z0-9-]+>/' => array('site/listingdetail'),
				'' => array('site/index'),
				'<action:[a-zA-Z0-9-_]+>' => 'site/<action>',
				'admin' => array('admin/site'),
				'page/<slug:[a-zA-Z0-9-]+>/' => array('page/index'), // Feb 10, 2015 ANH DUNG FIX FOR PAGING
				'admin/<action:(login|logout|error|changePassword)>' => 'admin/site/<action>',
				'<controller:\w+>/<id:\d+>' => '<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
				'<controller:\w+>/<action:\w+>' => '<controller>/<action>',
				'<url:(admin|member)>' => '<url>/site/',
			),
			'showScriptName' => false,
		),
		'log' => array(
			'class' => 'CLogRouter',
			'routes' => array(
				array(
					'class' => 'CFileLogRoute',
					'logFile' => 'cron.log',
					'levels' => 'error, warning',
				),
				array(
					'class' => 'CFileLogRoute',
					'logFile' => 'cron_trace.log',
					'levels' => 'trace',
				),
			),
		),
		'db' => array(
			'connectionString' => "mysql:host=$MYSQL_HOSTNAME;dbname=$MYSQL_DATABASE",
			'emulatePrepare' => true,
			'username' => $MYSQL_USERNAME,
			'password' => $MYSQL_PASSWORD,
			'tablePrefix' => $TABLE_PREFIX,
			'charset' => 'utf8',
			'enableProfiling' => true,
			'enableParamLogging' => true,
		),
		'mail' => array(
			'class' => 'application.extensions.yii-mail.YiiMail',
			'transportType' => 'smtp', /// case sensitive!
			'transportOptions' => array(
				'host' => 'smtp.gmail.com',
				'username' => 'dungverz@gmail.com',
				'password' => 'dung!@#123',
				'port' => '465',
				'encryption' => 'ssl',
				'timeout' => '120',
			),
			'viewPath' => 'application.mail',
			'logging' => true,
			'dryRun' => false
		),
		'request' => array(
			'hostInfo' => 'http://www.onehome.sg',
			'baseUrl' => '',
			'scriptUrl' => '',
		),
		'setting' => array(
			'class' => 'application.extensions.MyConfig.MyConfig',
			'cacheId' => null,
			'useCache' => false,
			'cacheTime' => 0,
			'tableName' => $TABLE_PREFIX . '_settings',
			'createTable' => false,
			'loadDbItems' => true,
			'serializeValues' => true,
			'configFile' => '',
		),
	),
);

<?php

include_once 'config.local.php';

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.

Yii::setPathOfAlias('bootstrap', dirname(__FILE__) . '/../extensions/bootstrap');

return array(
	'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
	'name' => $THEME_NAME,
	'theme' => $THEME,
	'language' => 'en',
	// preloading 'log' component
	'preload' => array('log', 'ELangHandler'),
	// autoloading model and component classes
	'import' => array(
		'application.models.*',
		'application.components.*',
		'application.extensions.yii-mail.*',
		'application.extensions.phpexcel.*',
		'application.extensions.phpexcel.PHPExcel.*',
		'application.extensions.EUploadedImage.*',
		'application.extensions.jmultiselect2side.*',
		'application.extensions.EPhpThumb.*',
		'application.extensions.MyDebug.*',
		'application.extensions.editMe.*',
		'application.extensions.ControllerActionsName.*',
		'application.modules.auditTrail.models.AuditTrail',
		'application.extensions.toSlug.*',
	),
	'aliases' => array(
		'xupload' => 'ext.xupload'
	),
	'modules' => array(
		'gii' => array(
			'class' => 'system.gii.GiiModule',
			'password' => false,
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters' => array('127.0.0.1', '::1'),
			'generatorPaths' => array(
				'application.gii', // a path alias
				'bootstrap.gii',
			),
		),
		'admin',
		'member',
		'product',
		'auditTrail' => array(
			'userClass' => 'Users', // the class name for the user object
			'userIdColumn' => 'id', // the column name of the primary key for the user
			'userNameColumn' => 'username', // the column name of the primary key for the user
		),
		'api' => array(
			'connectionString' => 'mysql:host=localhost;port=3306;dbname=proper47_maindb',
			'server' => 'localhost',
			'database' => 'proper47_maindb',
			'username' => 'root',
			'password' => '',
		),
	),
	// application components
	'components' => array(
		// 'apns' => array(
  //                           'class' => 'ext.apns-gcm.YiiApns',
  //                           'environment' => 'production',
  //                           'pemFile' => dirname(__FILE__).'/apnssert/ck.pem',
  //                           'dryRun' => false, // setting true will just do nothing when sending push notification
  //                           // 'retryTimes' => 3,
  //                           'options' => array(
  //                               'sendRetryTimes' => 5
  //                           ),
  //                       ),
  //                       'gcm' => array(
  //                           'class' => 'ext.apns-gcm.YiiGcm',
  //                           'apiKey' => 'AIzaSyDL2j1yuCyj62CurSulAfTDslxSoXdGWMM'
  //                       ),
  //                       // using both gcm and apns, make sure you have 'gcm' and 'apns' in your component
  //                       'apnsGcm' => array(
  //                           'class' => 'ext.apns-gcm.YiiApnsGcm',
  //                           // custom name for the component, by default we will use 'gcm' and 'apns'
  //                           //'gcm' => 'gcm',
  //                           //'apns' => 'apns',
  //                       ),
		'session' => array(
			'class' => 'CDbHttpSession',
			'timeout' => 86400,
		),
		'user' => array(
			// enable cookie-based authentication
			'allowAutoLogin' => true,
			'class' => 'WebUser',
			'loginUrl' => array('/admin/site/login'),
		),
		'urlManager' => array(
			'showScriptName' => false,
			'urlFormat' => 'path',
			'rules' => array(
				/* our service module */
				'our-services/<slug:[a-zA-Z0-9-]+>' => array('site/ourServices'),
				'our-services' => array('site/ourServices'),
				
				/* our team module */
				'our-team' => array('agent/index'),
				'agent/detail/<slug:[a-zA-Z0-9-]+>' => array('agent/view'),
				
				'thank-you' => array('site/contactThankyou'),
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
				'<url:(admin|member)>' => '<url>/site/',
				'<controller:\w+>/<id:\d+>' => '<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
				'<controller:\w+>/<action:\w+>' => '<controller>/<action>',
			),
		),
		'db' => array(
			'connectionString' => "mysql:host=localhost;dbname=proper47_maindb",
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'tablePrefix' => $TABLE_PREFIX,
			'charset' => 'utf8',
			'enableProfiling' => true,
			'enableParamLogging' => true,
		),
		'authManager' => array(
			'class' => 'CDbAuthManager',
			'connectionID' => 'db',
		),
		'errorHandler' => array(
			// use 'site/error' action to display errors
			'errorAction' => 'site/error',
		),
		'log' => array(
			'class' => 'CLogRouter',
			'routes' => array(
				array(
					'class' => 'CFileLogRoute',
				//'levels'=>'error, warning',
				),
				array(
					'class' => 'DbLogRoute',
					'connectionID' => 'db',
					'autoCreateLogTable' => false,
					'logTableName' => $TABLE_PREFIX . "_logger",
					'levels' => 'info, error'
				),
				array(
					'class' => 'ext.yii-debug-toolbar.YiiDebugToolbarRoute',
					'ipFilters' => array(isset($_COOKIE['debug']) ? '127.0.0.1' : '0.0.0.0'),
				),
			),
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
		'format' => array(
			'class' => 'CmsFormatter',
		),
		'ELangHandler' => array(
			'class' => 'application.extensions.langhandler.ELangHandler',
			'languages' => array('en', 'cn'),
			'strict' => true,
		),
		'events' => array(
			'class' => 'CmsEventList'
		),
		'widgetFactory' => array(
			'widgets' => array(
				'CGridView' => array(
				),
			),
		),
		'bootstrap' => array(
			'class' => 'bootstrap.components.Bootstrap',
		),
	),
	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params' => array(
		'forumUrl' => 'http://www.onehome.sg/demo/forum',
		'fb_app_id' => '899878636775910',
		'fb_app_serect' => 'd6375f5305c35f858ada5ae212f6e3ec',
		'ckeditor_editMe' => array(
			array('Source'),
			array('Bold', 'Italic', 'Underline'),
			'/',
			array('NumberedList', 'BulletedList', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'),
			array('Link', 'Unlink', 'Image'),
			array('Styles', 'Format', 'Font', 'FontSize'),
			array('TextColor', 'BGColor'),
		),
		'ckeditor' => array(
			array("name" => 'document', "items" => array('Source')),
			array("name" => 'clipboard', "items" => array('Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo')),
			'/',
			array("name" => 'basicstyles', "items" => array('Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat')),
			array("name" => 'paragraph', "items" => array('NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock')),
			array("name" => 'links', "items" => array('Link', 'Unlink')),
			array("name" => 'insert', "items" => array('Image', 'Table', 'HorizontalRule')),
			'/',
			array("name" => 'styles', "items" => array('Styles', 'Format', 'Font', 'FontSize')),
			array("name" => 'colors', "items" => array('TextColor', 'BGColor')),
		),
		'ckeditor_simple' => array(
			array("name" => 'clipboard', "items" => array('Source', 'Undo', 'Redo')),
			array("name" => 'basicstyles', "items" => array('Bold', 'Italic')),
		),
		'ckeditor_setting' => array(
			array("name" => 'clipboard', "items" => array('Source', 'Undo', 'Redo')),
			array("name" => 'basicstyles', "items" => array('Bold', 'Italic')),
		),
		'niceditor' => array('bold', 'italic', 'underline', 'ol', 'ul'),
		'niceditoradv' => array('bold', 'italic', 'underline', 'ol', 'ul', 'link', 'unlink', 'forecolor', 'bgcolor'),
		'niceditor_v_1' => array('bold', 'italic', 'underline', 'ol', 'ul', 'fontSize', 'left', 'center', 'right', 'justify', 'forecolor', 'bgcolor', 'image', 'upload', 'link', 'unlink', 'xhtml'),
		'niceditor_v_2' => array('bold', 'italic', 'underline', 'ul'),
		'niceditor_v_3' => array('bold', 'italic', 'underline', 'ol', 'ul', 'link', 'unlink'),
		'adminEmail' => 'webmaster@example.com',
		'autoEmail' => 'auto_mailer@starlets22.com',
		'dateFormat' => 'd-M-Y',
		'timeFormat' => 'H:i:s',
		'is_paypal_sandbox' => 1,
		'paypal_email_address' => 'seller@verzdesign.com',
		'paypal_currency' => 'USD',
		'paypalURL' => 'https://www.paypal.com/cgi-bin/webscr',
		'paypalURL_sandbox' => 'https://www.sandbox.paypal.com/cgi-bin/webscr',
		'image_watermark' => 'bg_13394962316443.gif',
		'defaultPageSize' => 20,
		'twitter' => '',
		'facebook' => '',
		'linkedin' => '',
		'rss' => '',
		'meta_description' => '',
		'meta_keywords' => '',
		'reCaptcha' => array(
			'publicKey' => '6Lfmj9ASAAAAAM2b4ePzdByLBIrX6bSU32ZnLgIR',
			'privateKey' => '6Lfmj9ASAAAAAAiZVwboS55FW1sKY1QWm-lGEEAV',
		),
	),
);

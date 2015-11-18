<?php
return CMap::mergeArray(require(dirname(__FILE__).'/main.php'), array(
	'components'=>array(
		'db'=>array(
			'connectionString' => "mysql:host=localhost;dbname=proper47_maindb",
			'username' => 'root',
			'password' => '',
		),
	),
	'params' => array(
		'forumUrl' => 'http://localhost/forum',
	),
));
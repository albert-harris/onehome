<?php
return CMap::mergeArray(require(dirname(__FILE__).'/main.php'), array(
	'components'=>array(
		'db'=>array(
			'connectionString' => "mysql:host=localhost;dbname=proper47_maindb",
			'username' => 'proper47_maindb',
			'password' => '6F&irFz??*-n',
		),
	),
	'params' => array(
		'forumUrl' => 'http://www.onehome.sg/forum',
	),
));
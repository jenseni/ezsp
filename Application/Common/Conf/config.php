<?php
return array(
	'MODULE_ALLOW_LIST'	=>	array('Home', 'Phone', 'Admin'),
	'MODULE_DENY_LIST'	=>	array('Common','Runtime'),
	'DEFAULT_MODULE'	=>	'Home',
	'URL_MODEL'	=>	2,

	'DB_TYPE'	=>	'mysql',
	'DB_HOST'	=>	'localhost',
	'DB_NAME'	=>	'wxestate2',
	'DB_USER'	=>	'root',
	'DB_PWD'	=>	'',
	'DB_PORT'	=>	3306,
	'DB_PREFIX'	=>	't_',
	'DB_PARAMS'	=>	array(
		'persist'	=>	true
	),

	'STATIC_PAGE_PATH'	=>	'./Uploads/static'
);
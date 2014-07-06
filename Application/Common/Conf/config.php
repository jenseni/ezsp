<?php
return array(
	'MODULE_ALLOW_LIST'	=>	array('Home', 'Phone', 'Weixin', 'Admin'),
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

	'STATIC_PAGE_PATH'	=>	'./Uploads/static',
	'CRYPT_KEY'	=> 'c58e9b858d85030ed2b5215255019f1f',

	'SERVER_IP'	=>	'60.20.131.210',
	'WEIXIN_ACCOUNT'	=>	'gh_3d57520728f8',
	'WEIXIN_APPID'	=>	'wxcc74c0f42a8449d4',
	'WEIXIN_APPSECRET'	=>	'21276e9b54bd9083a5f2f25b54f0f9cf',
	'WEIXIN_VALID_TOKEN'	=>	'wanghetest'
);


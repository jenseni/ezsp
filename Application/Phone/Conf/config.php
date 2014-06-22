<?php
return array(
	'TMPL_PARSE_STRING' => array(
		'__STATIC__' => __ROOT__ . '/Public/static',
		'__ADDONS__' => __ROOT__ . '/Public/' . MODULE_NAME . '/Addons',
		'__IMG__'    => __ROOT__ . '/Public/' . MODULE_NAME . '/images',
		'__CSS__'    => __ROOT__ . '/Public/' . MODULE_NAME . '/css',
		'__JS__'     => __ROOT__ . '/Public/' . MODULE_NAME . '/js',
	),

	'SYS_MENU'	=>	array(
		array(
			'id'	=>	1,
			'name'	=>	'房屋买卖',
			'url'	=>	'HouseSale/index'
		),
		array(
			'id'	=>	2,
			'name'	=>	'房屋租赁',
			'url'	=>	'HouseRent/index'
		),
		array(
			'id'	=>	3,
			'name'	=>	'写字楼商铺',
			'url'	=>	'OfficeMarket/index'
		),
		array(
			'id'	=>	4,
			'name'	=>	'代理楼盘',
			'url'	=>	'AgentMarket/index'
		)
	)
);
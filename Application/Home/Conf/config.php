<?php
return array(
	//'配置项'=>'配置值'
	/* 模板相关配置 */
    'TMPL_PARSE_STRING' => array(
        '__STATIC__' => __ROOT__ . '/Public/static',
        '__ADDONS__' => __ROOT__ . '/Public/' . MODULE_NAME . '/Addons',
        '__IMG__'    => __ROOT__ . '/Public/' . MODULE_NAME . '/images',
        '__CSS__'    => __ROOT__ . '/Public/' . MODULE_NAME . '/css',
        '__JS__'     => __ROOT__ . '/Public/' . MODULE_NAME . '/js',
    ),

    'SYS_MENU'	=> array(
		array(
			'id'	=>	1,
			'name'	=>	'首页',
			'url'	=>	'Index'
		),
		array(
			'id'	=>	2,
			'name'	=>	'公司简介',
			'url'	=>	'Article/index'
		),
		array(
			'id'	=>	3,
			'name'	=>	'房屋买卖',
			'url'	=>	'#'
		),
		array(
			'id'	=>	4,
			'name'	=>	'房屋租赁',
			'url' 	=>	'#'
		),
		array(
			'id'	=>	5,
			'name'	=>	'短期租房',
			'url'	=>	'#'
		),
		array(
			'id'	=>	6,
			'name'	=>	'写字楼商铺',
			'url'	=>	'#'
		),
		array(
			'id'	=>	7,
			'name'	=>	'代理楼盘',
			'url'	=>	'#'
		),
		array(
			'id'	=>	8,
			'name'	=>	'房产动态',
			'url'	=>	'HouseNews/index'
		),
		array(
			'id'	=>	9,
			'name'	=>	'优惠活动',
			'url'	=>	'Activity/index'
		)
	),
);
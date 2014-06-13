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

    'WEB_SITE_TITLE'	=>	'恒润房产',
    'WEB_SITE_KEYWORD'	=>	'大连租房,大连二手房,大连楼盘,大连短租',
    'WEB_SITE_DESCRIPTION'	=>	'恒润房产,大连房屋信息',

    'SYS_MENU'	=> array(
		array(
			'id'	=>	1,
			'name'	=>	'首页',
			'url'	=>	'Index/index'
		),
		array(
			'id'	=>	2,
			'name'	=>	'公司简介',
			'url'	=>	'Company/index'
		),
		array(
			'id'	=>	3,
			'name'	=>	'房屋买卖',
			'url'	=>	'HouseSale/index'
		),
		array(
			'id'	=>	4,
			'name'	=>	'房屋租赁',
			'url' 	=>	'HouseRent/index'
		),
		array(
			'id'	=>	5,
			'name'	=>	'短期租房',
			'url'	=>	'ShortRent/lists'
		),
		array(
			'id'	=>	6,
			'name'	=>	'写字楼商铺',
			'url'	=>	'OfficeMarket/lists'
		),
		array(
			'id'	=>	7,
			'name'	=>	'代理楼盘',
			'url'	=>	'AgentMarket/index'
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
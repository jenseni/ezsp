<?php

return array(
	'URL_HTML_SUFFIX'	=>	'',

	'TMPL_PARSE_STRING' => array(
		'__STATIC__' => __ROOT__ . '/Public/static',
		'__IMG__'    => __ROOT__ . '/Public/' . MODULE_NAME . '/images',
		'__CSS__'    => __ROOT__ . '/Public/' . MODULE_NAME . '/css',
		'__JS__'     => __ROOT__ . '/Public/' . MODULE_NAME . '/js'
	),

	/**
	 * id > 10000的默认放开
	 */
	'SYS_MENU'	=> array(
		array(
			'id'	=>	10001,
			'name'	=>	'首页',
			'action'	=>	'Index/index',
			'icon'	=> 'glyphicon glyphicon-globe'
		),
		array(
			'id'	=>	2,
			'name'	=>	'公司介绍',
			'action'	=>	'#',
			'icon'	=> 'glyphicon glyphicon-pencil'
		),
		array(
			'id'	=>	3,
			'name'	=>	'房屋买卖',
			'action'	=>	'#',
			'icon'	=> 'glyphicon glyphicon-home'
		),
		array(
			'id'	=>	4,
			'name'	=>	'房屋租赁',
			'action'	=>	'#',
			'icon'	=> 'glyphicon glyphicon-home'
		),
		array(
			'id'	=>	5,
			'name'	=>	'短期租房',
			'action'	=>	'#',
			'icon'	=> 'glyphicon glyphicon-home'
		),
		array(
			'id'	=>	6,
			'name'	=>	'写字楼商铺',
			'action'	=>	'#',
			'icon'	=> 'glyphicon glyphicon-home'
		),
		array(
			'id'	=>	7,
			'name'	=>	'代理楼盘',
			'action'	=>	'#',
			'icon'	=> 'glyphicon glyphicon-home'
		),
		array(
			'id'	=>	8,
			'name'	=>	'信息发布',
			'action'	=>	'#',
			'icon'	=> 'glyphicon glyphicon-comment'
		),
		array(
			'id'	=>	9,
			'name'	=>	'房产动态',
			'action'	=>	'#',
			'icon'	=> 'glyphicon glyphicon-eye-open'
		),
		array(
			'id'	=>	10,
			'name'	=>	'优惠活动',
			'action'	=>	'#',
			'icon'	=> 'glyphicon glyphicon-fire'
		),
		array(
			'id'	=>	11,
			'name'	=>	'用户管理',
			'action'	=>	'#',
			'icon'	=> 'glyphicon glyphicon-user'
		),
		array(
			'id'	=>	12,
			'name'	=>	'权限管理',
			'action'	=>	'#',
			'icon'	=> 'glyphicon glyphicon-hand-right',
			'children'	=>	array(
				array(
					'id'	=>	100,
					'name'	=>	'管理员信息',
					'action'	=>	'User/lists'
				)
			)
		),
		array(
			'id'	=>	13,
			'name'	=>	'咨询留言',
			'action'	=>	'#',
			'icon'	=> 'glyphicon glyphicon-comment'
		),
		array(
			'id'	=>	14,
			'name'	=>	'积分派发',
			'action'	=>	'#',
			'icon'	=> 'glyphicon glyphicon-heart'
		)
	)
);
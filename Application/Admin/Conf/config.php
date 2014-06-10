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
			'action'	=>	'#',
			'icon'	=> 'glyphicon glyphicon-globe',
			'children'	=>	array(
				array(
					'id'	=>	101,
					'name'	=>	'首页',
					'action'	=>	'Index/index',
					'icon'	=>	'glyphicon glyphicon-globe'
				)
			)
		),
		array(
			'id'	=>	2,
			'name'	=>	'公司介绍',
			'action'	=>	'#',
			'icon'	=> 'glyphicon glyphicon-pencil',
			'children'	=>	array(
				array(
					'id'	=>	104,
					'name'	=>	'编辑',
					'action'	=>	'Company/edit',
					'icon'	=>	'glyphicon glyphicon-edit'
				)
			)
		),
		array(
			'id'	=>	3,
			'name'	=>	'房屋买卖',
			'action'	=>	'#',
			'icon'	=> 'glyphicon glyphicon-home',
			'children'	=>	array(
				array(
					'id'	=>	102,
					'name'	=>	'发布信息',
					'action'	=>	'HouseSale/add',
					'icon'	=>	'glyphicon glyphicon-edit'
				),
				array(
					'id'	=>	103,
					'name'	=>	'房屋买卖管理',
					'action'	=>	'HouseSale/lists',
					'icon'	=>	'glyphicon glyphicon-wrench'
				)
			)
		),
		array(
			'id'	=>	4,
			'name'	=>	'房屋租赁',
			'action'	=>	'#',
			'icon'	=> 'glyphicon glyphicon-home',
			'children'	=>	array(
				array(
					'id'	=>	105,
					'name'	=>	'房屋租赁发布',
					'action'	=>	'Article/edit',
					'icon'	=>	'glyphicon glyphicon-edit'
				),
				array(
					'id'	=>	106,
					'name'	=>	'房屋租赁管理',
					'action'	=>	'Article/edit',
					'icon'	=> 'glyphicon glyphicon-wrench'
				)
			)
		),
		array(
			'id'	=>	5,
			'name'	=>	'短期租房',
			'action'	=>	'#',
			'icon'	=> 'glyphicon glyphicon-home',
			'children'	=>	array(
				array(
					'id'	=>	107,
					'name'	=>	'短期租房发布',
					'action'	=>	'Article/edit',
					'icon'	=>	'glyphicon glyphicon-edit'
				),
				array(
					'id'	=>	108,
					'name'	=>	'短期租房管理',
					'action'	=>	'Article/edit',
					'icon'	=> 'glyphicon glyphicon-wrench'
				)
			)
		),
		array(
			'id'	=>	6,
			'name'	=>	'写字楼商铺',
			'action'	=>	'#',
			'icon'	=> 'glyphicon glyphicon-home',
			'children'	=>	array(
				array(
					'id'	=>	109,
					'name'	=>	'写字楼商铺发布',
					'action'	=>	'Article/edit',
					'icon'	=>	'glyphicon glyphicon-edit'
				),
				array(
					'id'	=>	110,
					'name'	=>	'写字楼商铺管理',
					'action'	=>	'Article/edit',
					'icon'	=> 'glyphicon glyphicon-wrench'
				)
			)
		),
		array(
			'id'	=>	7,
			'name'	=>	'代理楼盘',
			'action'	=>	'#',
			'icon'	=> 'glyphicon glyphicon-home',
			'children'	=>	array(
				array(
					'id'	=>	111,
					'name'	=>	'代理楼盘编辑',
					'action'	=>	'Article/edit',
					'icon'	=>	'glyphicon glyphicon-edit'
				)
			)
		),
		array(
			'id'	=>	8,
			'name'	=>	'信息发布',
			'action'	=>	'#',
			'icon'	=> 'glyphicon glyphicon-comment',
			'children'	=>	array(
				array(
					'id'	=>	112,
					'name'	=>	'信息发布管理',
					'action'	=>	'Article/edit',
					'icon'	=>	'glyphicon glyphicon-edit'
				)
			)
		),
		array(
			'id'	=>	9,
			'name'	=>	'房产动态',
			'action'	=>	'#',
			'icon'	=> 'glyphicon glyphicon-eye-open',
			'children'	=>	array(
				array(
					'id'	=>	113,
					'name'	=>	'房产动态发布',
					'action'	=>	'Article/edit',
					'icon'	=>	'glyphicon glyphicon-edit'
				),
				array(
					'id'	=>	114,
					'name'	=>	'房产动态管理',
					'action'	=>	'Article/edit',
					'icon'	=> 'glyphicon glyphicon-wrench'
				)
			)
		),
		array(
			'id'	=>	10,
			'name'	=>	'优惠活动',
			'action'	=>	'#',
			'icon'	=> 'glyphicon glyphicon-fire',
			'children'	=>	array(
				array(
					'id'	=>	115,
					'name'	=>	'房产动态发布',
					'action'	=>	'Article/edit',
					'icon'	=>	'glyphicon glyphicon-edit'
				),
				array(
					'id'	=>	116,
					'name'	=>	'房产动态管理',
					'action'	=>	'Article/edit',
					'icon'	=> 'glyphicon glyphicon-wrench'
				)
			)
		),
		array(
			'id'	=>	11,
			'name'	=>	'用户管理',
			'action'	=>	'#',
			'icon'	=> 'glyphicon glyphicon-user',
			'children'	=>	array(
				array(
					'id'	=>	117,
					'name'	=>	'用户管理',
					'action'	=>	'Article/edit',
					'icon'	=>	'glyphicon glyphicon-edit'
				)
			)
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
					'action'	=>	'User/lists',
					'icon'	=>	'glyphicon glyphicon-user'
				)
			)
		),
		array(
			'id'	=>	13,
			'name'	=>	'咨询留言',
			'action'	=>	'#',
			'icon'	=> 'glyphicon glyphicon-comment',
			'children'	=>	array(
				array(
					'id'	=>	119,
					'name'	=>	'咨询留言管理',
					'action'	=>	'User/lists',
					'icon'	=>	'glyphicon glyphicon-wrench'
				)
			)
		),
		array(
			'id'	=>	14,
			'name'	=>	'积分派发',
			'action'	=>	'#',
			'icon'	=> 'glyphicon glyphicon-heart',
			'children'	=>	array(
				array(
					'id'	=>	120,
					'name'	=>	'积分管理',
					'action'	=>	'User/lists',
					'icon'	=>	'glyphicon glyphicon-wrench'
				)
			)
		)
	)
);
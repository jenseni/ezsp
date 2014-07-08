DROP TABLE IF EXISTS `t_admin_user`;
CREATE TABLE `t_admin_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL COMMENT '用户名',
  `password` char(32) NOT NULL COMMENT '密码',
  `auth` varchar(255) DEFAULT NULL COMMENT '权限配置',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_admin_user_username` (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `t_lookup`;
CREATE TABLE `t_lookup` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `type` VARCHAR(32) NOT NULL,
  `name` VARCHAR(32) NOT NULL,
  `val` VARCHAR(32) NOT NULL,
  `inactive` CHAR(1) NOT NULL DEFAULT 'N',
  `seq_num` INT(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MYISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `t_district`;
CREATE TABLE `t_district` (
   `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
   `pid` INT(10) UNSIGNED NOT NULL,
   `name` VARCHAR(64) NOT NULL,
   `type` TINYINT(4) NOT NULL DEFAULT '0',
   `code` CHAR(6) DEFAULT NULL,
   `inactive` CHAR(1) NOT NULL DEFAULT 'N',
   PRIMARY KEY (`id`),
   KEY `idx_district_pid` (`pid`)
 ) ENGINE=MYISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `t_category`;
CREATE TABLE `t_category` (
   `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '分类ID',
   `name` VARCHAR(30) NOT NULL COMMENT '标志',
   `title` VARCHAR(50) NOT NULL COMMENT '标题',
   `seq_num` INT(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '排序（同级有效）',
   `list_row` TINYINT(3) UNSIGNED NOT NULL DEFAULT '10' COMMENT '列表每页行数',
   `status` TINYINT(4) NOT NULL DEFAULT '0' COMMENT '数据状态',
   PRIMARY KEY (`id`),
   UNIQUE KEY `uk_name` (`name`)
 ) ENGINE=MYISAM DEFAULT CHARSET=utf8 COMMENT='分类表';

DROP TABLE IF EXISTS `t_picture`;
CREATE TABLE `t_picture` (
   `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id自增',
   `path` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '路径',
   `url` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '图片链接',
   `md5` CHAR(32) NOT NULL DEFAULT '' COMMENT '文件md5',
   `sha1` CHAR(40) NOT NULL DEFAULT '' COMMENT '文件 sha1编码',
   `status` TINYINT(2) NOT NULL DEFAULT '0' COMMENT '状态',
   `create_time` INT(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建时间',
   `type` TINYINT(4) NOT NULL DEFAULT '0',
   `pid` INT(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '所属实体ID',
   PRIMARY KEY (`id`)
 ) ENGINE=MYISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `t_article`;
CREATE TABLE `t_article` (
   `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '文档ID',
   `title` char(80) NOT NULL DEFAULT '' COMMENT '标题',
   `category_id` INT(10) NOT NULL COMMENT '分类标示',
   `uid` INT(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '用户ID',
   `description` CHAR(140) NOT NULL DEFAULT '' COMMENT '描述',
   `content` TEXT NOT NULL COMMENT '文章内容',
   `level` INT(10) NOT NULL DEFAULT '0' COMMENT '优先级',
   `create_time` INT(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建时间',
   `update_time` INT(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '更新时间',
   `status` TINYINT(4) NOT NULL DEFAULT '0' COMMENT '数据状态',
   `cover_url` varchar(255) NULL COMMENT '封面图片链接',
   PRIMARY KEY (`id`)
 ) ENGINE=MYISAM DEFAULT CHARSET=utf8 COMMENT='文档模型文章表';

DROP TABLE IF EXISTS `t_houserent`;
CREATE TABLE `t_houserent` (
   `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
   `title` char(80) NOT NULL DEFAULT '' COMMENT '标题',
   `uid` INT(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '用户ID',
   `level` INT(10) NOT NULL DEFAULT '0' COMMENT '优先级',
   `create_time` INT(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建时间',
   `status` TINYINT(4) NOT NULL DEFAULT '0' COMMENT '数据状态',
   `community` VARCHAR(128) NOT NULL COMMENT '小区',
   `city` INT(10) UNSIGNED NOT NULL COMMENT '城市',
   `area` INT(10) UNSIGNED NOT NULL COMMENT '区域',
   `busi_area` INT(10) UNSIGNED NOT NULL COMMENT '商区',
   `bed_room` TINYINT(4) NOT NULL COMMENT '室',
   `live_room` TINYINT(4) NOT NULL COMMENT '厅',
   `toilet` TINYINT(4) NOT NULL COMMENT '卫',
   `floor` TINYINT(4) NOT NULL COMMENT '楼层',
   `floor_max` TINYINT(4) NOT NULL COMMENT '楼层（共）',
   `contact` VARCHAR(32) NOT NULL COMMENT '联系人',
   `contact_tel` VARCHAR(11) NOT NULL COMMENT '联系电话',
   `longitude` DOUBLE DEFAULT NULL COMMENT '纬度',
   `latitude` DOUBLE DEFAULT NULL COMMENT '经度',
   `decorate` TINYINT(4) DEFAULT NULL COMMENT '装修',
   `face` TINYINT(4) DEFAULT NULL COMMENT '朝向',
   `add_on` VARCHAR(255) DEFAULT NULL COMMENT '配套设施',
   `feature` VARCHAR(255) DEFAULT NULL COMMENT '特色',
   `thumbnail` VARCHAR(255) DEFAULT NULL COMMENT '缩略图',
   `price` INT(11) NOT NULL COMMENT '价格',
   `deposit_type` TINYINT(4) NOT NULL COMMENT '押金类型',
   `square` INT(11) NOT NULL COMMENT '面积',
   `desc_txt` TEXT COMMENT '描述信息',
   PRIMARY KEY (`id`)
 ) ENGINE=MYISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `t_housesale`;
CREATE TABLE `t_housesale` (
   `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
   `title` char(80) NOT NULL DEFAULT '' COMMENT '标题',
   `uid` INT(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '用户ID',
   `level` INT(10) NOT NULL DEFAULT '0' COMMENT '优先级',
   `share_path` CHAR(1) NOT NULL DEFAULT 'N' COMMENT '记录分享路径',
   `create_time` INT(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建时间',
   `status` TINYINT(4) NOT NULL DEFAULT '0' COMMENT '数据状态',
   `community` varchar(128) NOT NULL COMMENT '小区',
   `city` int(10) unsigned NOT NULL COMMENT '城市',
   `area` int(10) unsigned NOT NULL COMMENT '区域',
   `busi_area` int(10) unsigned NOT NULL COMMENT '商区',
   `bed_room` tinyint(4) NOT NULL COMMENT '室',
   `live_room` tinyint(4) NOT NULL COMMENT '厅',
   `toilet` tinyint(4) NOT NULL COMMENT '卫',
   `floor` tinyint(4) NOT NULL COMMENT '楼层',
   `floor_max` tinyint(4) NOT NULL COMMENT '楼层（共）',
   `contact` varchar(32) NOT NULL COMMENT '联系人',
   `contact_tel` varchar(11) NOT NULL COMMENT '联系电话',
   `longitude` double DEFAULT NULL COMMENT '纬度',
   `latitude` double DEFAULT NULL COMMENT '经度',
   `build_type` tinyint(4) DEFAULT NULL COMMENT '建筑类型',
   `structure` tinyint(4) DEFAULT NULL COMMENT '建筑结构',
   `decorate` tinyint(4) DEFAULT NULL COMMENT '装修',
   `face` tinyint(4) DEFAULT NULL COMMENT '朝向',
   `add_on` varchar(255) DEFAULT NULL COMMENT '配套设施',
   `feature` varchar(255) DEFAULT NULL COMMENT '特色',
   `thumbnail` varchar(255) DEFAULT NULL COMMENT '缩略图',
   `price` int(11) NOT NULL COMMENT '价格',
   `square` int(11) NOT NULL COMMENT '建筑面积',
   `inner_square` int(11) NOT NULL COMMENT '套内面积',
   `down_payment` int(11) DEFAULT NULL COMMENT '首付',
   `monthly` int(11) DEFAULT NULL COMMENT '月供',
   `property_right` tinyint(4) DEFAULT NULL COMMENT '产权',
   `property_type` tinyint(4) DEFAULT NULL COMMENT '产权类型',
   `build_year` int(11) DEFAULT NULL COMMENT '建筑年代',
   `desc_txt` text COMMENT '描述信息',
   PRIMARY KEY (`id`)
 ) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `t_officemarket`;
CREATE TABLE `t_officemarket` (
   `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
   `title` char(80) NOT NULL DEFAULT '' COMMENT '标题',
   `uid` INT(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '用户ID',
   `description` CHAR(140) NOT NULL DEFAULT '' COMMENT '描述',
   `level` INT(10) NOT NULL DEFAULT '0' COMMENT '优先级',
   `create_time` INT(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建时间',
   `update_time` INT(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '更新时间',
   `status` TINYINT(4) NOT NULL DEFAULT '0' COMMENT '数据状态',
   `sd_type` TINYINT(4) NOT NULL DEFAULT '1' COMMENT '供求',
   `real_estate` VARCHAR(64) DEFAULT NULL,
   `city` INT(11) NOT NULL,
   `area` INT(11) NOT NULL,
   `busi_area` INT(11) NOT NULL,
   `area_sector` VARCHAR(32) NOT NULL,
   `area_sector_nearby` VARCHAR(32) NOT NULL,
   `longitude` double DEFAULT NULL COMMENT '纬度',
   `latitude` double DEFAULT NULL COMMENT '经度',
   `bd_type` TINYINT(4) NOT NULL DEFAULT '1' COMMENT '类型',
   `comp_register` CHAR(1) NOT NULL DEFAULT 'N',
   `square` INT(10) UNSIGNED NOT NULL COMMENT '面积',
   `price` INT(11) NOT NULL,
   `desc_txt` TEXT NOT NULL COMMENT '描述',
   `contact_tel` VARCHAR(11) NOT NULL COMMENT '联系人',
   `contact` VARCHAR(32) NOT NULL,
   `contact_type` TINYINT(4) NOT NULL,
   `price_max` INT(10) UNSIGNED DEFAULT NULL COMMENT '到',
   `square_max` INT(10) UNSIGNED DEFAULT NULL COMMENT '到',
   `price_unit` TINYINT(4) NOT NULL,
   `thumbnail` VARCHAR(128) DEFAULT NULL COMMENT '缩略图',
   PRIMARY KEY (`id`)
 ) ENGINE=MYISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `t_shortrent`;
CREATE TABLE `t_shortrent` (
   `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
   `title` char(80) NOT NULL DEFAULT '' COMMENT '标题',
   `uid` INT(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '用户ID',
   `description` CHAR(140) NOT NULL DEFAULT '' COMMENT '描述',
   `level` INT(10) NOT NULL DEFAULT '0' COMMENT '优先级',
   `create_time` INT(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建时间',
   `update_time` INT(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '更新时间',
   `status` TINYINT(4) NOT NULL DEFAULT '0' COMMENT '数据状态',
   `loc_txt` VARCHAR(32) NOT NULL COMMENT '位置',
   `loc_nearby` VARCHAR(32) NOT NULL COMMENT '附近的',
   `city` INT(10) UNSIGNED NOT NULL COMMENT '城市',
   `area` INT(10) UNSIGNED NOT NULL COMMENT '区域',
   `busi_area` INT(10) UNSIGNED NOT NULL COMMENT '商区',
   `longitude` double DEFAULT NULL COMMENT '纬度',
   `latitude` double DEFAULT NULL COMMENT '经度',
   `type` TINYINT(4) NOT NULL COMMENT '类型',
   `min_limit` TINYINT(4) DEFAULT NULL COMMENT '最短租期',
   `price` INT(11) NOT NULL DEFAULT '0' COMMENT '价格',
   `price_unit` TINYINT(4) NOT NULL DEFAULT '1' COMMENT '价格单位',
   `desc_txt` TEXT NOT NULL COMMENT '描述',
   `thumbnail` VARCHAR(255) DEFAULT NULL COMMENT '缩略图',
   `contact` VARCHAR(32) NOT NULL COMMENT '联系人',
   `contact_tel` VARCHAR(11) NOT NULL COMMENT '联系电话',
   `contact_type` TINYINT(4) NOT NULL COMMENT '联系方式',
   PRIMARY KEY (`id`)
 ) ENGINE=MYISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `t_member`;
CREATE TABLE `t_member` (
   `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
   `username` VARCHAR(32) NOT NULL COMMENT '用户名',
   `password` CHAR(32) NOT NULL COMMENT '密码',
   `openid` CHAR(28) COMMENT '微信OPENID',
   `point` INT(10) NOT NULL DEFAULT 0 COMMENT '积分',
   `create_time` INT(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建时间',
   `last_login` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '最后登录时间',
   PRIMARY KEY (`id`)
) ENGINE=MYISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `t_info_submit`;
CREATE TABLE `t_info_submit`(
   `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
   `contact` VARCHAR(32) NOT NULL COMMENT '联系人',
   `contact_tel` VARCHAR(32) NOT NULL COMMENT '联系电话',
   `content` TEXT NOT NULL COMMENT '内容',
   `create_time` int(11) NOT NULL COMMENT '创建时间',
   `status` tinyint(4) DEFAULT NULL COMMENT '状态',
   PRIMARY KEY (`id`)
) ENGINE=MYISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `t_statistics`;
CREATE TABLE `t_statistics`(
   `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
   `create_time` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '创建时间',
   `web_user` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '网站用户数',
   `wx_user` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '微信用户数',
   `house_rent` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '房屋信息数',
   `house_sale` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '房屋信息数',
   `office_market` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '房屋信息数',
   `short_rent` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '房屋信息数',
   `article` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '新闻数',
   `ip` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'ip数',
   `pv` int(10) unsigned NOT NULL DEFAULT '0',
   PRIMARY KEY(`id`)
) ENGINE=MYISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `t_agentmarket`;

CREATE TABLE `t_agentmarket` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` char(80) NOT NULL DEFAULT '' COMMENT '标题',
  `create_time` INT(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建时间',
  `uid` INT(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '用户ID',
  `status` TINYINT(4) NOT NULL DEFAULT '0' COMMENT '数据状态',
  `feature` varchar(255) DEFAULT NULL COMMENT '特色',
  `price_avg` int(10) unsigned NOT NULL COMMENT '均价',
  `price_avg2` int(10) unsigned NOT NULL COMMENT '公建均价',
  `pref_txt` varchar(128) DEFAULT NULL COMMENT '优惠信息',
  `down_payment` int(10) unsigned NOT NULL COMMENT '首付',
  `down_payment_max` int(10) unsigned DEFAULT NULL COMMENT '首付上限',
  `monthly` int(10) unsigned NOT NULL COMMENT '月供',
  `monthly_max` int(10) unsigned DEFAULT NULL COMMENT '月供上限',
  `contact_tel` varchar(11) NOT NULL COMMENT '联系电话',
  `city` int(10) unsigned NOT NULL COMMENT '城市',
  `area` int(10) unsigned NOT NULL COMMENT '区域',
  `busi_area` int(10) unsigned NOT NULL COMMENT '商圈',
  `loc_txt` varchar(32) DEFAULT NULL COMMENT '位置备注',
  `traffic` varchar(255) DEFAULT NULL COMMENT '交通状况',
  `open_time` date DEFAULT NULL COMMENT '开盘时间',
  `in_time` date DEFAULT NULL COMMENT '入住时间',
  `decorate` tinyint(4) DEFAULT NULL COMMENT '装修情况',
  `property_right` tinyint(4) DEFAULT NULL COMMENT '产权',
  `room_square_txt` varchar(255) DEFAULT NULL COMMENT '户型面积',
  `room_count` int(10) unsigned DEFAULT NULL COMMENT '户数',
  `thumbnail` varchar(255) DEFAULT NULL COMMENT '缩略图',
  `longitude` double NOT NULL DEFAULT '0' COMMENT '经度',
  `latitude` double NOT NULL DEFAULT '0' COMMENT '纬度',
  PRIMARY KEY (`id`)
) ENGINE=MYISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `t_agentmarket_pic`;
CREATE TABLE `t_agentmarket_pic` (
  `id` int(10) unsigned not null,
  `type` tinyint not null,
  `desc_txt` varchar(128) null,
  PRIMARY key (`id`)
) ENGINE=MYISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `t_iplog`;
CREATE TABLE `t_iplog` (
   `id` int(11) NOT NULL AUTO_INCREMENT,
   `ip_address` char(30) DEFAULT NULL COMMENT 'ip地址',
   `url` char(100) DEFAULT NULL COMMENT '来访链接',
   `url_self` char(100) DEFAULT NULL COMMENT '受访页面',
   `request_time` int(11) DEFAULT NULL COMMENT '访问时间',
   PRIMARY KEY (`id`)
 ) ENGINE=MYISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `t_iplog_01`;
CREATE TABLE `t_iplog_01` AS select * from `t_iplog` where 1=2;


DROP TABLE IF EXISTS `t_wx_account`;

CREATE TABLE `t_wx_account` (
  `id` varchar(32) NOT NULL,
  `app_id` varchar(255) DEFAULT NULL,
  `app_secret` varchar(255) DEFAULT NULL,
  `valid_token` varchar(32) NOT NULL,
  `access_token` varchar(255) DEFAULT NULL,
  `last_fetch` datetime DEFAULT NULL,
  `exp_in` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `desc_txt` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `t_wx_event_material`;

CREATE TABLE `t_wx_event_material` (
  `account_id` varchar(32) NOT NULL DEFAULT '',
  `event_type` varchar(32) NOT NULL,
  `material_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`account_id`,`event_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `t_wx_material`;

CREATE TABLE `t_wx_material` (
   `id` int(11) NOT NULL AUTO_INCREMENT,
   `description` varchar(255) DEFAULT NULL COMMENT '摘要',
   `type` varchar(32) NOT NULL,
   `content` text,
   `title` varchar(128) DEFAULT NULL,
   `media_id` varchar(32) DEFAULT NULL,
   `music_url` varchar(255) DEFAULT NULL,
   `hq_music_url` varchar(255) DEFAULT NULL,
   `cover_url` varchar(100) DEFAULT NULL COMMENT '封面图片',
   `create_time` int(11) DEFAULT NULL COMMENT '创建时间',
   PRIMARY KEY (`id`)
 ) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `t_wx_material_item`;

CREATE TABLE `t_wx_material_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mater_id` int(11) NOT NULL,
  `title` varchar(32) NOT NULL,
  `desc_txt` text DEFAULT NULL,
  `pic_url` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `seq_num` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_mater_id` (`mater_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `t_wx_menu`;

CREATE TABLE `t_wx_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) DEFAULT NULL,
  `name` varchar(32) NOT NULL,
  `type` varchar(12) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `btn_key` varchar(32) DEFAULT NULL,
  `level` tinyint(4) NOT NULL DEFAULT '0',
  `account_id` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `t_wx_share_path`;

CREATE TABLE `t_wx_share_path` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `busi_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `fro` varchar(32) NOT NULL,
  `who` varchar(32) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_busi_id_who` (`busi_id`,`who`),
  KEY `idx_created` (`created`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `t_wx_user`;

CREATE TABLE `t_wx_user` (
  `id` char(28) NOT NULL,
  `nickname` varchar(64) DEFAULT NULL,
  `sex` tinyint(4) NOT NULL DEFAULT '0',
  `province` varchar(64) DEFAULT NULL,
  `city` varchar(64) DEFAULT NULL,
  `country` varchar(64) DEFAULT NULL,
  `head_img_url` varchar(255) DEFAULT NULL,
  `privilege` varchar(255) DEFAULT NULL,
  `acc_token` varchar(255) DEFAULT NULL,
  `exp_in` int(11) DEFAULT NULL,
  `ref_token` varchar(255) DEFAULT NULL,
  `scope` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_wx_nickname` (`nickname`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `t_wx_user_event`;

CREATE TABLE `t_wx_user_event` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `from_user` char(28) NOT NULL,
  `to_user` varchar(32) NOT NULL,
  `created` int(11) NOT NULL,
  `event` varchar(32) NOT NULL,
  `event_key` varchar(32) NOT NULL,
  `ticket` varchar(128) DEFAULT NULL,
  `loc_x` double DEFAULT NULL,
  `loc_y` double DEFAULT NULL,
  `prec` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_wx_user_event_fu` (`from_user`,`created`)
) ENGINE=MyISAM AUTO_INCREMENT=104 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `t_wx_user_msg`;

CREATE TABLE `t_wx_user_msg` (
  `id` bigint(20) NOT NULL,
  `to_user` varchar(32) NOT NULL,
  `from_user` char(28) NOT NULL,
  `created` int(11) NOT NULL,
  `msg_type` varchar(32) NOT NULL,
  `content` text,
  `pic_url` varchar(255) DEFAULT NULL,
  `media_id` varchar(32) DEFAULT NULL,
  `format` varchar(32) DEFAULT NULL,
  `thumb_mediaId` varchar(32) DEFAULT NULL,
  `loc_x` double DEFAULT NULL,
  `loc_y` double DEFAULT NULL,
  `scale` int(11) DEFAULT NULL,
  `title` varchar(128) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_wx_msg_fu` (`from_user`,`created`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `t_qrcode_scan`;
CREATE TABLE `t_qrcode_scan` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态',
  `busi_type` tinyint(4) DEFAULT NULL COMMENT '业务类型',
  `busi_id` int(11) DEFAULT NULL COMMENT '实体ID',
  `openid` char(28) DEFAULT NULL COMMENT '微信openid',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `t_point_log`;
CREATE TABLE `t_point_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL COMMENT '用户ID',
  `point` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '积分',
  `type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '类型',
  `channel` tinyint(4) NOT NULL DEFAULT '0' COMMENT '方式',
  `created` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `opr_id` int(11) NOT NULL DEFAULT '0' COMMENT '操作人',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
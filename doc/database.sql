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
   PRIMARY KEY (`id`)
 ) ENGINE=MYISAM DEFAULT CHARSET=utf8 COMMENT='文档模型文章表';

DROP TABLE IF EXISTS `t_houserent`;
CREATE TABLE `t_houserent` (
   `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
   `title` char(80) NOT NULL DEFAULT '' COMMENT '标题',
   `uid` INT(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '用户ID',
   `level` INT(10) NOT NULL DEFAULT '0' COMMENT '优先级',
   `create_time` timestamp NOT NULL COMMENT '创建时间',
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
   `create_time` timestamp NOT NULL COMMENT '创建时间',
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
   `thumb` VARCHAR(128) DEFAULT NULL COMMENT '缩略图',
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
   PRIMARY KEY (`id`)
)

DROP TABLE IF EXISTS `t_info_submit`;
CREATE TABLE `t_info_submit`(
   `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
   `contact` VARCHAR(32) NOT NULL COMMENT '联系人',
   `contact_tel` VARCHAR(32) NOT NULL COMMENT '联系电话',
   `content` TEXT NOT NULL COMMENT '内容',
   PRIMARY KEY (`id`)
) ENGINE=MYISAM DEFAULT CHARSET=utf8;
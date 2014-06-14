insert into t_admin_user(username, password, auth)
value('admin', '21232f297a57a5a743894a0e4a801fc3', '100');

insert into `t_category` (`id`, `name`, `title`, `seq_num`, `list_row`, `status`) values('1','recommend','专题推荐','1','10','0');
insert into `t_category` (`id`, `name`, `title`, `seq_num`, `list_row`, `status`) values('2','buyway','买房小道','2','10','0');
insert into `t_category` (`id`, `name`, `title`, `seq_num`, `list_row`, `status`) values('3','newstoday','今日要闻','3','10','0');
insert into `t_category` (`id`, `name`, `title`, `seq_num`, `list_row`, `status`) values('4','interview','访谈活动','4','10','0');

insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('1','BOOL_CHAR','Y','是','N','0');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('2','BOOL_CHAR','N','否','N','0');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('3','HOUSE_BUILD_TYPE','1','普通住宅','N','1');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('4','HOUSE_BUILD_TYPE','2','公寓','N','2');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('5','HOUSE_BUILD_TYPE','3','别墅','N','3');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('6','HOUSE_BUILD_TYPE','4','平房','N','4');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('7','HOUSE_CONTACT_TYPE','1','个人','N','1');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('8','HOUSE_CONTACT_TYPE','2','经纪人','N','2');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('9','HOUSE_DECORATE_TYPE','1','毛坯','N','1');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('10','HOUSE_DECORATE_TYPE','2','简单装修','N','2');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('11','HOUSE_DECORATE_TYPE','3','中等装修','N','3');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('12','HOUSE_DECORATE_TYPE','4','精装修','N','4');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('13','HOUSE_DECORATE_TYPE','5','豪华装修','N','5');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('14','HOUSE_FACE_TYPE','1','东','N','1');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('15','HOUSE_FACE_TYPE','2','南','N','2');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('16','HOUSE_FACE_TYPE','3','西','N','3');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('17','HOUSE_FACE_TYPE','4','北','N','4');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('18','HOUSE_FACE_TYPE','5','南北','N','5');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('19','HOUSE_FACE_TYPE','6','东西','N','6');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('20','HOUSE_FACE_TYPE','7','东南','N','7');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('21','HOUSE_FACE_TYPE','8','西南','N','8');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('22','HOUSE_FACE_TYPE','9','东北','N','9');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('23','HOUSE_FACE_TYPE','10','西北','N','10');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('24','HOUSE_RENT_DEPOSIT_TYPE','1','押一付一','N','1');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('25','HOUSE_RENT_DEPOSIT_TYPE','2','押一付二','N','2');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('26','HOUSE_RENT_DEPOSIT_TYPE','3','押一付三','N','3');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('27','HOUSE_RENT_DEPOSIT_TYPE','4','押二付一','N','4');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('28','HOUSE_RENT_DEPOSIT_TYPE','5','押二付二','N','5');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('29','HOUSE_RENT_DEPOSIT_TYPE','6','押二付三','N','6');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('30','HOUSE_RENT_DEPOSIT_TYPE','7','半年','N','7');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('31','HOUSE_RENT_DEPOSIT_TYPE','8','年付','N','8');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('32','HOUSE_RENT_DEPOSIT_TYPE','9','面议','N','9');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('33','HOUSE_RENT_TYPE','1','整套出租','N','0');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('34','HOUSE_RENT_TYPE','2','单间出租','N','0');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('35','HOUSE_RENT_TYPE','3','床位出租','N','3');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('36','HOUSE_STRUCTURE_TYPE','1','板楼','N','1');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('37','HOUSE_STRUCTURE_TYPE','2','塔楼','N','2');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('38','HOUSE_STRUCTURE_TYPE','3','板塔结合','N','3');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('39','USER_GENDER','0','先生','N','1');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('40','USER_GENDER','1','女士','N','2');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('64','OFFICE_MARKET_BD_TYPE','1','写字楼','N','1');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('65','OFFICE_MARKET_BD_TYPE','2','商务中心','N','2');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('66','OFFICE_MARKET_BD_TYPE','3','商住公寓','N','3');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('67','HOUSE_SUPPLY_DEMAND','1','求租','N','2');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('68','HOUSE_SUPPLY_DEMAND','2','求购','N','4');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('69','HOUSE_SUPPLY_DEMAND','3','出租','N','1');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('70','HOUSE_SUPPLY_DEMAND','4','出售','N','3');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('71','OFFICE_MARKET_PRICE_UNIT','1','元/平米/天','N','1');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('72','OFFICE_MARKET_PRICE_UNIT','2','元/月','N','2');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('73','OFFICE_MARKET_PRICE_UNIT','3','万元','N','3');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('74','HOUSE_RENT_PRICE_RANGE','MIN-500','500元以下','N','1');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('75','HOUSE_RENT_PRICE_RANGE','500-1000','500-1000元','N','2');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('76','HOUSE_RENT_PRICE_RANGE','1000-1500','1000-1500元','N','3');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('77','HOUSE_RENT_PRICE_RANGE','1500-2000','1500-2000元','N','4');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('78','HOUSE_RENT_PRICE_RANGE','2000-3000','2000-3000元','N','5');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('79','HOUSE_RENT_PRICE_RANGE','3000-4500','3000-4500元','N','6');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('80','HOUSE_RENT_PRICE_RANGE','4500-MAX','4000元以上','N','7');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('81','HOUSE_RENT_BEDROOM','1','一室','N','1');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('82','HOUSE_RENT_BEDROOM','2','两室','N','2');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('83','HOUSE_RENT_BEDROOM','3','三室','N','3');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('84','HOUSE_RENT_BEDROOM','4','四室','N','4');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('85','HOUSE_RENT_BEDROOM','5','四室以上','N','5');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('86','HOUSE_RENT_ROOM_TYPE','1','主卧','N','1');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('87','HOUSE_RENT_ROOM_TYPE','2','次卧','N','2');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('88','HOUSE_RENT_ROOM_TYPE','3','隔断','N','3');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('89','HOUSE_RENT_SEX','1','男女不限','N','1');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('90','HOUSE_RENT_SEX','2','限女生','N','2');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('91','HOUSE_RENT_SEX','3','限男生','N','3');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('92','DISTRICT_TYPE','1','省','N','1');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('93','DISTRICT_TYPE','2','市','N','2');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('94','DISTRICT_TYPE','12','直辖市','N','3');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('95','DISTRICT_TYPE','3','区（县）','N','4');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('96','DISTRICT_TYPE','4','商区','N','5');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('97','HOUSE_PROPERTY_RIGHT','1','70年产权','N','1');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('98','HOUSE_PROPERTY_RIGHT','2','50年产权','N','2');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('99','HOUSE_PROPERTY_RIGHT','3','40年产权','N','3');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('100','HOUSE_PROPERTY_TYPE','1','商品房','N','1');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('101','HOUSE_PROPERTY_TYPE','2','商住两用','N','2');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('102','HOUSE_PROPERTY_TYPE','3','经济适用房','N','3');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('103','HOUSE_PROPERTY_TYPE','4','使用权','N','4');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('104','HOUSE_PROPERTY_TYPE','5','公房','N','5');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('105','HOUSE_SALE_PRICE_RANGE','MIN-60','60万以下','N','1');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('106','HOUSE_SALE_PRICE_RANGE','60-80','60-80万','N','2');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('107','HOUSE_SALE_PRICE_RANGE','80-100','80-100万','N','3');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('108','HOUSE_SALE_PRICE_RANGE','100-150','100-150万','N','4');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('109','HOUSE_SALE_PRICE_RANGE','150-200','150-200万','N','5');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('110','HOUSE_SALE_PRICE_RANGE','200-300','200-300万','N','6');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('111','HOUSE_SALE_PRICE_RANGE','300-500','300-500万','N','7');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('112','HOUSE_SALE_PRICE_RANGE','500-1000','500-1000万','N','8');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('113','HOUSE_SALE_PRICE_RANGE','1000-MAX','1000万以上','N','9');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('114','HOUSE_SALE_SQUARE_RANGE','MIN-50','50㎡以下','N','1');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('115','HOUSE_SALE_SQUARE_RANGE','50-70','50-70㎡','N','2');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('116','HOUSE_SALE_SQUARE_RANGE','70-90','70-90㎡','N','3');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('117','HOUSE_SALE_SQUARE_RANGE','90-110','90-110㎡','N','4');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('118','HOUSE_SALE_SQUARE_RANGE','110-130','110-130㎡','N','5');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('119','HOUSE_SALE_SQUARE_RANGE','130-150','130-150㎡','N','6');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('120','HOUSE_SALE_SQUARE_RANGE','150-200','150-200㎡','N','7');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('121','HOUSE_SALE_SQUARE_RANGE','200-300','200-300㎡','N','8');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('122','HOUSE_SALE_SQUARE_RANGE','300-500','300-500㎡','Y','9');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('123','HOUSE_SALE_SQUARE_RANGE','500-MAX','500㎡以上','Y','10');
insert into `t_lookup` (`type`, `name`, `val`, `inactive`, `seq_num`) values('HOUSE_SALE_SQUARE_RANGE','300-MAX','300㎡以上','N','11');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('124','SHORT_RENT_TYPE','1','家庭旅馆','N','1');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('125','SHORT_RENT_TYPE','2','酒店式公寓','N','2');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('126','SHORT_RENT_TYPE','3','经济型酒店','N','3');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('127','SHORT_RENT_TYPE','4','宾馆招待所','N','4');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('128','SHORT_RENT_TYPE','5','特色客栈','N','5');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('129','SHORT_RENT_TYPE','6','星级酒店','N','6');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('130','SHORT_RENT_TYPE','7','青年旅社','N','7');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('131','SHORT_RENT_PRICE_RANGE','MIN-100','100元以下','N','1');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('132','SHORT_RENT_PRICE_RANGE','100-200','100-200元','N','2');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('133','SHORT_RENT_PRICE_RANGE','200-300','200-300元','N','3');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('134','SHORT_RENT_PRICE_RANGE','300-MAX','300元以上','N','4');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('135','DOC_STATUS','-1','删除','N','1');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('136','DOC_STATUS','0','未审核','N','2');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('137','DOC_STATUS','1','禁用','N','3');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('138','DOC_STATUS','2','启用','N','4');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('139','DOC_STATUS','3','草稿','Y','5');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('140','AGENT_MARKET_PIC_TYPE','1','户型图','N','1');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('141','AGENT_MARKET_PIC_TYPE','2','道路交通','N','2');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('142','AGENT_MARKET_PIC_TYPE','3','小区','N','3');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('143','AGENT_MARKET_PIC_TYPE','4','售楼处','N','4');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('144','AGENT_MARKET_PIC_TYPE','5','效果图','N','5');
insert into `t_lookup` (`id`, `type`, `name`, `val`, `inactive`, `seq_num`) values('145','AGENT_MARKET_PIC_TYPE','6','规划图','N','6');

/*测试数据复制 - 房屋买卖*/
insert into t_housesale(title,uid,level,create_time,status,community,city,area,busi_area,bed_room,live_room,toilet,floor,floor_max,contact,contact_tel,longitude,latitude,build_type,structure,decorate,face,add_on,feature,thumbnail,price,square,inner_square,down_payment,monthly,property_right,property_type,build_year,desc_txt)
select title,uid,level,create_time + 60,status,community,city,area,busi_area,bed_room,live_room,toilet,floor,floor_max,contact,contact_tel,longitude,latitude,build_type,structure,decorate,face,add_on,feature,thumbnail,price,square,inner_square,down_payment,monthly,property_right,property_type,build_year,desc_txt
from t_housesale where id=1;

/*测试数据复制 - 房屋租赁*/
insert into t_houserent(title,uid,level,create_time,status,community,city,area,busi_area,bed_room,live_room,toilet,floor,floor_max,contact,contact_tel,longitude,latitude,decorate,face,add_on,feature,thumbnail,price,deposit_type,square,desc_txt)
select title,uid,level,create_time + 60,status,community,city,area,busi_area,bed_room,live_room,toilet,floor,floor_max,contact,contact_tel,121.560037,38.987971,decorate,face,add_on,feature,thumbnail,price,deposit_type,square,desc_txt
from t_houserent where id=20;

/*测试数据复制 - 房屋短租*/
insert into t_shortrent(title,uid,description,level,create_time,update_time,status,loc_txt,loc_nearby,city,area,busi_area,type,min_limit,price,price_unit,desc_txt,thumbnail,contact,contact_tel,contact_type,longitude,latitude)
select title,uid,description,level,create_time+60,update_time,status,loc_txt,loc_nearby,city,area,busi_area,type,min_limit,price,price_unit,desc_txt,thumbnail,contact,contact_tel,contact_type,121.561623,38.978579
from t_shortrent
where id=1;

/*测试数据复制 - 图片*/
insert into t_picture(path,url,md5,sha1,status,create_time,type,pid)
select path,url,md5,sha1,status,create_time+60,type,1
from t_picture
where pid=1
and type=1;


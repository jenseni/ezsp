<?php

namespace Home\Controller;

use Home\Model\DistrictModel;

class OfficeMarketController extends HomeController{

	public function _initialize(){
		parent::_initialize();
		$this->assign('currentNav', 6);
		$this->assign('site_title','恒润房产-写字楼商铺');
	}
	/**
	 * 商铺写字楼
	 * area 区域id
	 * bdType 建筑类型
	 * contnactType 联系人身份
	 * sdType 供求类型
	 * pn 分页
	 */
	public function lists($area=0, $bdType=0, $contactType=0, $sdType=0, $sort = ''){
		$map = array();

		$map['h.city'] = (int)$this->city['id'];

		if($area != '0'){
			$map['_string'] = "h.area=$area OR h.busi_area=$area";
		}
		if($bdType != 0){
			$map['h.bd_type'] = (int)$bdType;
		}
		if($contactType != 0){
			$map['h.contact_type'] = (int)$contactType;
		}
		if($sdType != 0){
			$map['h.sd_type'] = (int)$sdType;
		}

		$sortField = 'h.id';
		$sortDir = 'desc';
		if(!empty($sort)){
			$sortInfo = explode('-', $sort);
			if(isset($sortInfo[0])){
				$sortField = $sortInfo[0];
			}
			if(isset($sortInfo[1])){
				$sortDir = $sortInfo[1];
			}
		}

		$model = M('Officemarket');

		$totalCount = $model->alias('h')
			->where($map)
			->count(1);

		$page = new \Think\Page($totalCount);
		$page->setConfig('prev', '上一页');
		$page->setConfig('next', '下一页');

		$dataList = $model->field('h.id, h.area_sector,h.title,h.real_estate
			,h.thumbnail, h.price,h.description
			,h.price_unit, h.square, h.busi_area
			,busi_area.name busi_area_name
			,h.bd_type,h.sd_type,h.contact_type
			,FROM_UNIXTIME(h.create_time) create_time')
			->alias('h')
			->join('__DISTRICT__ busi_area on h.busi_area=busi_area.id', 'LEFT')
			->where($map)
			->order("$sortField $sortDir")
			->limit($page->firstRow, $page->listRows)
			->select();
		$this->assign('dataList', $dataList);
		$this->assign('area', $area);
		$this->assign('bdType', $bdType);
		$this->assign('contactType', $contactType);
		$this->assign('sdType', $sdType);
		$this->assign('totalCount', $totalCount);
		$this->assign('page', $page->show());

		$this->display();
	}

	public function detail($id){
		$House = M('Officemarket');

		$data = $House->field('h.*,area.name area_name,busi_area.name busi_area_name')
			->alias('h')
			->join('__DISTRICT__ area on area.id=h.area', 'LEFT')
			->join('__DISTRICT__ busi_area on busi_area.id=h.busi_area', 'LEFT')
			->where(array('h.id'=>(int)$id))
			->find();

		if(empty($data)){
			$this->error('404:信息已删除或不存在');
		}

		$Picture = M('Picture');
		$housePicList = $Picture->field('path')->where(array('pid'=>$id,'type'=>3))->select();
		$data['picList'] = $housePicList;

		$this->assign('data', $data);

		$this->display();
	}


}
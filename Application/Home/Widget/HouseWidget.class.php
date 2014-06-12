<?php
namespace Home\Widget;

use \Think\Controller;

class HouseWidget extends Controller{
	/**
	 * 房产动态最新
	 */
	public function houseNewsLatest($count = 6){
		$Article = M('Article');
		$dataList = $Article->field('content', true)
			->where(array('status'=>array('NEQ', 0)))
			->order('id desc')
			->limit($count)
			->select();

		if(!empty($dataList)){
			$this->assign('dataList', $dataList);
			$this->display('Widget/houseNewsLatest');
		}
	}

	/**
	 * 热门商铺
	 */
	public function officeMarketHot($count=5){
		$OfficeMarket = M('Officemarket');
		$dataList = $OfficeMarket->field('content', true)
			->where(array('status'=>array('NEQ', 0)))
			->order('level desc, id desc')
			->limit($count)
			->select();

		if(!empty($dataList)){
			$this->assign('dataList', $dataList);
			$this->display('Widget/officeMarketHot');
		}
	}

	/**
	 * 推荐二手房
	 */
	public function houseSaleSuggest($count = 2){
		$HouseSale = M('Housesale');
		$dataList = $HouseSale->alias('h')
			->field('h.id,h.bed_room,h.live_room,h.decorate,h.price,h.thumbnail,h.community,busi_area.name busi_area_name')
			->join('__DISTRICT__ busi_area on busi_area.id=h.busi_area', 'LEFT')
			->where(array('h.status'=>array('NEQ', 0)))
			->order('level desc, id desc')
			->limit($count)
			->select();
		if(!empty($dataList)){
			$this->assign('dataList', $dataList);
			$this->display('Widget/houseSaleSuggest');
		}
	}

	public function houseSaleNearby($whoId, $condition = array(), $count = 3){
		$HouseSale = M('Housesale');

		$condition['h.status'] = array('NEQ', 0);
		$condition['h.id'] = array('NEQ', (int)$whoId);

		$dataList = $HouseSale->alias('h')
			->field('h.title,h.id,h.thumbnail,h.price,h.contact_tel,area.name area_name,busi_area.name busi_area_name')
			->join('__DISTRICT__ area on h.area=area.id', 'LEFT')
			->join('__DISTRICT__ busi_area on h.busi_area=busi_area.id', 'LEFT')
			->where($condition)
			->order('id desc')
			->limit($count)
			->select();

		if(!empty($dataList)){
			$this->assign('dataList', $dataList);
			$this->display('Widget/houseSaleNearby');
		}
	}

	public function houseRentNearby($whoId, $condition = array(), $count = 3){
		$HouseRent = M('Houserent');

		$condition['h.status'] = array('NEQ', 0);
		$condition['h.id'] = array('NEQ', (int)$whoId);

		$dataList = $HouseRent->alias('h')
			->field('h.title,h.id,h.thumbnail,h.price,h.contact_tel,area.name area_name,busi_area.name busi_area_name')
			->join('__DISTRICT__ area on h.area=area.id', 'LEFT')
			->join('__DISTRICT__ busi_area on h.busi_area=busi_area.id', 'LEFT')
			->where($condition)
			->order('id desc')
			->limit($count)
			->select();

		if(!empty($dataList)){
			$this->assign('dataList', $dataList);
			$this->display('Widget/houseRentNearby');
		}
	}
}
<?php
namespace Home\Controller;

class HouseSaleController extends HomeController{

	public function _initialize(){
		parent::_initialize();
		$this->assign('currentNav', 3);
	}

	public function index($area = '0', $price = '0', $square = '0', $room = '0', $sort = ''){
		$map = array();

		$map['h.city'] = (int)$this->city['id'];
		$map['h.status'] = 1;

		if($area != '0'){
			$map['_string'] = "h.area=$area OR h.busi_area=$area";
		}
		if($price != '0'){
			$priceRange = explode('-', $price);
			if(is_numeric($priceRange[0]) && is_numeric($priceRange[1])){
				$map['h.price'] = array('BETWEEN', array_map(function($v){return (int)$v;}, $priceRange));
			}elseif(is_numeric($priceRange[0])){
				$map['h.price'] = array('GT', (int)$priceRange[0]);
			}elseif(is_numeric($priceRange[1])){
				$map['h.price'] = array('LT', (int)$priceRange[1]);
			}
		}
		if($square != '0'){
			$squareRange = explode('-', $square);
			if(is_numeric($squareRange[0]) && is_numeric($squareRange[1])){
				$map['h.square'] = array('BETWEEN', array_map(function($v){return (int)$v;}, $squareRange));
			}elseif(is_numeric($squareRange[0])){
				$map['h.square'] = array('GT', (int)$squareRange[0]);
			}elseif(is_numeric($squareRange[1])){
				$map['h.square'] = array('LT', (int)$squareRange[1]);
			}
		}
		if($room != '0'){
			$map['h.bed_room'] = (int)$room;
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

		$model = M('Housesale');

		$totalCount = $model->alias('h')
			->where($map)
			->count(1);

		$page = new \Think\Page($totalCount);
		$page->setConfig('prev', '上一页');
		$page->setConfig('next', '下一页');

		$dataList = $model->field('h.id,h.title,h.create_time,h.community,h.bed_room,h.live_room,h.floor,h.floor_max,h.decorate,h.structure,h.build_year,h.face,h.thumbnail, h.price, h.add_on, h.square, busi_area.name busi_area_name')
			->alias('h')
			->join('__DISTRICT__ busi_area on h.busi_area=busi_area.id', 'LEFT')
			->where($map)
			->order("$sortField $sortDir")
			->limit($page->firstRow, $page->listRows)
			->select();

		$this->assign('dataList', $dataList);
		$this->assign('area', $area);
		$this->assign('price', $price);
		$this->assign('square', $square);
		$this->assign('room', $room);
		$this->assign('page', $page->show());

		$this->display();
	}

	public function detail($id){
		$House = M('Housesale');

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
		$housePicList = $Picture->field('path')->where(array('pid'=>$id,'type'=>1))->select();
		$data['picList'] = $housePicList;

		$this->assign('data', $data);

		$this->display();
	}
}
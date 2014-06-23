<?php
namespace Home\Controller;

class ShortRentController extends HomeController{
	public function _initialize(){
		parent::_initialize();
		$this->assign('currentNav', 5);
		$this->assign('site_title','恒润房产-短期租房');
	}



	public function lists($area = '0', $type = '0', $price = '0', $sort=''){
		$map = array();

		$map['sr.city'] = (int)$this->city['id'];
		$map['sr.status'] = array('NEQ', 0);

		if($area != '0'){
			$map['_string'] = "sr.area=$area OR sr.busi_area=$area";
		}

		if($type != '0'){
			$map['sr.type'] = (int)$type;
		}

		if($price != '0'){
			$priceRange = explode('-', $price);
			if(is_numeric($priceRange[0]) && is_numeric($priceRange[1])){
				$map['sr.price'] = array('BETWEEN', array_map(function($v){return (int)$v;}, $priceRange));
			}elseif(is_numeric($priceRange[0])){
				$map['sr.price'] = array('GT', (int)$priceRange[0]);
			}elseif(is_numeric($priceRange[1])){
				$map['sr.price'] = array('LT', (int)$priceRange[1]);
			}
		}
		$sortField = 'sr.id';
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

		$model = M('Shortrent');

		$totalCount = $model->alias('sr')
			->where($map)
			->count(1);

		$page = new \Think\Page($totalCount);
		$page->setConfig('prev', '上一页');
		$page->setConfig('next', '下一页');

		$dataList = $model->field('sr.id,sr.title,FROM_UNIXTIME(sr.create_time) create_time,busi_area.name busi_area_name
			,sr.price,sr.price_unit,sr.type,sr.min_limit,sr.loc_txt,sr.loc_nearby,sr.thumbnail,sr.description')
			->alias('sr')
			->join('__DISTRICT__ busi_area on sr.busi_area=busi_area.id', 'LEFT')
			->where($map)
			->order("$sortField $sortDir")
			->limit($page->firstRow, $page->listRows)
			->select();

		$this->assign('dataList', $dataList);
		$this->assign('area', $area);
		$this->assign('type', $type);
		$this->assign('price', $price);
		$this->assign('totalCount', $totalCount);
		$this->assign('page', $page->show());

		$this->display();
	}

	public function detail($id){
		$House = M('Shortrent');

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
		$housePicList = $Picture->field('path')->where(array('pid'=>$id,'type'=>4))->select();
		$data['picList'] = $housePicList;

		$this->assign('data', $data);

		$this->display();
	}
}
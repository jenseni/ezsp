<?php
namespace Phone\Controller;

class OfficeMarketController extends PhoneController{
	public function lists($area = '0', $bdType = '0', $sort = ''){
		
		$map = array();

		$map['h.city'] = (int)$this->city['id'];
		$map['h.status'] = 1;

		$search = I('get.search');
		if(!empty($search)){
			$where['h.title']  = array('like', '%'.$search.'%');
			$where['h.real_estate'] = array('like','%'.$search.'%');
			$where['_logic'] = 'or';
			$map['_complex'] = $where;
		}

		if($area != '0'){
			$map['_string'] = "h.area=$area OR h.busi_area=$area";
			$param .= ' '.get_p_area($area);
		}
		
		if($bdType != '0'){
			$map['h.bd_type'] = (int)$bdType;
			$param .= ' '.get_p_lookup('OFFICE_MARKET_BD_TYPE',$bdType);
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
		$page->rollPage = 3;
		$page->setConfig('prev', '上一页');
		$page->setConfig('next', '下一页');
		$page->setConfig('theme', '%UP_PAGE% %LINK_PAGE% %DOWN_PAGE%');

		$dataList = $model->field('h.id,h.title,h.create_time,h.square,h.price,h.price_unit,h.thumbnail,
			h.bd_type,busi_area.name busi_area_name')
			->alias('h')
			->join('__DISTRICT__ busi_area on h.busi_area=busi_area.id', 'LEFT')
			->where($map)
			->order("$sortField $sortDir")
			->limit($page->firstRow, $page->listRows)
			->select();

		$this->assign('dataList', $dataList);
		$this->assign('param', $param);
		$this->assign('page', $page->show());
		$this->assign('nav',3);
		$this->assign('site_title','恒润房产-写字楼商铺');
		$this->assign('sort',$sort);
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
		$this->assign('site_title','恒润房产-写字楼商铺');
		$this->display();
	}
}
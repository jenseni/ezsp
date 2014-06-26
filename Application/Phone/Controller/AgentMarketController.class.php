<?php
namespace Phone\Controller;

class AgentMarketController extends PhoneController{
	public function lists($area = '0', $sort = ''){
		
		$map = array();

		$map['h.city'] = (int)$this->city['id'];
		$map['h.status'] = 1;

		$search = I('get.search');
		if(!empty($search)){
			$map['h.title']  = array('like', '%'.$search.'%');			
		}

		if($area != '0'){
			$map['_string'] = "h.area=$area OR h.busi_area=$area";
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

		$model = M('Agentmarket');

		$totalCount = $model->alias('h')
			->where($map)
			->count(1);

		$page = new \Think\Page($totalCount);
		$page->rollPage = 3;
		$page->setConfig('prev', '上一页');
		$page->setConfig('next', '下一页');
		$page->setConfig('theme', '%UP_PAGE% %LINK_PAGE% %DOWN_PAGE%');

		$dataList = $model->field('h.*,busi_area.name busi_area_name')
			->alias('h')
			->join('__DISTRICT__ busi_area on h.busi_area=busi_area.id', 'LEFT')
			->where($map)
			->order("$sortField $sortDir")
			->limit($page->firstRow, $page->listRows)
			->select();

		$this->assign('dataList', $dataList);
		$this->assign('page', $page->show());
		$this->assign('nav',4);
		$this->assign('site_title','恒润房产-代理楼盘');
		$this->display();
	}

	public function detail($id){
		$AgentMarket = D('Home/AgentMarket');

		$data = $AgentMarket->detail($id);

		if(empty($data)){
			$this->error('404:信息已删除或不存在');
		}

		$this->assign('data', $data);
		$this->assign('site_title','恒润房产-代理楼盘');
		$this->display();
	}
}
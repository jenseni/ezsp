<?php
namespace Home\Controller;

class AgentMarketController extends HomeController{
	/*public function index(){
		$this->currentNav = 7;

		$pagePath = C('STATIC_PAGE_PATH') . '/agentmarket.html';

		\Think\Storage::connect();

		if(\Think\Storage::has($pagePath)){
			$content = \Think\Storage::read($pagePath);
		}

		$this->assign('content', isset($content) ? $content : '');

		$this->display();
	}*/

	public function index(){
		$this->currentNav = 7;

		$AgentMarket = M('Agentmarket');

		$condition = array();
		$condition['h.status'] = array('NEQ', 0);
		$dataList = $AgentMarket
			->field('h.*, area.name area_name,busi_area.name busi_area_name')
			->alias('h')
			->join('__DISTRICT__ area on area.id=h.area', 'LEFT')
			->join('__DISTRICT__ busi_area on busi_area.id=h.busi_area', 'LEFT')
			->where($condition)
			->order('id desc')
			->select();

		if(count($dataList) == 1){
			$Picture = M('Picture');
			$housePicList = $Picture->alias('p')
				->field('p.id,p.path,ap.desc_txt,ap.type')
				->join('__AGENTMARKET_PIC__ ap on ap.id=p.id', 'LEFT')
				->where(array('p.pid'=>$dataList[0]['id'],'p.type'=>5))
				->select();
			$dataList[0]['house_pic'] = array();
			$dataList[0]['roomtTypePicList'] = array();
			if(!empty($housePicList)){
				foreach ($housePicList as $pic) {
					if(isset($pic['type'])){
						if($pic['type'] == 1){
							$dataList[0]['roomTypePicList'][] = $pic;
						}
					}else{
						$dataList[0]['house_pic'][] = $pic;
					}
				}
			}

			$this->assign('data', $dataList[0]);
			return $this->display('detail');
		}

		$this->assign('dataList', $dataList);
		$this->display();
	}

	public function detail($id){
		$this->currentNav = 7;
		
		$AgentMarket = D('AgentMarket');
		$data = $AgentMarket->detail($id);

		$this->assign('data', $data);

		$this->display();
	}
}
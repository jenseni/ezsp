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
			$housePicList = $Picture->field('path')->where(array('pid'=>$dataList[0]['id'],'type'=>5))->select();
			$dataList[0]['picList'] = $housePicList;

			$this->assign('data', $dataList[0]);
			return $this->display('detail');
		}

		$this->assign('dataList', $dataList);
		$this->display();
	}
}
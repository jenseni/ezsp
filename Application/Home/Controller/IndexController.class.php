<?php
namespace Home\Controller;
use Think\Controller;

class IndexController extends HomeController {
	public function index(){
		$this->currentNav = 1;

		$HouseSale = D('HouseSale');
		$houseSaleList = $HouseSale->listForIndex($this->city, 8);

		$HouseRent = D('HouseRent');
		$houseRentList = $HouseRent->listForIndex($this->city, 4);

		$AgentMarket = M('Agentmarket');
		$agentMarket = $AgentMarket->where(array('status'=>array('NEQ', 0)))->order('create_time desc')->find();
		if(!empty($agentMarket)){
			$agentMarket['picList'] = M('Picture')->alias('p')
				->field('p.path')
				->join('__AGENTMARKET_PIC__ ap on ap.id=p.id', 'LEFT')
				->where(array('p.pid'=>$agentMarket['id'], 'p.type'=>5, '_string'=>'ap.type is null'))
				->select();
		}

		$this->assign('agentMarket', $agentMarket);
		$this->assign('houseSaleList', $houseSaleList);
		$this->assign('houseRentList', $houseRentList);

		$this->display();
	}

}
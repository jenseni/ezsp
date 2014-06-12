<?php
namespace Home\Controller;
use Think\Controller;

class IndexController extends HomeController {
	public function index(){
		$this->currentNav = 1;

		$HouseSale = D('HouseSale');
		$houseSaleList = $HouseSale->listForIndex($this->city);

		$HouseRent = D('HouseRent');
		$houseRentList = $HouseRent->listForIndex($this->city);

		$this->assign('houseSaleList', $houseSaleList);
		$this->assign('houseRentList', $houseRentList);

		$this->display();
	}

}
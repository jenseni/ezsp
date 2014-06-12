<?php
namespace Admin\Controller;

use \Think\Controller;

class DistrictController extends Controller{
	public function getchildren(){
		$pid = I('get.city', I('get.area'));

		if(empty($pid)){
			$this->ajaxReturn(array());
		}

		$District = D('District');

		$result = array();

		if(isset($_GET['city'])){
			$result = $District->getAreaOfCity($pid);
		}elseif(isset($_GET['area'])){
			$result = $District->getChild($pid);
		}

		$ret = array();

		foreach($result as $child){
			$ret[$child['id']] = $child['name'];
		}

		$this->ajaxReturn($ret);
	}
}
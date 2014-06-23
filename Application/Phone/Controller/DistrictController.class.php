<?php
namespace Phone\Controller;

class DistrictController extends PhoneController{
	public function getchildren($pid = 0){

		if(empty($pid)){
			$this->ajaxReturn(array());
		}

		$District = new \Home\Model\DistrictModel;

		$children = $District->getChild($pid);

		$this->ajaxReturn(array('status'=>'0', 'data'=>$children));
	}
}
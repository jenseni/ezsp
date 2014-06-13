<?php
namespace Admin\Controller;

class DistrictController extends AdminController{
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

	public function lists($pid = 1){
		$this->authView(121);

		$District = M('District');
		$parentDistrict = $District->field(true)->find($pid);

		if(empty($parentDistrict)){
			$this->error('区域不存在或已删除');
		}
		//get path from root
		$rootPath = array($parentDistrict);
		$curParent = $parentDistrict;
		while($curParent['id'] != $curParent['pid']){
			$curParent = $District->field(true)->where(array('id'=>$curParent['pid']))->find();
			if(!empty($curParent)){
				array_unshift($rootPath, $curParent);
			}else{
				break;
			}
		}

		$parentDistrict['rootPath'] = $rootPath;

		// fetch children
		$districtList = $District->field(true)
			->where("pid=%d AND pid<>id", $pid)
			->select();

		$parentDistrict['children'] = $districtList;

		$this->assign('parentDistrict', $parentDistrict);

		$this->display();
	}
}
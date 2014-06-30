<?php
namespace Admin\Controller;

class WxMaterialController extends AdminController{
	public function lists(){
		$this->authView(126);

		$WxMaterial = M('WxMaterial');

		

		$this->display();
	}
}
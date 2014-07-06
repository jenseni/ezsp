<?php
namespace Admin\Controller;

class PointAssignController extends AdminController{
	public function test(){
		$this->authView(120);

		vendor('phpqrcode.qrlib');

		\QRcode::png('PHP QR Code :)');
	}

	public function qrcodescan($busiType, $busiId){
		//生成随机token
		
	}
}
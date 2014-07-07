<?php
namespace Admin\Controller;

class PointAssignController extends AdminController{
	public function test(){
		$this->authView(120);

		vendor('phpqrcode.qrlib');

		\QRcode::png('PHP QR Code :)');
	}

	public function qrcodescan($busiType, $busiId){
		$this->authView(120);

		$QrcodeScan = M('QrcodeScan');
		$data = array('busi_type'=>$busiType, 'busi_id'=>$busiId, 'status'=>0);
		$id = $QrcodeScan->data($data)->add();

		$this->assign('token', $id);

		$this->display();
	}

	public function getqrcode($token){
		$url = 'http://' . C('SERVER_IP') . __ROOT__ . '/phone/point_assign/qrcodescaned?token=' . $token;

		vendor('phpqrcode.qrlib');
		\QRcode::png($url, false, 'L', 5);
	}

	public function checkQrcodeScan($token){
		$QrcodeScan = M('QrcodeScan');
		$tk = $QrcodeScan->find($token);

		$ret = array('status'=>0, 'data'=>array('finish'=>0));
		if($tk['status'] == 1){
			$ret['data']['finish'] = 1;
			$ret['data']['token'] = $token;
		}

		$this->ajaxReturn($ret);
	}

	public function generatesharepath($token){
		$this->authView(120);
		
		$QrcodeScan = M('QrcodeScan');
		$tk = $QrcodeScan->find($token);

		if(empty($tk) || empty($tk['openid']) || empty($tk['busi_type']) || empty($tk['busi_id'])){
			$this->error('参数错误');
		}

		$SharePath = D('WxSharePath');
		$path = $SharePath->getSharePath($tk['busi_type'], $tk['busi_id'], $tk['openid']);

		$this->assign('dataList', $path);
		$this->display();
	}

	
}
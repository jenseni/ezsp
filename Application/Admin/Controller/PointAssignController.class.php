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

		$data = array();
		if($tk['busi_type'] == 1){
			$data = M('Housesale')->field('title,price')->find($tk['busi_id']);
		}

		$SharePath = D('WxSharePath');
		$path = $SharePath->getSharePath($tk['busi_type'], $tk['busi_id'], $tk['openid']);

		$this->assign('info', $data);
		$this->assign('dataList', $path);
		$this->display();
	}

	public function assignpoint(){
		$this->authView(120);
		
		$totalPoint = I('post.total_point');
		$uidList = I('post.id');

		if(empty($totalPoint) || empty($uidList) || count($uidList) <= 1){
			$this->error('参数错误');
		}

		if(count($uidList) == 2){
			$User->where(array('id'=>$uidList[0]))->setInc('point', $totalPoint);

			$logData = array();
			$logData['uid'] = $uidList[0];
			$logData['point'] = $totalPoint;
			$logData['type'] = 1;
			$logData['channel'] = 1;
			$logData['created'] = time();
			$logData['opr_id'] = $this->loginUser['id'];
			$PointLog->data($logData)->add();
		}else{
			$User = M('Member');
			$PointLog = M('PointLog');
			for($i = 0, $count = count($uidList); $i < $count - 1; $i++){
				$point = intval($totalPoint * 0.5 / ($count - 2));
				if($i == $count - 2){
					$point = intval($totalPoint * 0.5);
				}
				$uid = $uidList[$i];
				$User->where(array('id'=>$uid))->setInc('point', $point);

				$logData = array();
				$logData['uid'] = $uid;
				$logData['point'] = $point;
				$logData['type'] = 1;
				$logData['channel'] = 1;
				$logData['created'] = time();
				$logData['opr_id'] = $this->loginUser['id'];
				$PointLog->data($logData)->add();
			}
		}

		echo '操作成功';
	}
}
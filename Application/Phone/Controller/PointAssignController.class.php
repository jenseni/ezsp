<?php
namespace Phone\Controller;

use \Think\Controller;

class PointAssignController extends Controller{
	public function qrcodescaned($token){
		$QrcodeScan = M('QrcodeScan');
		$tk = $QrcodeScan->find($token);

		$openid = $tk['openid'];
		if(empty($openid)){
			$wxapi = \Weixin\Api\Wechat::create();
			$redirecturl = $wxapi->getOauthRedirect('http://'.C('SERVER_IP').__ROOT__.'/phone/point_assign/getopenid/token/'.$token, '123', 'snsapi_base');
			redirect($redirecturl);
		}

		//if member
		$User = M('Member');
		$user = $User->where(array('openid'=>$openid))->find();
		if(empty($user)){
			$this->error('请先加入会员', U('Phone/user/memberjoin'));
		}

		$data = array();
		if($tk['busi_type'] == 1){
			//HouseSale
			$HouseSale = M('Housesale');
			$data = $HouseSale->find($tk['busi_id']);
		}

		$this->assign('tk', $tk);
		$this->assign('data', $data);

		$this->display('qrcodescaned');
	}

	public function getopenid($token){
		$wxapi = \Weixin\Api\Wechat::create();
		$result = $wxapi->getOauthAccessToken();
		if(!isset($result['openid'])){
			$this->error('获取微信openid失败');
		}

		$QrcodeScan = M('QrcodeScan');
		$QrcodeScan->where(array('id'=>$token))->setField('openid', $result['openid']);

		cookie('openid', $result['openid']);
		
		$this->qrcodescaned($token);
	}

	public function qrcodeconfirm(){
		$token = I('post.token');
		if(empty($token)){
			$this->error('参数错误');
		}

		$QrcodeScan = M('QrcodeScan');
		$QrcodeScan->where(array('id'=>$token))->setField('status', 1);

		$this->display();
	}
}
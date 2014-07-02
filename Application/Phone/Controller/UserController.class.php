<?php
namespace Phone\Controller;

use \Think\Controller;

class UserController extends PhoneController{
	
	public function infosubmit(){

		if(IS_POST){

			$Info = D('Home/InfoSubmit');
			$data = $Info->create();

			if(!$data){
				$this->errorInput($Info->getError(), 'User/infosubmit');
			}

			$data['create_time'] = time();
			$data['status'] = 0;

			//echo json_encode($data); exit();

			$id = $Info->data($data)->add();

			if($id){
				$this->assign('message', '提交成功，经纪人查看后会及时联系您，谢谢您的关注。');
			}else{
				$this->assign('message','提交失败，请联系客服');
			}
					
		}

		$this->display('infosubmit');

	}

	

	public function login(){
		if(IS_POST){
			$username = I('username');
			$password = I('password');
			if(empty($username) || empty($password)){
				$this->error('请输入用户名密码');
			}
			$User = D('User');
			$user = $User->where(array('username'=>$username))->find();
			if(empty($user)){
				$this->error('用户不存在');
			}

			if(md5($password) != $user['password']){
				$this->error('密码不正确');
			}

			$uid = \Think\Crypt::encrypt($user['id'], C('CRYPT_KEY'));
			cookie('uid', $uid);
			$this->redirect('Index/index');
		}else{
			$this->display();
		}
	}

	public function register(){
		if(IS_POST){
			$User = D('User');
			$data = $User->create();
			if($data){
				$data['password'] = md5($data['password']);
				$id = $User->data($data)->add();
				$uid = \Think\Crypt::encrypt($id, C('CRYPT_KEY'));
				cookie('uid', $uid);
				$this->success('注册成功', U('Index/index'));
			}else{
				$this->error($User->getError());
			}
		}else{
			$this->display();
		}
	}

	public function logout(){
		cookie('uid', null);
		$this->redirect('Index/index');
	}

	public function memberjoin(){
		if(IS_POST){
			$username = I('username');
			$password = I('password');
			$password2 = I('repassword');
			$openid = I('openid');

			if(empty($username)){
				$this->error('请填写用户名');
			}

			if(empty($password) || empty($password2)){
				$this->error('请填写密码');
			}

			if($password != $password2){
				$this->error('两次密码输入不一致');
			}

			$WxUser = M('WxUser');
			$wxUser = $WxUser->find($openid);
			if(empty($wxUser)){
				$wxapi = \Weixin\Api\Wechat::create();
				$wxUserInfo = $wxapi->getUserInfo($openid);
				if($wxUserInfo){
					$data = array();
					$data['id'] = $openid;
					$data['nickname'] = $wxUserInfo['nickname'];
					$data['sex'] = $wxUserInfo['sex'];
					$data['city'] = $wxUserInfo['city'];
					$data['province'] = $wxUserInfo['province'];
					$data['country'] = $wxUserInfo['country'];
					$data['head_img_url'] = $wxUserInfo['headimgurl'];

					$WxUser->data($data)->add();
				}
			}

			$User = M('Member');
			$user = $User->where(array('username'=>$username))->find();
			if(!empty($user)){
				if(md5($password) != $user['password']){
					$this->error('用户名已存在');
				}

				if($user['openid'] && $user['openid'] != $openid){
					$this->error('用户名已存在');
				}

				$User->where(array('id'=>$user['id']))->setField('openid', $openid);

				$uid = \Think\Crypt::encrypt($user['id'], C('CRYPT_KEY'));
				cookie('uid', $uid);
				cookie('openid', $openid);

				$this->success('加入成功', U('User/mypoint'));
			}else{
				$data = array();
				$data['username'] = $username;
				$data['password'] = md5($password);
				$data['create_time'] = time();
				$data['openid'] = $openid;

				$id = $User->data($data)->add();

				$uid = \Think\Crypt::encrypt($id, C('CRYPT_KEY'));
				cookie('uid', $uid);
				cookie('openid', $openid);

				$this->success('加入成功', U('User/mypoint'));
			}
		}else{
			$uid = cookie('uid');
			$openid = cookie('openid');

			if(!empty($uid)){
				return $this->display('alreadymember');
			}

			if(empty($openid)){
				$wxapi = \Weixin\Api\Wechat::create();
				$redirecturl = $wxapi->getOauthRedirect('http://'.C('SERVER_IP').__ROOT__.'/phone/user/getopenid', '123', 'snsapi_base');
				redirect($redirecturl);
			}

			$this->assign('openid', $openid);

			$this->display('memberjoin');
		}
	}

	public function getopenid(){
		$wxapi = \Weixin\Api\Wechat::create();
		$result = $wxapi->getOauthAccessToken();
		if(!isset($result['openid'])){
			$this->error('获取微信openid失败');
		}

		$User = M('Member');
		$bindUser = $User->where(array('openid'=>$result['openid']))->find();
		if(!empty($bindUser)){
			return $this->display('alreadymember');
		}

		$this->assign('openid', $result['openid']);

		$this->display('memberjoin');
	}

	public function mypoint(){
		$uid = cookie('uid');
		if(!empty($uid)){
			$uid = \Think\Crypt::decrypt($uid, C('CRYPT_KEY'));
		}
		$openid = cookie('openid');

		if(empty($openid)){
			$wxapi = \Weixin\Api\Wechat::create();
			$redirecturl = $wxapi->getOauthRedirect('http://'.C('SERVER_IP').__ROOT__.'/phone/user/getopenidformypoint', '123', 'snsapi_base');
			redirect($redirecturl);
		}

		$WxUser = M('WxUser');
		$wxUserInfo = $WxUser->find($openid);
		$User = M('Member');
		$bindUser = $User->where(array('openid'=>$openid))->find();

		$this->assign('user', array_merge($bindUser, $wxUserInfo));

		$this->display('mypoint');
	}

	public function getopenidformypoint(){
		$wxapi = \Weixin\Api\Wechat::create();
		$result = $wxapi->getOauthAccessToken();
		if(!isset($result['openid'])){
			$this->error('获取微信openid失败');
		}

		$User = M('Member');
		$bindUser = $User->where(array('openid'=>$result['openid']))->find();

		if(empty($bindUser)){
			die('请先加入会员');
		}

		$WxUser = M('WxUser');
		$wxUserInfo = $WxUser->find($openid);

		$this->assign('user', array_merge($bindUser, $wxUserInfo));

		$this->display('mypoint');
	}
}
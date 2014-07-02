<?php
namespace Admin\Controller;

class WeixinController extends AdminController{
	public function accountlist(){
		$this->authView(124);

		$Account = M('WxAccount');
		$dataList = $Account->field('id,app_id,app_secret,valid_token,desc_txt,status')->select();

		cookie('return_url', $_SERVER['REQUEST_URI']);

		$this->assign('dataList', $dataList);

		$this->display();
	}

	public function accountedit($id){
		$this->authView(124);

		$Account = M('WxAccount');
		$data = $Account->find($id);

		$this->assign('data', $data);

		$this->display();
	}

	public function accountadd(){
		$this->authView(124);

		$this->display('accountedit');
	}

	public function accountsave(){
		$Account = D('WxAccount');
		$data = $Account->create();
		if(!$data){
			$this->errorInput($Account->getError(), 'Weixin/accountedit');
		}

		$acc = $Account->find($data['id']);
		if(empty($acc)){
			$Account->data($data)->add();
		}else{
			$Account->data($data)->save();
		}

		$this->successMessage('保存成功', 'Weixin/accountlist');
	}

	public function accountdelete(){
		$id = I('id');

		if(empty($id)){
			$this->errorMessage('请选择要删除的记录', get_return_url('Weixin/accountlist'));
		}

		$Account = M('WxAccount');
		if(is_array($id)){
			$Account->where(array('id'=>array('IN', $id)))->delete();
		}else{
			$Account->delete($id);
		}

		$this->successMessage('删除成功', get_return_url('Weixin/accountlist'));
	}

	public function menulist($account = ''){
		$this->authView(125);

		$Account = M('WxAccount');
		$accountList = $Account->field('id,desc_txt')->select();

		if(empty($accountList)){
			$this->error('请先添加微信号');
		}

		$Menu = M('WxMenu');

		if(empty($account)){
			$account = $accountList[0]['id'];
		}

		$dataList = $Menu->where(array('account_id'=>$account))->select();
		$dataList = list_to_tree($dataList);

		$this->assign('account', $account);
		$this->assign('accountList', $accountList);
		$this->assign('dataList', $dataList);

		$this->display();
	}

	public function menuadd($account){
		$this->authView(125);

		$Account = M('WxAccount');
		$account = $Account->find($account);
		if(empty($account)){
			$this->error('账户不存在');
		}

		$Menu = M('WxMenu');
		$topMenuList = $Menu->field('id,name')->where(array('pid'=>-1))->select();

		$this->assign('account', $account);
		$this->assign('topMenuList', $topMenuList);
		$this->display('menuedit');
	}

	public function menusync($account){
		$this->authView(125);

		$Account = M('WxAccount');
		$account = $Account->find($account);

		if(empty($account)){
			$this->error('账户不存在');
		}

		$menu = array(
			'button'	=>	array(
				array(
					'name'	=>	'介绍',
					'sub_button'	=>	array(
						array(
							'type'	=>	'view',
							'name'	=>	'首页',
							'url'	=>	'http://'.C('SERVER_IP').__ROOT__.'/phone/index'
						),
						array(
							'type'	=>	'view',
							'name'	=>	'公司介绍',
							'url'	=>	'http://'.C('SERVER_IP').__ROOT__.'/phone/company/index.html'
						),
						array(
							'type'	=>	'click',
							'name'	=>	'房产动态',
							'key'	=>	'house_news'
						)
					)
				),
				array(
					'name'	=>	'服务',
					'sub_button'	=>	array(
						array(
							'type'	=>	'view',
							'name'	=>	'租赁房源',
							'url'	=>	'http://'.C('SERVER_IP').__ROOT__.'/phone/house_rent/lists.html'
						),
						array(
							'type'	=>	'view',
							'name'	=>	'买卖房源',
							'url'	=>	'http://'.C('SERVER_IP').__ROOT__.'/phone/house_sale/lists.html'
						),
						array(
							'type'	=>	'view',
							'name'	=>	'写字楼商铺',
							'url'	=>	'http://'.C('SERVER_IP').__ROOT__.'/phone/office_market/lists.html'
						),
						array(
							'type'	=>	'view',
							'name'	=>	'代理楼盘',
							'url'	=>	'http://'.C('SERVER_IP').__ROOT__.'/phone/agent_market/lists.html'
						),
					)
				),
				array(
					'name'	=>	'互动',
					'sub_button'	=>	array(
						array(
							'type'	=>	'view',
							'name'	=>	'会员加入',
							'url'	=>	'http://'.C('SERVER_IP').__ROOT__.'/phone/user/memberjoin'
						),
						array(
							'type'	=>	'click',
							'name'	=>	'优惠活动',
							'key'	=>	'activity'
						),
						array(
							'type'	=>	'view',
							'name'	=>	'我的积分',
							'url'	=>	'http://'.C('SERVER_IP').__ROOT__.'/phone/user/mypoint'
						),
						array(
							'type'	=>	'view',
							'name'	=>	'客服咨询',
							'url'	=>	'http://'.C('SERVER_IP').__ROOT__.'/phone/user/infosubmit'
						),
					)
				)
			)
		);

		$Wechat = \Weixin\Api\Wechat::create($account['id']);
		$result = $Wechat->createMenu($menu);

		echo $result;

		return;
	}
}
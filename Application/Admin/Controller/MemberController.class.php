<?php
namespace Admin\Controller;

class MemberController extends AdminController{
	public function lists(){
		$this->authView(117);

		$Member = M('Member');

		$dataList = $Member
		->field('m.*,wu.nickname')
		->alias('m')
		->join('t_wx_user wu on wu.id = m.openid', 'LEFT')
		->select();

		cookie('return_url', $_SERVER['REQUEST_URI']);

		$this->assign('dataList', $dataList);

		$this->display();
	}

}
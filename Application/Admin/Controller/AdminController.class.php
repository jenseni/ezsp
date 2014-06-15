<?php

namespace Admin\Controller;

use \Think\Controller;

abstract class AdminController extends Controller{

	protected $accessControl = array(
		'public'=>array(
			'User/login', 'User/logout'
		)
	);

	protected function _initialize(){
		$user = get_login_user();
		if(!in_array(CONTROLLER_NAME.'/'.ACTION_NAME, $this->accessControl['public']) && empty($user)){
			cookie('return_url', $_SERVER['REQUEST_URI']);
			//$this->error('请先登录', U('User/login'));
			$this->redirect(U('User/login'));
		}
		$this->assign('loginUser', $user);
	}

	/**
	 * 跳转到一个页面，设置上用户的输入，带上错误信息，可能是actionerror也可能是fielderror
	 * $message mixed
	 *		可以是一个字符串，或者是一个数组，如果是字符串则认为是actionerror，如果是数组，认为是fielderror
	 * $jumbUrl string
	 *		同 error 里的第二个参数
	 * $only,$except array
	 *		只设置的字段，或者只排除的字段，默认空的话全都设置，顺序是先only然后except
	 */
	protected function errorInput($message = '', $jumpUrl = '', $only = array(), $except = array()){
		if(IS_AJAX){
			$this->error($message, U($jumpUrl));
		}
		$formData = I('post.');
		if(!empty($formData)){
			foreach ($formData as $key => $value) {
				if(!empty($only)){
					if(!in_array($key, $only)){
						unset($formData[$key]);
					}
				}
				if(!empty($except)){
					if(in_array($key, $except)){
						unset($formData[$key]);
					}
				}
			}

			$this->assign('data', $formData);
		}

		if(is_array($message)){
			$this->assign('fieldErrors', $message);
		}else{
			if($message == L('_TOKEN_ERROR_')){
				$this->error($message);
			}

			$this->assign('actionError', $message);
		}

		$this->display($jumpUrl);
		exit();
	}

	protected function successMessage($message, $jumpUrl){
		session('actionMessage', $message);
		if(strpos($jumpUrl, MODULE_NAME) === 0
			|| strpos($jumpUrl, CONTROLLER_NAME) === 0){

			$this->redirect($jumpUrl);
		}else{
			redirect($jumpUrl);
		}
	}

	protected function errorMessage($message, $jumpUrl){
		session('actionError', $message);
		if(strpos($jumpUrl, MODULE_NAME) === 0
			|| strpos($jumpUrl, CONTROLLER_NAME) === 0){

			$this->redirect($jumpUrl);
		}else{
			redirect($jumpUrl);
		}
	}

	/**
	 * 菜单与tab的选中状态
	 */
	protected function authView($viewId){
		$user = get_login_user();

		if(empty($user)){
			//$this->error('请先登录');
			$this->redirect('User/login');
		}

		if(!has_auth($user, $viewId)){
			$this->error('没有权限');
		}

		$this->assign('currentView', $viewId);
	}

	/**
	 * 404
	 */
	public function _empty(){
		$this->error('404:Not Found');
	}
}
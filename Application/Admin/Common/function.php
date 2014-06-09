<?php

function get_login_user(){
	if(Admin\Model\AdminUserModel::$loginUser){
		return Admin\Model\AdminUserModel::$loginUser;
	}
	$uid = session('uid');
	if($uid){
		$AdminUser = new Admin\Model\AdminUserModel();
		$user = $AdminUser->field('password', true)->find($uid);

		//设置权限资源
		$userMenuList = array();
		$menuList = C('SYS_MENU');
		if(!empty($user['auth']) && !empty($menuList)){
			foreach ($menuList as $menu) {
				$authViewList = array();
				if(isset($menu['children']) && !empty($menu['children'])){
					foreach ($menu['children'] as $m) {
						if(has_auth($user, $m['id'])){
							$authViewList[] = $m;
						}
					}
				}
				if(!empty($authViewList)){
					$menu['children'] = $authViewList;
					$userMenuList[] = $menu;
				}
			}
		}

		$user['menuList'] = $userMenuList;

		Admin\Model\AdminUserModel::$loginUser = $user;

		return $user;
	}
}

function has_auth($user, $authId){
	if(!isset($user['auth']) || empty($user['auth'])){
		return false;
	}

	return in_array($authId, explode(',', $user['auth']));
}
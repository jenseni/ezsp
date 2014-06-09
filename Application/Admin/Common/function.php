<?php

function get_login_user(){
	if(Admin\Model\AdminUserModel::$loginUser){
		return Admin\Model\AdminUserModel::$loginUser;
	}
	$uid = session('uid');
	if($uid){
		$AdminUser = new Admin\Model\AdminUserModel();
		$user = $AdminUser->find($uid);
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
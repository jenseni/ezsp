<?php
/**
 * 检测用户是否登录
 * @return integer 0-未登录，大于0-当前登录用户ID
 */
function is_login(){
    $user = get_login_user();
    if(isset($user['id'])){
        return $user['id'];
    }
}

function get_login_user(){
    if(!Home\Model\UserModel::$loginUser){
        $uid = cookie('uid');
        if(!empty($uid)){
            $id = \Think\Crypt::decrypt($uid, C('CRYPT_KEY'));
            if(!empty($id)){
                $user = D('User')->find($id);
                if(!empty($user)){
                    Home\Model\UserModel::$loginUser = $user;
                }
            }
        }
    }
    return Home\Model\UserModel::$loginUser;
}

function get_current_city(){
	return array('id'=>517, 'name'=>'大连');
}

function auto_ip_log(){
    $Case = M('Iplog');
    //$data['ip_address'] = $_SERVER['REMOTE_ADDR'];
    $data['ip_address'] = get_client_ip();
    $data['request_time'] = $_SERVER['REQUEST_TIME'];
    $data['url_self'] = $_SERVER['PHP_SELF'];
    $data['url'] = $_SERVER['HTTP_REFERER'];
    $Case->create($data);
    $Case->add();
}
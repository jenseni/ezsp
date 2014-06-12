<?php
/**
     * 检测用户是否登录
     * @return integer 0-未登录，大于0-当前登录用户ID
     */
function is_login(){
    $user = session('user_auth');
    if (empty($user)) {
        return 0;
    } else {
        return session('user_auth_sign') == data_auth_sign($user) ? $user['uid'] : 0;
    }
}

function get_current_city(){
	return array('id'=>517, 'name'=>'大连');
}
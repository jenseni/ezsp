<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Home\Controller;
use Think\Controller;

/**
 * 前台公共控制器
 * 为防止多分组Controller名称冲突，公共Controller名称统一使用分组名称
 */
class HomeController extends Controller {

    /* 空操作，用于输出404页面
    public function _empty(){
        $this->redirect('Index/index');
    }
     */

    protected function _initialize(){
        //默认SEO信息
        $this->site_title = C('WEB_SITE_TITLE');
        $this->site_keywords = C('WEB_SITE_KEYWORD');
        $this->site_description = C('WEB_SITE_DESCRIPTION');
        //获取导航菜单数组
        $this->site_menus = C('SYS_MENU');
    }

    /* 用户登录检测 */
    protected function login(){
        /* 用户登录检测 */
        is_login() || $this->error('您还没有登录，请先登录！', U('User/login'));
    }

    public function get_url($id,$url){
        $currentNav = $id;
        $this->assign('currentNav',$currentNav);
        redirect('www.baidu.com');
    }

}

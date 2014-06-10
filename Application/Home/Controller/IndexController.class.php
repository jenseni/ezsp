<?php
namespace Home\Controller;
use Think\Controller;

class IndexController extends HomeController {
    public function index(){
        $currentNav = 1;
        $this->assign('currentNav',$currentNav);
        $this->display();
    }

}
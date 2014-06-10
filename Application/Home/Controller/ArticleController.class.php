<?php
namespace Home\Controller;
use Think\Controller;

class ArticleController extends HomeController {
    public function index(){
        $this->assign('currentNav',2);
        $this->display();
    }

}
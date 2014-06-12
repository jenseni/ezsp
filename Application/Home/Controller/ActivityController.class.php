<?php
namespace Home\Controller;

class ActivityController extends HomeController{
	public function _initialize(){
		parent::_initialize();
		$this->assign('currentNav',9);
		$this->assign('site_title','恒润房产-优惠活动');
	}

	public function index($category_id = 5){
		$Document = D('Article');
		
		$count = $Document->where('category_id = '.$category_id)->count();
		$Page = new \Think\Page($count,25);
		$lists = $Document
			     ->where('category_id = '.$category_id)
				 ->order('create_time desc')
				 ->limit($Page->firstRow.','.$Page->listRows)
				 ->select();
		$show = $Page->show();
		$this->assign('catetitle','优惠活动');
		$this->assign('lists',$lists);
		$this->assign('page',$show);
		$this->display();
	}

	//详细页面
	public function detail($document_id,$category_title){
		$Document = D('Article');
		$news = $Document->find($document_id);
		$this->assign('news',$news);
		$this->assign('category_title',$category_title);
		$this->display();
	}
}
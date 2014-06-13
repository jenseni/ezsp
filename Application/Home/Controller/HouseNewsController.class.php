<?php
namespace Home\Controller;

class HouseNewsController extends HomeController{
	public function _initialize(){
		parent::_initialize();
		$this->assign('currentNav',8);
		$this->assign('site_title','恒润房产-房产动态');
	}

	public function index(){
		$Document = D('Article');
		$CATEGORY_RECOMMEND = '1';
		$CATEGORY_BUYWAY = '2';
		$CATEGORY_NEWSTODAY = '3';
		$CATEGORY_INTERVIEW = '4';
		$Categories['recommend'] = $CATEGORY_RECOMMEND;
		$Categories['buyway'] = $CATEGORY_BUYWAY;
		$Categories['newstoday'] = $CATEGORY_NEWSTODAY;
		$Categories['interview'] = $CATEGORY_INTERVIEW;
		$CATEGORY_NEWS_NUM = 7;
		$map['category_id'] = array('eq',$CATEGORY_RECOMMEND); 
		//专题推荐
		$recommend_topline = $Document->where($map)->order('level desc, update_time desc')->find();
		$recommend_news    = $Document->where($map)->order('level desc, update_time desc')->limit(1,$CATEGORY_NEWS_NUM)->select();
		$this->assign('recommend_topline',$recommend_topline);
		$this->assign('recommend_news',$recommend_news);
		//买房小道
		$buyway_topline = $Document->where('category_id = '.$CATEGORY_BUYWAY)->order('level desc, update_time desc')->find();
		$buyway_news 	= $Document->where('category_id = '.$CATEGORY_BUYWAY)->order('level desc, update_time desc')->limit(1,$CATEGORY_NEWS_NUM)->select();
		$this->assign('buyway_topline',$buyway_topline);
		$this->assign('buyway_news',$buyway_news);
		//今日新闻
		$newstoday_topline = $Document->where('category_id = '.$CATEGORY_NEWSTODAY)->order('level desc, update_time desc')->find();
		$newstoday_news    = $Document->where('category_id = '.$CATEGORY_NEWSTODAY)->order('level desc, update_time desc')->limit(1,$CATEGORY_NEWS_NUM)->select();
		$this->assign('newstoday_topline',$newstoday_topline);
		$this->assign('newstoday_news',$newstoday_news);
		//访谈活动
		$interview_topline = $Document->where('category_id = '.$CATEGORY_INTERVIEW)->order('level desc, update_time desc')->find();
		$interview_news    = $Document->where('category_id = '.$CATEGORY_INTERVIEW)->order('level desc, update_time desc')->limit(1,$CATEGORY_NEWS_NUM)->select();
		$this->assign('interview_topline',$interview_topline);
		$this->assign('interview_news',$interview_news);
		$this->assign('cates',$Categories);
		$this->display();
	}

	public function lists($category_id){
		$Document = D('Article');
		$Category = D('Category');
		$cate = $Category->find($category_id);
		$count = $Document->where('category_id = '.$category_id)->count();
		$Page = new \Think\Page($count,25);
		$lists = $Document->where('category_id = '.$category_id)
				 ->order('create_time desc')
				 ->limit($Page->firstRow.','.$Page->listRows)
				 ->select();
		$show = $Page->show();		 
		$this->assign('cate',$cate);
		$this->assign('lists',$lists);
		$this->assign('page',$show);
		$this->display();
	}

	//详细页面
	public function detail($document_id,$category_title){
		$Document = M('Article');
		$news = $Document->find($document_id);
		//echo json_encode($news);exit();
		$this->assign('news',$news);
		$this->assign('category_title',$category_title);
		$this->display();
	}
}
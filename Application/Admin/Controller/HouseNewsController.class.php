<?php
namespace Admin\Controller;

class HouseNewsController extends AdminController{
	

	public function lists(){
		$this->authView(114);
		
		$title = I('get.title');
		$condition = array();
		if($title){
			$condition['title'] = array('LIKE', "%{$title}%");
		}

		$Article = D('Article');
		$condition['category_id'] = array('in','1,2,3,4');
		$totalCount = $Article->where($condition)->count(1);
		$Page = new \Org\Util\Page($totalCount);

		$Article->field(true)->where($condition);
		$sortInfo = get_sort_info();
		if(!empty($sortInfo)){
			$Article->order($sortInfo);
		}

		$houseNews = $Article
					 ->field('a.title, c.title category_name')
					 ->alias('a')
					 ->join('t_category c on a.category_id = c.id')
					 ->limit($Page->firstRow, $Page->listRows)->select();

		cookie('return_url', $_SERVER['REQUEST_URI']);

		$this->assign('dataList', $houseNews);
		$this->display();
	}

	public function edit(){
		$this->authView(113);
		
		$this->display();
	}

}
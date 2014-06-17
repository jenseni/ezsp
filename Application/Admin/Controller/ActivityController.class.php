<?php
namespace Admin\Controller;

class ActivityController extends AdminController{
	
	public function lists(){
		$this->authView(116);
		
		$title = I('get.title');
		$condition = array();
		if($title){
			$condition['title'] = array('LIKE', "%{$title}%");
		}

		$Article = D('Article');
		
		$totalCount = $Article->listCount('2',$condition);
		$Page = new \Org\Util\Page($totalCount);

		$sortInfo = get_sort_info();

		$activity = $Article->lists('2',$sortInfo,$Page->firstRow,$Page->listRows,$condition);
		cookie('return_url', $_SERVER['REQUEST_URI']);

		$this->assign('dataList', $activity);
		$this->display();
	}

	public function index(){
		$this->authView(115);

		$title = I('get.title');
		$condition = array();
		if($title){
			$condition['title'] = array('LIKE', "%{$title}%");
		}

		$Article = D('Article');

		$totalCount = $Article->listCount('2',$condition);
		$Page = new \Org\Util\Page($totalCount);

		$sortInfo = get_sort_info();

		$activity = $Article->lists('2',$sortInfo,$Page->firstRow,$Page->listRows,$condition);

		cookie('return_url', $_SERVER['REQUEST_URI']);

		$this->assign('dataList', $activity);
		$this->display();
	}

	public function add(){
		$this->authView(115);

		if(IS_POST){

			$Article = D('Article');
			$data = $Article->create();

			if(!$data){
				$this->errorInput($Article->getError(), 'Activity/add');
			}

			$data['uid'] = session('uid');
			$data['category_id'] = '5';

			$id = $Article->data($data)->add();

			if(!$id){
				$this->errorMessage('添加失败', 'Activity/index');
			}

			$this->successMessage('添加成功', 'Activity/index');
		}
		
		$this->display();
	}

	public function edit(){
		$this->authView(116);
		if(IS_POST){

		}else{
			$id = I('id','0');
			if(empty($id)){
				$this->error('参数不正确');
			}
			$article = M('Article')->find($id);
			if(empty($article)){
				$this->error('数据不存在');
			}
			$this->assign('data', $article);
		}
		
		
		$this->display();
	}
	//更新
	public function update(){
		if(!IS_POST){
			$this->error('错误的请求类型');
		}

		$res = D('Article')->update();
		if(!$res){
			$this->errorMessage('更新失败','Activity/lists');
		}else{
			$this->successMessage('更新成功','Activity/lists');
		}
	}

	public function delete(){

		$id = I('id');
		if(empty($id)){
			$this->errorMessage('请选择要删除的记录', get_return_url(U('Activity/lists')));
		}

		$Article = M('Article');

		if(is_array($id)){
			$Article->where(array('id'=>array('IN', $id)))->delete();
		}else{
			$Article->where(array('id'=>(int)$id))->delete();
		}

		$this->successMessage('删除成功', get_return_url(U('Activity/lists')));
	}

	public function changeStatus($id, $status){
		$this->authView(116);
		$HouseSale = D('Article');

		$HouseSale->where(array('id'=>(int)$id))->setField('status', $status);

		$this->successMessage('操作成功', get_return_url(U('Activity/lists')));
	}
}
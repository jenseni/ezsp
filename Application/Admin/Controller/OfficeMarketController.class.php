<?php
namespace Admin\Controller;

class OfficeMarketController extends AdminController{
	
	public function lists(){
		$this->authView(114);
		
		$title = I('get.title');
		$condition = array();
		if($title){
			$condition['title'] = array('LIKE', "%{$title}%");
		}

		$Article = D('Article');
		
		$totalCount = $Article->listCount('1',$condition);
		$Page = new \Org\Util\Page($totalCount);

		$sortInfo = get_sort_info();

		$houseNews = $Article->lists('1',$sortInfo,$Page->firstRow,$Page->listRows,$condition);
		cookie('return_url', $_SERVER['REQUEST_URI']);

		$this->assign('dataList', $houseNews);
		$this->display();
	}

	public function index(){
		

		$Case = D('Officemarket');
		$res = $Case->relation(true)->select();
		echo json_encode($res);
		exit();

		$this->authView(109);
		$title = I('get.title');
		$condition = array();
		if($title){
			$condition['title'] = array('LIKE', "%{$title}%");
		}

		$Case = D('OfficeMarket');

		$totalCount = $Case->listCount($condition);
		$Page = new \Org\Util\Page($totalCount);

		$sortInfo = get_sort_info();

		$dataList = $Case>lists($sortInfo,$Page->firstRow,$Page->listRows,$condition);

		cookie('return_url', $_SERVER['REQUEST_URI']);

		$this->assign('dataList', $dataList);
		$this->display();
	}

	public function add(){
		$this->authView(109);

		if(IS_POST){

			$Article = D('Article');
			$data = $Article->create();

			if(!$data){
				$this->errorInput($Article->getError(), 'houseNews/add');
			}

			$data['uid'] = session('uid');

			$id = $Article->data($data)->add();

			if(!$id){
				$this->errorMessage('添加失败', 'HouseNews/index');
			}

			$this->successMessage('添加成功', 'HouseNews/index');
		}
		
		$this->display();
	}

	public function edit(){
		$this->authView(114);
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
			$this->errorMessage('更新失败','HouseNews/lists');
		}else{
			$this->successMessage('更新成功','HouseNews/lists');
		}
	}

	public function delete(){

		$id = I('id');
		if(empty($id)){
			$this->errorMessage('请选择要删除的记录', get_return_url(U('HouseNews/lists')));
		}

		$Article = M('Article');

		if(is_array($id)){
			$Article->where(array('id'=>array('IN', $id)))->delete();
		}else{
			$Article->where(array('id'=>(int)$id))->delete();
		}

		$this->successMessage('删除成功', get_return_url(U('HouseNews/lists')));
	}
}
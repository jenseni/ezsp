<?php
namespace Admin\Controller;

class WxMaterialController extends AdminController{
	public function lists(){
		$this->authView(126);

		$WxMaterial = M('WxMaterial');

		$dataList = $WxMaterial->select();

		cookie('return_url', $_SERVER['REQUEST_URI']);

		$this->assign('dataList', $dataList);	

		$this->display();
	}

	public function add(){
		$this->authView(126);
		if(IS_POST){
			$cover = get_first_img($_POST['content']);
			if($cover){
				$_POST['cover_url'] = $cover;
			}

			$Case = D('WxMaterial');
			$data = $Case->create();

			if(!$data){
				$this->errorInput($Case->getError(), 'WxMaterial/add');
			}

			$wx = $Case->find($data['id']);
			if(empty($wx)){
				$id = $Case->add();

				if(!$id){
					$this->errorMessage('添加失败', 'WxMaterial/lists');
				}

				$this->successMessage('添加成功', 'WxMaterial/lists');
			}else{
				$Case->data($data)->save();
				$this->successMessage('保存成功', 'WxMaterial/lists');
			}

		}
		$this->display();
	}

	public function edit($id){
		$this->authView(126);

		$Account = M('WxMaterial');
		$data = $Account->find($id);

		$this->assign('data', $data);

		$this->display('add');
	}

	public function delete(){
		$id = I('id');

		if(empty($id)){
			$this->errorMessage('请选择要删除的记录', get_return_url('WxMaterial/lists'));
		}

		$Case = M('WxMaterial');
		if(is_array($id)){
			$Case->where(array('id'=>array('IN', $id)))->delete();
		}else{
			$Case->delete($id);
		}

		$this->successMessage('删除成功', get_return_url('WxMaterial/lists'));
	}
}
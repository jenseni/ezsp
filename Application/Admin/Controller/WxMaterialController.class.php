<?php
namespace Admin\Controller;

class WxMaterialController extends AdminController{
	public function lists(){
		$this->authView(126);

		$WxMaterial = M('WxMaterial');

		$dataList = $WxMaterial->select();

		cookie('return_url', $_SERVER['REQUEST_URI']);

		$this->assign('dataList', $dataList);	

		$this->assign('wxnav',1);
		$this->display();
	}

	public function add(){
		$this->authView(126);
		$this->assign('wxnav',1);
		if(IS_POST){
			$WxMaterial = D('WxMaterial');
			$data = $WxMaterial->saveOrUpdate();
			if(!$data){
				$this->errorInput($WxMaterial->getError(), 'WxMaterial/add');
			}

			$this->successMessage('发布成功', 'WxMaterial/lists');
		}else{
			
			$this->display('add');
		}
	}

	public function additem(){
		$this->assign('wxnav',1);
		$this->display();
	}

	public function edit(){
		$this->authView(126);

		if(IS_POST){
			$WxMaterial = D('WxMaterial');
			$data = $WxMaterial->saveOrUpdate();
			if(!$data){
				$this->errorInput($WxMaterial->getError(), 'WxMaterial/edit');
			}

			$this->successMessage('修改成功', get_return_url('WxMaterial/lists'));
		}else{
			$WxMaterial = D('WxMaterial');
			$id = I('id');
			if(empty($id)){
				$this->error('参数不正确');
			}
			$data = $WxMaterial->find($id);
			if(empty($data)){
				$this->error('数据不存在');
			}

			/*$Picture = M('Picture');
			$picList = $Picture->field('id,path')->where(array('pid'=>$data['id'], 'type'=>1))->select();
			if(empty($picList)){
				$data['house_pic'] = '[]';
			}else{
				$data['house_pic'] = json_encode($picList);
			}*/

			$this->assign('data', $data);

			$this->display('add');
		}
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

	public function pictures(){
		$this->authView(126);
		$this->assign('wxnav',2);
		$pics = M('Picture');
		$condition['type'] = array('eq',9);
		$totalCount = $pics->where($condition)->count();

		$Page = new \Org\Util\Page($totalCount);
		$dataList = $pics->where('type = 9')
		->limit($Page->firstRow, $Page->listRows)
		->select();
		$this->assign('dataList',$dataList);
		$this->assign('page',$Page->show());
		$this->display();
	}
}
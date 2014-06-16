<?php
namespace Admin\Controller;

class CompanyController extends AdminController{

	public function edit(){
		$this->authView(104);

		$pagePath = C('STATIC_PAGE_PATH') . '/company.html';

		if(IS_POST){

			if(\Think\Storage::put($pagePath, $_POST['content'])){
				$this->successMessage('保存成功', 'Company/edit');
			}
			$this->errorMessage('保存失败', 'Company/edit');

		}else{

			if(\Think\Storage::has($pagePath)){
				$content = \Think\Storage::read($pagePath);
			}

			$this->assign('content', isset($content) ? $content : '');

			$this->display();
		}
	}
}
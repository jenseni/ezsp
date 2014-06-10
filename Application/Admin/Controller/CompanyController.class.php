<?php
namespace Admin\Controller;

class CompanyController extends AdminController{
	private $_articleId = 1;

	public function edit(){
		$this->authView(104);
		if(IS_POST){
			$Article = D('Article');
			$data = $Article->validate(array(
					array('title', 'require', '标题必须填写', 1),
					array('content', 'require', '内容必须填写', 1)
				))
				->create();

			if(!$data){
				$this->errorInput($Article->getError(), 'Company/edit');
			}

			$Article->save();

			$this->successMessage('保存成功', 'Company/edit');

		}else{
			$Article = M('Article');
			$article = $Article->find($_articleId);

			$this->assign('data', $article);

			$this->display();
		}
	}
}
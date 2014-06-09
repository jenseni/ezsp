<?php
namespace Admin\Controller;

class HouseSaleController extends AdminController{

	public function lists(){
		$this->authView(103);

		$this->display();
	}


	public function add(){
		$this->authView(102);

		$this->display('edit');
	}
}
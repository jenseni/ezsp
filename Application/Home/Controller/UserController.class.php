<?php
namespace Home\Controller;

use \Think\Controller;

class UserController extends HomeController{
	public function infosubmit(){
		if(IS_POST){

		}else{
			$this->display('infosubmit');
		}
	}
}
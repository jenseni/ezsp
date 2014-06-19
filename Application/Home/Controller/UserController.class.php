<?php
namespace Home\Controller;

use \Think\Controller;

class UserController extends HomeController{
	
	public function infosubmit(){
		if(IS_POST){
			
			if($this->check_verify($_POST['verify'])){

				$Info = M('InfoSubmit');
				$data = $Info->create();

				if(!$data){
					$this->errorInput($Info->getError(), 'User/infosubmit');
				}

				$data['create_time'] = time();
				$data['status'] = 0;

				//echo json_encode($data); exit();

				$id = $Info->data($data)->add();

				if($id){
					$this->assign('message', '提交成功，经纪人查看后会及时联系您，谢谢您的关注。');
				}else{
					$this->assign('message','提交失败，请联系客服');
				}
			}else{
				$this->assign('message','验证码输入错误');
			}			
		}

		$this->display('infosubmit');

	}

	Public function verify(){
	    $Verify = new \Think\Verify();
		$Verify->entry();
	}

	Public function check_verify($code, $id = ''){
	    $verify = new \Think\Verify();
	    return $verify->check($code, $id);
	}
}
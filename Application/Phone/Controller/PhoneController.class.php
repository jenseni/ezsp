<?php
namespace Phone\Controller;

use \Think\Controller;

class PhoneController extends Controller{
	protected function _initialize(){
		$this->city = get_current_city();
	}
}
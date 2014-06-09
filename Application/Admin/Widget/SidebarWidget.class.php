<?php
namespace Admin\Widget;

use \Think\Controller;

class SidebarWidget extends Controller{
	public function showMenu(){
		$menuList = $this->getUserMenu(get_login_user());

		if(empty($menuList)){
			return;
		}

		$html = '<div class="list-group">';

		foreach ($menuList as $value) {
			$html .= "<a href=\"".U($value['action'])."\" class=\"list-group-item";

			if(preg_match("/".CONTROLLER_NAME."\/\\w+/i", $value['action'])){
				$html .= " active";
			}

			$html .= "\"><span class=\"{$value['icon']}\"></span> {$value['name']}</a>";
		}

		$html .= '</div>';

		return $html;
	}

	protected function getUserMenu($user){
		if(empty($user)){
			E('请先登录');
		}

		$resultList = array();

		if(!isset($user['auth']) || empty($user['auth'])){
			return $resultList;
		}

		$menuList = C('SYS_MENU');

		if(empty($menuList)){
			return $resultList;
		}

		foreach ($menuList as $value) {
			if($value['id'] > 10000){
				$resultList[] = $value;
				continue;
			}

			if(!isset($value['children']) || empty($value['children'])){
				continue;
			}

			foreach ($value['children'] as $val) {
				if(has_auth($user, $val['id'])){
					$value['action'] = $val['action'];
					$resultList[] = $value;
					break;
				}
			}
		}

		return $resultList;
	}
}
<?php
namespace Admin\Widget;

use \Think\Controller;

class AuthWidget extends Controller{
	public function showMenu($user, $currentView){
		if(empty($user) || !isset($user['menuList']) || empty($user['menuList'])){
			return;
		}

		$html = '<div class="list-group">';

		foreach ($user['menuList'] as $menu) {
			$active = false;

			if(isset($menu['children']) && !empty($menu['children'])){
				for($i = 0, $count = count($menu['children']); $i < $count; $i++){
					$view = $menu['children'][$i];
					if($i === 0){
						$menu['action'] = $view['action'];
					}
					if($currentView == $view['id']){
						$menu['action'] = $view['action'];
						$active = true;
						break;
					}
				}
			}

			$html .= "<a href=\"".U($menu['action'])."\" class=\"list-group-item";
			if($active){
				$html .= ' active';
			}
			$html .= "\"><span class=\"{$menu['icon']}\"></span> {$menu['name']}</a>";
		}

		$html .= '</div>';

		return $html;
	}

	public function showTab($user, $currentView){
		if(empty($user) || !isset($user['menuList']) || empty($user['menuList'])){
			return;
		}

		$html = '<ul class="nav nav-tabs nav-channel">';

		foreach ($user['menuList'] as $menu) {
			if(isset($menu['children']) && !empty($menu['children'])){
				$current = false;
				foreach ($menu['children'] as $view) {
					if($currentView == $view['id']){
						$current = true;
					}
				}

				if($current){
					foreach ($menu['children'] as $view) {
						$html .= '<li';
						$href = U($view['action']);
						if($currentView == $view['id']){
							$html .= ' class="active"';
							$href = 'javascript:;';
						}
						$html .= '>';
						$html .= "<a href=\"{$href}\"><span class=\"{$view['icon']}\"></span> {$view['name']}</a>";
						$html .= '</li>';
					}
					break;
				}
			}
		}

		$html .= '</ul>';

		return $html;
	}
}
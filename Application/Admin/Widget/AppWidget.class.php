<?php
namespace Admin\Widget;

use \Think\Controller;

class AppWidget extends Controller{

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
			$html .= "\"><span class=\"{$menu['icon']}\"></span>&nbsp;&nbsp;{$menu['name']}";
			if($active){
				$html .= '<span class="selected"></span>';
			}
			$html .= "</a>";
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

	public function token(){
		//if(C('TOKEN_ON')){
			list($tokenName,$tokenKey,$tokenValue)=$this->getToken();
			$input_token = '<input type="hidden" name="'.$tokenName.'" value="'.$tokenKey.'_'.$tokenValue.'" />';
			return $input_token;
		//}
	}

	public function searchInput($name, $value, $label, $htmlOptions = array()){
		$html = '<div class="form-group">';
		$html .= "<label>{$label}：</label>";
		$html .= "<input type=\"text\" name=\"{$name}\" value=\"{$value}\" class=\"form-control input-sm\"/>";
		$html .= '</div>';

		return $html;
	}

	public function searchSelect($name, $value, $type, $label, $htmlOptions){
		$optionList = get_lookup_list($type);
		array_unshift($optionList, array('name'=>'', 'val'=>$label));

		$html = '<div class="form-group">';
		$html .= "<select class=\"form-control input-sm\" name=\"$name\"/>";
		foreach ($optionList as $opt) {
			$html .= "<option value=\"{$opt['name']}\"";
			if($value == $opt['name']){
				$html .= ' selected';
			}
			$html .= ">{$opt['val']}</option>";
		}
		$html .= '</select>';
		$html .= '</div>';

		return $html;
	}

	public function sortColumn($name, $label){
		$sortInfo = I('sort');
		list($field, $dir) = explode('-', $sortInfo);

		$nextDir = 'asc';
		
		if($field == $name){
			if($dir == 'desc'){
				$nextDir = 'asc';
			}else{
				$nextDir = 'desc';
			}
		}else{
			$dir = '';
		}

		$get = $_GET;

		$get['sort'] = "{$name}-{$nextDir}";
		//重置分页
		$get[C('VAR_PAGE') ? C('VAR_PAGE') : 'p'] = 1;

		$href = U(ACTION_NAME, $get);
		$html = "<th class=\"sortable\" href=\"{$href}\">{$label}";
		if($dir == 'asc'){
			$html .= ' <i class="icon-sort-up"></i>';
		}elseif($dir == 'desc'){
			$html .= ' <i class="icon-sort-down"></i>';
		}else{
			$html .= ' <i class="icon-sort"></i>';
		}
		$html .= '</th>';

		return $html;
	}

	public function showRegionSelect($city, $area, $busiArea, $label = '区域', $layout = '1:11', $fieldErrors){
		$tmpCity = array('id'=>'', 'name'=>'城市');
		$tmpArea = array('id'=>'', 'name'=>'区域');
		$tmpBusiArea = array('id'=>'', 'name'=>'商圈');

		list($labelSpace, $controlSpace) = explode(':', $layout);

		$html = '<div class="form-group';

		if(isset($fieldErrors) && (isset($fieldErrors['city']) || isset($fieldErrors['area']) || isset($fieldErrors['busi_area']))){
			$html .= ' has-error';
		}

		$html .= '">';
		if($label){
			$html .= "<label class=\"control-label";
			if($labelSpace){
				$html .= " col-sm-{$labelSpace}";
			}
			$html .= "\">{$label}</label>";
		}

		if($controlSpace){
			$html .= "<div class=\"col-sm-{$controlSpace} control-inline\">";
		}

		$District = D('District');
		$cityList = $District->cityList();
		array_unshift($cityList, $tmpCity);
		$html .= '<select id="city" name="city" class="form-control">';
		foreach ($cityList as $value) {
			$html .= "<option value=\"{$value['id']}\"";
			if($city == $value['id']){
				$html .= ' selected';
				$curCity = $value;
			}
			$html .= ">{$value['name']}</option>";
		}
		$html .= '</select>';

		$areaList = array();
		if(isset($curCity) && $curCity['id']){
			$areaList = $District->getAreaOfCity($curCity['id']);
		}

		array_unshift($areaList, $tmpArea);

		$html .= '<select id="area" name="area" class="form-control">';
		foreach ($areaList as $value) {
			$html .= "<option value=\"{$value['id']}\"";
			if($area == $value['id']){
				$html .= ' selected';
				$curArea = $value;
			}
			$html .= ">{$value['name']}</option>";
		}
		$html .= '</select>';

		$busiAreaList = array();

		if(isset($curArea) && $curArea['id']){
			$busiAreaList = $District->getChild($curArea['id']);
		}

		array_unshift($busiAreaList, $tmpBusiArea);

		$html .= '<select id="busi_area" name="busi_area" class="form-control">';
		foreach ($busiAreaList as $value) {
			$html .= "<option value=\"{$value['id']}\"";
			if($busiArea == $value['id']){
				$html .= ' selected';
			}
			$html .= ">{$value['name']}</option>";
		}
		$html .= '</select>';

		if(isset($fieldErrors)){
			$errorText = '';
			if(isset($fieldErrors['city'])){
				$errorText .= $fieldErrors['city'];
			}
			if(isset($fieldErrors['area'])){
				$errorText .= (empty($errorText) ? '' : ',') . $fieldErrors['area'];
			}
			if(isset($fieldErrors['busi_area'])){
				$errorText .= (empty($errorText) ? '' : ',') . $fieldErrors['busi_area'];
			}
			$html .= "<span class=\"help-block small\">{$errorText}</span>";
		}

		if($controlSpace){
			$html .= '</div>';
		}

		$html .= '</div>';

		return $html;

	}

	public function lookupSelect($name, $value, $type, $first=false){
		$lookupList = get_lookup_list($type);
		if(empty($lookupList)){
			$lookupList = array();
		}

		if($first){
			if(is_array($first)){
				array_unshift($lookupList, $first);
			}else{
				array_unshift($lookupList, array('name'=>'', 'val'=>$first));
			}
		}

		$html = "<select id=\"{$name}\" name=\"{$name}\" class=\"form-control\">";
		foreach ($lookupList as $lu) {
			$html .= "<option value=\"{$lu['name']}\"";
			if($lu['name'] == $value){
				$html .= ' selected';
			}
			$html .= ">{$lu['val']}</option>";
		}
		$html .= '</select>';

		return $html;
	}

	public function lookupRadio($name, $value, $type, $htmlOptions=array()){
		$lookupList = get_lookup_list($type);
		if(empty($lookupList)){
			return;
		}
		$html = '';
		foreach ($lookupList as $lu) {
			$html .= '<label class="radio-inline"';
			if(isset($htmlOptions['lable'])){
				foreach ($htmlOptions['label'] as $key => $val) {
					$html .= " {$key}={$val}";
				}
			}
			$html .= '>';
			$html .= "<input type=\"radio\" name=\"{$name}\" value=\"{$lu['name']}\"";
			if($value == $lu['name']){
				$html .= ' checked';
			}
			if(isset($htmlOptions['input'])){
				foreach ($htmlOptions['input'] as $key => $val) {
					$html .= " {$key}={$val}";
				}
			}
			$html .= '/> ' . $lu['val'];
			$html .= '</label>';
		}

		return $html;
	}

	public function showTag($name, $value, $count=4, $label, $layout='1:11'){
		list($labelSpace, $controlSpace) = explode(':', $layout);
		$tagList = explode(',', $value);

		$html = '<div class="form-group">';
		$html .= '<label class="control-label';
		if($labelSpace){
			$html .= ' col-sm-'.$labelSpace;
		}
		$html .= '">' . $label . '</label>';
		$html .= '<div class="control-inline';
		if($controlSpace){
			$html .= ' col-sm-'.$controlSpace;
		}
		$html .= '">';

		for($i = 0; $i < $count; $i++){
			$html .= "<input type=\"text\" name=\"{$name}[]\" value=\"";
			if(isset($tagList[$i])){
				$html .= $tagList[$i];
			}
			$html .= '" class="form-control"/>';
		}

		$html .= '</div>';
		$html .= '</div>';

		return $html;
	}


	/**
	 * 获得token
	 * copied from ThinkPHP TokenBuilderBehaviors.class.php
	 */
	private function getToken(){
		$tokenName  = C('TOKEN_NAME',null,'__hash__');
		$tokenType  = C('TOKEN_TYPE',null,'md5');
		if(!isset($_SESSION[$tokenName])) {
			$_SESSION[$tokenName]  = array();
		}
		// 标识当前页面唯一性
		$tokenKey   =  md5($_SERVER['REQUEST_URI']);
		if(isset($_SESSION[$tokenName][$tokenKey])) {// 相同页面不重复生成session
			$tokenValue = $_SESSION[$tokenName][$tokenKey];
		}else{
			$tokenValue = $tokenType(microtime(TRUE));
			$_SESSION[$tokenName][$tokenKey]   =  $tokenValue;
			if(IS_AJAX && C('TOKEN_RESET',null,true))
			header($tokenName.': '.$tokenKey.'_'.$tokenValue); //ajax需要获得这个header并替换页面中meta中的token值
		}
		return array($tokenName,$tokenKey,$tokenValue); 
	}
}
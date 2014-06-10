<?php
namespace Admin\Widget;

use \Think\Controller;

class AppWidget extends Controller{

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
		}

		$_GET['sort'] = "{$name}-{$nextDir}";
		//重置分页
		$_GET[C('VAR_PAGE') ? C('VAR_PAGE') : 'p'] = 1;

		$href = U(ACTION_NAME, $_GET);
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
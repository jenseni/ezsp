<?php
namespace Phone\Widget;

use \Think\Controller;

class PhoneWidget extends Controller{
	public function showLookupFilter($name, $label, $type, $current){
		$lookupList = get_lookup_list($type);

		if(empty($lookupList)){
			return;
		}

		array_unshift($lookupList, array('name'=>'0', 'val'=>'全部'));

		if(!$current){
			$current = '0';
		}

		$html = '<div class="panel">';
		$html .= '<div class="panel-title"><span class="icon">|</span> '.$label.'</div>';
		$html .= '<ul class="filter-group">';
		foreach ($lookupList as $lu) {
			$html .= '<li';
			if($lu['name'] == $current){
				$html .= ' class="active"';
			}
			$html .= '>';
			$html .= '<a href="javascript:;" target-name="'.$name.'" data-id="'.$lu['name'].'">'.$lu['val'].'</a>';
			$html .= '</li>';
		}
		$html .= '</ul></div>';

		return $html;
	}

	// public function showAreaFilter($city, $current = '0'){
	// 	if(is_array($city)){
	// 		$city = $city['id'];
	// 	}

	// 	$areaList = \Home\Model\DistrictModel::getAreaOfCity($city);

	// 	array_unshift($areaList, array('name'=>'全部','id'=>'0'));

	// 	if($current != '0'){
	// 		$District = new \Home\Model\DistrictModel;
	// 		$currentArea = $District->find((int)$current);

	// 		$map = array('inactive'=>'N');
	// 		if($currentArea['type'] == \Home\Model\DistrictModel::TYPE_AREA){
	// 			$map['pid'] = $currentArea['id'];
	// 		}else if($currentArea['type'] == \Home\Model\DistrictModel::TYPE_BUSI_AREA){
	// 			$map['pid'] = $currentArea['pid'];
	// 		}

	// 		$busiAreaList = $District->field(true)->where($map)->select();

	// 		array_unshift($busiAreaList, array('name'=>'全部','id'=>$map['pid']));
	// 	}

	// 	$html = '<div class="panel area">';
	// 	$html .= '<div class="panel-title"><span class="icon">|</span> 区域</div>';
	// 	$html .= '<ul class="filter-group">';

	// 	foreach($areaList as $area){
	// 		$html .= '<li';
	// 		if($current == $area['id']){
	// 			$html .= ' class="active"';
	// 		}elseif(isset($currentArea)){
	// 			if($currentArea['id'] == $area['id'] || $currentArea['pid'] == $area['id']){
	// 				$html .= ' class="active"';
	// 			}
	// 		}
	// 		$html .= '>';
	// 		$html .= "<a href=\"javascript:;\" area-id=\"{$area['id']}\">{$area['name']}</a>";
	// 		$html .= '</li>';
	// 	}
	// 	$html .= '</ul></div>';

	// 	if(isset($busiAreaList) && !empty($busiAreaList)){
	// 		$html .= '<div class="panel busi-area">';
	// 		$html .= '<div class="panel-title"><span class="icon">|</span> 商圈</div>';
	// 		$html .= '<ul class="filter-group">';
	// 		foreach($busiAreaList as $busiArea){
	// 			$html .= '<li';
	// 			if($busiArea['id'] == $current){
	// 				$html .= ' class="active"';
	// 			}
	// 			$html .= '>';
	// 			$html .= "<a href=\"javascript:;\">{$busiArea['name']}</a>";
	// 			$html .= '</li>';
	// 		}
	// 		$html .= '</ul></div>';
	// 	}

	// 	return $html;
	// }

	public function showAreaFilter($city, $current = '0'){
		if(is_array($city)){
			$city = $city['id'];
		}

		if(!$current){
			$current = '0';
		}

		$areaList = \Home\Model\DistrictModel::getAreaOfCity($city);

		array_unshift($areaList, array('name'=>'全部','id'=>'0'));

		if($current != '0'){
			$District = new \Home\Model\DistrictModel;
			$currentArea = $District->find((int)$current);

			$map = array('inactive'=>'N');
			if($currentArea['type'] == \Home\Model\DistrictModel::TYPE_AREA){
				$map['pid'] = $currentArea['id'];
			}else if($currentArea['type'] == \Home\Model\DistrictModel::TYPE_BUSI_AREA){
				$map['pid'] = $currentArea['pid'];
			}

			$busiAreaList = $District->field(true)->where($map)->select();

			array_unshift($busiAreaList, array('name'=>'全部','id'=>$map['pid']));
		}

		foreach($areaList as &$area){
			if($current == $area['id']){
				$area['active'] = true;
			}elseif(isset($currentArea)){
				if($currentArea['id'] == $area['id'] || $currentArea['pid'] == $area['id']){
					$area['active'] = true;
				}
			}
		}

		if(isset($busiAreaList) && !empty($busiAreaList)){
			foreach($busiAreaList as &$busiArea){
				if($busiArea['id'] == $current){
					$busiArea['active'] = true;
				}
			}
		}

		$this->assign('areaList', $areaList);
		$this->assign('busiAreaList', $busiAreaList);

		$this->display('Widget/districtFilter');
	}

	public function showFilterClick(){
		$args = func_get_args();
		if(empty($args)){
			return ;
		}
		$this->assign('inputs', $args);
		
		$this->display('Widget/filterClick');
	}

}
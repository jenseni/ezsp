<?php
namespace Home\Widget;

use Think\Controller;
use Home\Model\DistrictModel;

class DistrictWidget extends Controller{
	public function showFilter($url, $city, $curArea = '0'){
		if($curArea == '0'){
			$curArea = I('area', '0');
		}

		if(is_array($city)){
			$city = $city['id'];
		}

		$html = '<ul class="filter-row">';

		$areaList = DistrictModel::getAreaOfCity($city);

		array_unshift($areaList, array('name'=>'全部','id'=>'0'));

		if($curArea != '0'){
			$District = D('District');
			$currentArea = $District->find((int)$curArea);

			$map = array('inactive'=>'N');
			if($currentArea['type'] == DistrictModel::TYPE_AREA){
				$map['pid'] = $currentArea['id'];
			}else if($currentArea['type'] == DistrictModel::TYPE_BUSI_AREA){
				$map['pid'] = $currentArea['pid'];
			}

			$busiAreaList = $District->field(true)->where($map)->select();

			array_unshift($busiAreaList, array('name'=>'全部','id'=>$map['pid']));
		}

		foreach($areaList as $area){
			$html .= '<li';
			if($curArea == $area['id']){
				$html .= ' class="active"';
			}elseif(isset($currentArea)){
				if($currentArea['id'] == $area['id'] || $currentArea['pid'] == $area['id']){
					$html .= ' class="active"';
				}
			}
			$html .= '>';
			$href = str_replace('[area]', $area['id'], $url);
			$html .= "<a href=\"{$href}\">{$area['name']}</a>";
			$html .= '</li>';
		}
		$html .= '</ul>';

		if(isset($busiAreaList) && !empty($busiAreaList)){
			$html .= '<ul class="filter-row busi-area">';
			foreach($busiAreaList as $busiArea){
				$html .= '<li';
				if($busiArea['id'] == $curArea){
					$html .= ' class="active"';
				}
				$html .= '>';
				$href = str_replace('[area]', $busiArea['id'], $url);
				$html .= "<a href=\"{$href}\">{$busiArea['name']}</a>";
				$html .= '</li>';
			}
			$html .= '</ul>';
		}

		return $html;
	}

	public function showCityFilter($url, $city){
		if(is_array($city)){
			$city = $city['id'];
		}
		$cityList = DistrictModel::cityList();
		$html = '<ul class="filter-row">';
		foreach($cityList as $ct){
			$html .= '<li';
			if($city == $ct['id']){
				$html .= ' class="active"';
			}
			$html .= '>';
			$href = str_replace('[city]', $ct['id'], $url);
			$html .= "<a href=\"{$href}\">{$ct['name']}</a>";

		}
		$html .= '</ul>';

		return $html;
	}

	public function showSelect($city, $curArea = '', $curBusiArea = ''){
		if(is_array($city)){
			$city = $city['id'];
		}
		$areaList = DistrictModel::getChild($city);
		if(empty($areaList)){
			return '';
		}
		$areaIdList = array();
		$html = '<select id="area" name="area"><option value="">区域</option>';
		foreach($areaList as $area){
			$areaIdList[] = $area['id'];
			$html .= "<option value=\"{$area['id']}\"";
			if($curArea == $area['id']){
				$html .= ' selected';
			}
			$html .= ">{$area['name']}</option>";
		}
		$html .= '</select>';

		$busiAreaList = DistrictModel::getChild($areaIdList);
		if(!empty($busiAreaList)){
			$html .= '<select id="busi_area" name="busi_area"><option value="">商区</option>';
			foreach($busiAreaList as $busiArea){
				$html .= "<option value=\"{$busiArea['id']}\" class=\"{$busiArea['pid']}\"";
				if($curBusiArea == $busiArea['id']){
					$html .= ' selected';
				}
				$html .= ">{$busiArea['name']}</option>";
			}
			$html .= '</select>';
		}

		return $html;
	}
}
<?php

function get_lookup_list($type){
	return D('Lookup')->getList($type);
}

function get_lookup_value($type, $name){
	return D('Lookup')->getValue($type, $name);
}

function default_value($value, $default = ''){
	if(isset($value) && !empty($value)){
		return $value;
	}
	return $default;
}

function get_first_img($content){
	if(empty($content)){
		return false;
	}

	preg_match("<img.+src=[\"\'](.*?)[\"\'].*?>", $content, $match);

	if(isset($match[1])){
		return $match[1];
	}
}

function get_string_diy($str,$len){
	
	if (strlen($str) > $len)
	{
		$str = mb_substr($str,0,$len)."···";
	}
	return $str; 
}

function get_img($src, $width = 0, $height = 0, $water = false, $defaultImg = '/Public/images/noimg.png'){
	if(strpos($src, 'http://') === 0 || !preg_match('/\.(jpeg|jpg|gif|png)$/i', $src)){
		return $src;
	}

	$path = $src;
	if(strpos($path, '/') === 0){
		$path = '.' . $path;
	}

	if(preg_match('/\S+_\d+_\d+\.(jpeg|jpg|gif|png)$/i', $path)){
		preg_match('/_(\d+)_(\d+)\.(jpeg|jpg|gif|png)$/i', $path, $matchs);
		if(isset($matchs[1]) && $width == 0){
			$width = $matchs[1];
		}
		if(isset($matchs[2]) && $height == 0){
			$height = $matchs[2];
		}

		$path = preg_replace('/(.+)(_\d+_\d+)\.(jpeg|jpg|gif|png)$/i', '$1.$3', $path);
	}

	if(!is_file($path)){
		return __ROOT__ . $defaultImg;
	}

	$pathInfo = pathinfo($path);
	if(preg_match('/_\d+_\d+$/', $pathInfo['filename']) || $width == 0 || $height == 0){
		$resultPath = $pathInfo['dirname'] . '/runtime/' . $pathInfo['basename'];
	}else{
		$resultPath = $pathInfo['dirname'] . '/runtime/' . $pathInfo['filename'] . "_{$width}_{$height}." . $pathInfo['extension'];
	}

	if(is_file($resultPath)){
		return __ROOT__ . (substr($resultPath, strpos($resultPath, '/')));
	}

	if(!is_dir($pathInfo['dirname'] . '/runtime') && !mkdir($pathInfo['dirname'] . '/runtime', 0777, true)){
		return __ROOT__ . $defaultImg;
	}

	if(($width != 0 && $height != 0) || $water != false){
		$image = new \Think\Image();
		$image->open($path);
		if($water){
			if(!is_string($water)){
				$water = './Public/images/house_warter.png';
			}
			$image->water($water, \Think\Image::IMAGE_WATER_NORTHWEST);
		}
		if($width != 0 && $height != 0){
			$image->thumb($width, $height, \Think\Image::IMAGE_THUMB_CENTER);
		}

		$image->save($resultPath);
	}

	return __ROOT__ . (substr($resultPath, strpos($resultPath, '/')));

}

function list_to_tree($list, $pk = 'id', $pid = 'pid', $child = '_child', $root = -1){
	// 创建Tree
	$tree = array();
	if (is_array($list)) {
		// 创建基于主键的数组引用
		$refer = array();
		foreach ($list as $key => $data) {
			$refer[$data[$pk]] =& $list[$key];
		}
		foreach ($list as $key => $data) {
			// 判断是否存在parent
			$parentId = $data[$pid];
			if ($root == $parentId) {
				$tree[] =& $list[$key];
			} else {
				if (isset($refer[$parentId])) {
					$parent =& $refer[$parentId];
					$parent[$child][] =& $list[$key];
				}
			}
		}
	}
	return $tree;
}
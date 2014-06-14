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
        for($i=0; $i < $len; $i++)
        if (ord($str[$i]) > 127)    $i++;
        $str = substr($str,0,$i)."···";
    }
	return $str;
}
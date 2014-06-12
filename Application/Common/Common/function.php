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

function format_time(){}
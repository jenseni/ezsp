<?php

function get_current_city(){
	return array('id'=>517, 'name'=>'大连');
}

function get_p_area($area_id){
	$case = M('district');
	$data = $case->find($area_id);
	if($data['pid'] != 517){
		$f_data = $case->find($data['pid']);
	}
	return $f_data['name'].$data['name'];
}

function get_p_lookup($lookup_code,$lookup_name){
	$case = M('lookup');
	$map['type'] = array('eq',$lookup_code);
	$map['name'] = array('eq',$lookup_name);

	$data = $case->where($map)->find();
	return $data['val'];
}
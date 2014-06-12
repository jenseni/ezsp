<?php

function get_lookup_list($type){
	return D('Lookup')->getList($type);
}

function get_lookup_value($type, $name){
	return D('Lookup')->getValue($type, $name);
}
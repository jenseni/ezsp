<?php
namespace Common\Model;

use Think\Model;

class LookupModel extends Model{

	private static $_cache = array();

	public function getList($type){
		$nvList = D('Lookup')
			->field('name,val')
			->where(array('type'=>$type, 'inactive'=>'N'))
			->order('seq_num')
			->select();

		return $nvList;
	}

	public function getValue($type, $name){
		if(isset(static::$_cache[$type])){
			return isset(static::$_cache[$type][$name]) ? static::$_cache[$type][$name] : $name;
		}

		$nvList = D('Lookup')
			->field('name,val')
			->where(array('type'=>$type, 'inactive'=>'N'))
			->select();

		if(empty($nvList)){
			return null;
		}

		foreach($nvList as $nv){
			static::$_cache[$type][$nv['name']] = $nv['val'];
		}

		return isset(static::$_cache[$type][$name]) ? static::$_cache[$type][$name] : $name;

	}
}
<?php
namespace Common\Model;

use Think\Model;

class LookupModel extends Model{

	private static $_cache = array();

	public function getList($type){
		if(!isset(static::$_cache[$type])){
			static::$_cache[$type] = D('Lookup')
				->field('name,val')
				->where(array('type'=>$type, 'inactive'=>'N'))
				->order('seq_num')
				->select();
		}

		return static::$_cache[$type];
	}

	public function getValue($type, $name){
		if(!isset(static::$_cache[$type])){
			$this->getList($type);
		}
		
		if(!empty(static::$_cache[$type])){
			foreach(static::$_cache[$type] as $lu){
				if($name == $lu['name']){
					return $lu['val'];
				}
			}
		}

		return $name;

	}
}
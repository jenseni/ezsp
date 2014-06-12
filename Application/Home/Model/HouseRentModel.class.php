<?php
namespace Home\Model;

use \Think\Model;

class HouseRentModel extends Model{

	protected $tableName = 'houserent';

	public function listForIndex($city, $count = 4){
		if(is_array($city)){
			$city = $city['id'];
		}

		return $this->alias('h')
			->field('h.id,h.thumbnail,h.price,h.decorate,area.name area_name, busi_area.name busi_area_name')
			->join('__DISTRICT__ area on area.id=h.area', 'LEFT')
			->join('__DISTRICT__ busi_area on busi_area.id=h.busi_area', 'LEFT')
			->where(array('h.city'=>$city, 'h.status'=>array('NEQ', 0)))
			->order('id desc')
			->limit($count)
			->select();
	}
}
<?php
namespace Home\Model;

use \Think\Model;

class HouseSaleModel extends Model{

	protected $tableName = 'housesale';

	public function listForIndex($city, $count = 4){
		if(is_array($city)){
			$city = $city['id'];
		}

		return $this->alias('h')
			->field('h.id,h.thumbnail,h.price,h.square,h.bed_room,h.live_room,area.name area_name, busi_area.name busi_area_name')
			->join('__DISTRICT__ area on area.id=h.area', 'LEFT')
			->join('__DISTRICT__ busi_area on busi_area.id=h.busi_area', 'LEFT')
			->where(array('h.city'=>$city, 'h.status'=>array('NEQ', 0)))
			->order('id desc')
			->limit($count)
			->select();
	}
}
<?php
namespace Home\Model;

use \Think\Model;

class AgentMarketModel extends Model{
	protected $tableName = 'agentmarket';

	public function detail($id){
		$data = $this->find($id);
		if(!empty($data)){
			$Picture = M('Picture');
			$picList = $Picture->alias('p')
				->field('p.id,p.path,ap.type,ap.desc_txt')
				->join('__AGENTMARKET_PIC__ ap on ap.id=p.id', 'LEFT')
				->where(array('p.pid'=>$data['id'], 'p.type'=>5))
				->select();

			$data['house_pic'] = array();
			$data['roomTypePicList'] = array();
			if(!empty($picList)){
				foreach ($picList as $pic) {
					if(isset($pic['type'])){
						if($pic['type'] == 1){
							$data['roomTypePicList'][] = $pic;
						}
					}else{
						$data['house_pic'][] = $pic;
					}
				}
			}
		}

		return $data;
	}
}
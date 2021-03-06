<?php
namespace Admin\Model;

use \Think\Model;

class DistrictModel extends Model{

	const TYPE_PROVINCE = 1;
	const TYPE_CITY = 2;
	const TYPE_PCITY = 12; //直辖市
	const TYPE_PAREA = 21; //市辖区
	const TYPE_PAREA2 = 22; //县
	const TYPE_AREA = 3;
	const TYPE_BUSI_AREA = 4; //商区

	protected $patchValidate = true;

	protected $_validate = array(
		array('pid', 'require', '上级区域不能为空', self::MUST_VALIDATE),
		array('name', 'require', '请填写区域名称', self::MUST_VALIDATE),
		array('inactive', 'Y,N', '是否失效不正确', self::MUST_VALIDATE, 'in'),
		array('type', 'require', '类型不能为空', self::MUST_VALIDATE)
	);

	public function getChild($pid){
		$this->field('id,pid,name,type');
		$map['inactive'] = 'N';
		if(is_array($pid)){
			$map['pid'] = array('in', $pid);
		}else{
			$map['pid'] = (int)$pid;
		}
		return $this->where($map)->select();
	}

	public function getAreaOfCity($city){

		$areaList = array();

		if(empty($city)){
			return $areaList;
		}

		$districtList = $this->getChild($city);

		if(empty($districtList)){
			return $areaList;
		}

		foreach($districtList as $district){
			if($district['type'] == self::TYPE_PAREA || $district['type'] == self::TYPE_PAREA2){
				continue;
			}
			if($district['type'] == self::TYPE_AREA){
				$areaList[] = $district;
			}elseif($districtList == self::TYPE_PCITY){
				$areaList = array_combine($areaList, $this->getChild($district['id']));
			}
		}

		return $areaList;
	}

	public function getCityByChild($area){
		$district = $this->field('id,pid,name,type')->find($area);

		if(empty($district) || $district['type'] <= self::TYPE_PROVINCE){
			return C('DEFAULT_CITY');
		}

		if($district['type'] == self::TYPE_CITY || $district['type'] == self::TYPE_PCITY){
			return $district;
		}

		return $this->getCitiByChild($district['pid']);
		
	}

	public function getTree($root, $leafType){
		return $this->where(array('type'=>array('in', '2,12')))->select();

	}

	public function cityList(){
		
		return $this->where(array('type'=>self::TYPE_CITY, 'inactive'=>'N'))->select();
	}
}

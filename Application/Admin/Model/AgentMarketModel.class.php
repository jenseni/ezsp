<?php
namespace Admin\Model;

class AgentMarketModel extends HouseModel{
	protected $tableName = 'agentmarket';
	
	protected $patchValidate = true;

	protected $_validate = array(
		array('title', 'require', '楼盘名称不能为空', self::MUST_VALIDATE, 'regex', self::MODEL_BOTH),
		array('title', '1,80', '楼盘名称长度不能超过80个字符', self::MUST_VALIDATE, 'length', self::MODEL_BOTH),
		array('price_avg', 'require', '请填写均价', self::MUST_VALIDATE),
		array('price_avg', 'integer', '均价只能是整数', self::MUST_VALIDATE, 'regex'),
		array('price_avg2', 'require', '请填写公建均价', self::MUST_VALIDATE),
		array('price_avg2', 'integer', '公建均价只能是整数', self::MUST_VALIDATE, 'regex'),
		array('down_payment', 'require', '请填写首付', self::MUST_VALIDATE),
		array('down_payment', 'integer', '首付只能是整数', self::MUST_VALIDATE, 'regex'),
		array('down_payment_max', 'integer', '首付上限只能是整数', self::VALUE_VALIDATE, 'regex'),
		array('monthly', 'require', '请填写月供', self::MUST_VALIDATE),
		array('monthly', 'integer', '月供只能是整数', self::MUST_VALIDATE, 'regex'),
		array('monthly_max', 'integer', '月供上限只能是整数', self::MUST_VALIDATE, 'regex'),
		array('contact_tel', 'require', '请填写电话', self::MUST_VALIDATE),
		array('city', 'require', '请选择城市', self::MUST_VALIDATE),
		array('area', 'require', '请选择区域', self::MUST_VALIDATE),
		array('busi_area', 'require', '请选择商圈', self::MUST_VALIDATE),
		array('traffic', 'require', '请填写交通状况', self::MUST_VALIDATE),
		array('property_right', 'require', '请选择产权类型', self::MUST_VALIDATE),
		array('open_time', 'require', '请填写开盘时间', self::MUST_VALIDATE),
		array('in_time', 'require', '请填写入住时间', self::MUST_VALIDATE),
		array('room_count', 'require', '请填写户数', self::MUST_VALIDATE),
		array('room_count', 'integer', '请填写户数', self::MUST_VALIDATE, 'regex')
	);

	protected $_auto = array(
		array('create_time', NOW_TIME, self::MODEL_INSERT),
		array('status', 0, self::MODEL_INSERT),
		array('uid', 'is_login', self::MODEL_INSERT, 'function')
	);

	public function saveOrUpdate(){
		$_POST['feature'] = array2string($_POST['feature']);

		$data = $this->create();
		
		if(!$data){
			return false;
		}

		if(isset($data['id'])){
			$this->save();
		}else{
			$data['id'] = $this->add();
		}

		if($data['id']){
			//楼盘图：户型、实景...
			$Picture = M('Picture');
			$AgentMarketPic = M('AgentmarketPic');
			$picIdList = $Picture->field('id')->where(array('pid'=>$data['id'], 'type'=>5))->select();
			//删掉之前的
			if(!empty($picIdList)){
				$picIds = array();
				foreach ($picIdList as $pic) {
					$picIds[] = (int)$pic['id'];
				}
				if(!empty($picIds)){
					$AgentMarketPic->where(array('id'=>array('IN', $picIds)))->delete();
				}
			}
			
			//封面图
			$this->updateHousePic($data['id'], 5, empty($_POST['house_pic']) ? '[]' : $_POST['house_pic']);
			
			//设置现在的
			if(isset($_POST['pic_id'])){
				for($i = 0, $count = count($_POST['pic_id']); $i < $count; $i++){
					$pic = array();
					$pic['id'] = $_POST['pic_id'][$i];
					$pic['desc_txt'] = $_POST['pic_desc'][$i];
					$pic['type'] = $_POST['pic_type'][$i];
					$AgentMarketPic->data($pic)->add();
				}
				$Picture->where(array('id'=>array('IN', $_POST['pic_id'])))->setField('pid', $data['id']);
			}

		}

		return $data;
	}
}
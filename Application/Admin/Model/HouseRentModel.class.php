<?php
namespace Admin\Model;

class HouseRentModel extends HouseModel{
	protected $tableName = 'houserent';

	protected $patchValidate = true;

	protected $_validate = array(
		array('title', 'require', '标题不能为空', self::MUST_VALIDATE, 'regex', self::MODEL_BOTH),
		array('title', '1,80', '标题长度不能超过80个字符', self::MUST_VALIDATE, 'length', self::MODEL_BOTH),
		array('contact', 'require', '请填写联系人姓名', self::MUST_VALIDATE),
		array('contact_tel', '/^\d{11}|\d{8}|\d{4}[\s\-]{1}\d{8}$/', '请正确填写联系方式', self::MUST_VALIDATE, 'regex'),
		array('price', 'integer', '请填写价格，只能是整数', self::MUST_VALIDATE, 'regex'),
		array('city', 'require', '请选择城市', self::MUST_VALIDATE),
		array('area', 'require', '请选择区域', self::MUST_VALIDATE),
		array('busi_area', 'require', '请选择商区', self::MUST_VALIDATE),
		array('community', 'require', '请填写小区名称', self::MUST_VALIDATE),
		array('bed_room', 'integer', '请填写卧室数量', self::MUST_VALIDATE, 'regex'),
		array('live_room', 'integer', '请填写客厅数量', self::MUST_VALIDATE, 'regex'),
		array('toilet', 'integer', '请填写卫生间数量', self::MUST_VALIDATE, 'regex'),
		array('square', 'integer', '请填写面积，只能是整数', self::MUST_VALIDATE, 'regex'),
		array('floor', 'integer', '请填写楼层', self::MUST_VALIDATE, 'regex'),
		array('floor_max', 'integer', '请填写最高楼层', self::MUST_VALIDATE, 'regex'),
		array('decorate', 'require', '请选择装修类型', self::MUST_VALIDATE),
		array('face', 'require', '请选择朝向', self::MUST_VALIDATE),
		array('deposit_type', 'require', '请选押金类型', self::MUST_VALIDATE),
		array('desc_txt', 'require', '请填写描述信息', self::MUST_VALIDATE)
	);

	protected $_auto = array(
		array('create_time', NOW_TIME, self::MODEL_INSERT),
		array('status', 0, self::MODEL_INSERT),
		array('uid', 'is_login', self::MODEL_INSERT, 'function')
	);

	public function saveOrUpdate(){
		$_POST['add_on'] = array2string($_POST['add_on']);
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
			$this->updateHousePic($data['id'], 2, empty($_POST['house_pic']) ? '[]' : $_POST['house_pic']);
		}

		return true;
	}
}
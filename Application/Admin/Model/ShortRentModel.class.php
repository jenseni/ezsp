<?php
namespace Admin\Model;

class ShortRentModel extends HouseModel{
	protected $tableName = 'shortrent';

	protected $patchValidate = true;

	protected $_validate = array(
		array('title', 'require', '标题不能为空', self::MUST_VALIDATE, 'regex', self::MODEL_BOTH),
		array('title', '1,80', '标题长度不能超过80个字符', self::MUST_VALIDATE, 'length', self::MODEL_BOTH),
		array('contact', 'require', '请填写联系人姓名', self::MUST_VALIDATE),
		array('contact_tel', '/^\d{11}|\d{8}|\d{4}[\s\-]{1}\d{8}$/', '请正确填写联系方式', self::MUST_VALIDATE, 'regex'),
		array('price', 'integer', '请填写价格，只能是整数', self::MUST_VALIDATE, 'regex'),
		array('city', 'require', '请选择城市', self::MUST_VALIDATE),
		array('area', 'require', '请选择区域', self::MUST_VALIDATE)
    );

	protected $_auto = array(
		array('create_time','time',1,'function'),
		array('update_time','time',2,'function'),
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
			$this->updateHousePic($data['id'], empty($_POST['house_pic']) ? '[]' : $_POST['house_pic']);
		}

		return true;
	}
}
<?php
namespace Admin\Model;

use \Think\Model;

class WxMaterialModel extends Model{
	protected $patchValidate = true;

	protected $_validate = array(
		array('title', 'require', '请填写标题', self::MUST_VALIDATE),
		array('title', '1,32', '标题长度不能超过32个字符', self::MUST_VALIDATE, 'length'),
		array('type', 'require', '请选择类型', self::MUST_VALIDATE),
		array('content', 'require', '请填写正文', self::MUST_VALIDATE)
	);

	protected $_auto = array(
		
	);

	public function saveOrUpdate(){

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
			$this->updateHousePic($data['id'], 1, empty($_POST['house_pic']) ? '[]' : $_POST['house_pic']);
		}

		return true;
	}
}
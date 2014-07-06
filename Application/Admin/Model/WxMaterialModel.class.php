<?php
namespace Admin\Model;

use \Think\Model;

class WxMaterialModel extends Model{

	protected $patchValidate = true;

	protected $_validate = array(
		array('title', 'require', '请填写标题', self::MUST_VALIDATE),
		array('content', 'require', '请输入正文', self::MUST_VALIDATE),
	);

	protected $_auto = array(
		array('create_time','time',1,'function')
	);

	public function saveOrUpdate(){
		$_POST['type'] = 'news';
		$data = $this->create();
		
		if(!$data){
			return false;
		}

		if(isset($data['id'])){
			$this->save();
		}else{
			$data['id'] = $this->add();
		}

		return true;
	}
}
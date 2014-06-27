<?php
namespace Admin\Model;

use \Think\Model;

class WxAccountModel extends Model{
	protected $patchValidate = true;

	protected $_validate = array(
		array('id', 'require', '请填写微信号', self::MUST_VALIDATE),
		array('id', '1,32', '标题长度不能超过32个字符', self::MUST_VALIDATE, 'length'),
		array('app_id', 'require', '请填写APP ID', self::MUST_VALIDATE),
		array('app_secret', 'require', '请填写APP SECRET', self::MUST_VALIDATE),
		array('desc_txt', 'require', '请填写备注', self::MUST_VALIDATE)
	);

	protected $_auto = array(
		array('status', 1, self::MODEL_INSERT)
	);
}
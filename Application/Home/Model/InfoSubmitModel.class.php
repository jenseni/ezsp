<?php
namespace Home\Model;

use \Think\Model;

class InfoSubmitModel extends Model{

	protected $tableName = 'info_submit';

	protected $_validate = array(
		array('contact', 'require', '请输入联系人', self::MUST_VALIDATE),
		array('contact_tel', 'require', '请输入联系方式', self::MUST_VALIDATE),
		array('content', 'require', '请输入详细内容', self::MUST_VALIDATE)
	);
	
}
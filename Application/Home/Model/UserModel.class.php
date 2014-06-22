<?php
namespace Home\Model;

use \Think\Model;

class UserModel extends Model{
	public static $loginUser;

	protected $tableName = 'member';

	protected $_validate = array(
		array('username', 'require', '请输入用户名', self::MUST_VALIDATE),
		array('username', '', '用户名已存在', self::MUST_VALIDATE, 'unique', self::MODEL_INSERT),
		array('password', 'require', '请输入密码', self::MUST_VALIDATE),
		array('repassword', 'require', '请再次输入密码', self::MUST_VALIDATE),
		array('repassword', 'password', '两次输入的密码不一致', self::MUST_VALIDATE, 'confirm')
	);

	protected $_auto = array(
		array('create_time', NOW_TIME, self::MODEL_INSERT)
	);
}
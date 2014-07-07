<?php
namespace Admin\Model;

use \Think\Model;

class WxSharePathModel extends Model{
	public function getSharePath($busiType, $busiId, $last){
		$path = array();
		$this->whoToRoot($busiType, $busiId, $last, $path);

		return $path;
	}

	private function whoToRoot($busiType, $busiId, $who, &$path){
		if($who == 'root'){
			return;
		}
		$condition = array();
		$condition['busi_type'] = $busiType;
		$condition['busi_id'] = $busiId;
		$condition['who'] = $who;

		$shareNode = $this->where($condition)->find();
		if(!empty($shareNode)){
			$user = M('Member')->where(array('openid'=>$shareNode['who']))->find();
			if(!empty($user)){
				$user['openid'] = $shareNode['who'];
			}
			$user['share_time'] = $shareNode['created'];
			array_unshift($path, $user);
			$this->whoToRoot($busiType, $busiId, $shareNode['fro'], $path);
		}
	}
}
<?php
namespace Admin\Controller;

use \Think\Controller;

class CommandController extends Controller{
	protected function _initialize(){
		if(!IS_CLI){
			$this->error('错误的应用模式');
		}
	}

	/**
	 * 粗糙的统计方法
	 */
	public function statistic($date = ''){
		if(empty($date)){
			$date = strtotime(date('Y-m-d', NOW_TIME));
		}else{
			$date = strtotime(date('Y-m-d', strtotime($date)));
		}

		$tomarrow = strtotime("+1 day", $date);

		$Statistics = M('Statistics');
		$statistics = $Statistics->where(array('create_time'=>array('BETWEEN', array($date, $tomarrow))))->find();

		if(!empty($statistics)){
			echo 'Already Exsists!';
			return;
		}

		$statistics['article'] = M('Article')->count(1);
		$statistics['house_sale'] = M('Housesale')->count(1);
		$statistics['house_rent'] = M('Houserent')->count(1);
		$statistics['short_rent'] = M('Shortrent')->count(1);
		$statistics['office_market'] = M('Officemarket')->count(1);
		$statistics['web_user'] = M('Member')->count(1);
		$statistics['wx_user'] = 1;
		$statistics['pv'] = M('Iplog')->count(1);
		$statistics['ip'] = M('Iplog')->count('distinct ip_address');
		$statistics['create_time'] = $date;

		$Statistics->data($statistics)->add();
		$this->ip_log_clean($date);
		echo 'Success';
		return;
	}

	public function ip_log_clean($date=''){
		// if(empty($date)){
		// 	$date = strtotime(date('Y-m-d', NOW_TIME));
		// }else{
		// 	$date = strtotime(date('Y-m-d', strtotime($date)));
		// }
		// $tomarrow = strtotime("+1 day", $date);
		// M('Iplog')->where(array('request_time'=>array('BETWEEN', array($date, $tomarrow))))->delete();

		M()->query('insert into t_iplog_01 select * from t_iplog');
		M()->query('delete from t_iplog');
	}
}
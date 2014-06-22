<?php
namespace Admin\Controller;

class IndexController extends AdminController{
	public function index(){
		$this->authView(101);

		$Statistics = M('Statistics');
		$statistic = $Statistics->order('create_time desc')->find();
		if($statistic){
			$statistic['house'] = $statistic['house_sale'] + $statistic['house_rent'] + $statistic['short_rent'] + $statistic['office_market'];
		}

		$timeList = array();
		$webUserCountList = array();
		$wxUserCountList = array();
		$statisticList = $Statistics->order('create_time desc')->limit(7)->select();

		if(!empty($statisticList)){
			for($i = count($statisticList) - 1; $i >= 0; $i--){
				$current = $statisticList[$i];
				$timeList[] = date('m-d', $current['create_time']);
				$webUserCountList[] = (int)$current['web_user'];
				$wxUserCountList[] = (int)$current['wx_user'];
			}
		}

		//最近一星期PV IP
		$weekData = $Statistics->field('sum(ip) ip_count, sum(pv) pv_count')
			->where(array(
				'create_time'=>array('BETWEEN', array(NOW_TIME - 7 * 24 * 60 * 60, NOW_TIME))
			))
			->find();

		//最近一个月PV IP
		$monthData = $Statistics->field('sum(ip) ip_count, sum(pv) pv_count')
			->where(array(
				'create_time'=>array('BETWEEN', array(NOW_TIME - 30 * 24 * 60 * 60, NOW_TIME))
			))
			->find();

		$this->assign('timeList', $timeList);
		$this->assign('webUserCountList', $webUserCountList);
		$this->assign('wxUserCountList', $wxUserCountList);
		$this->assign('statistic', $statistic);
		$this->assign('weekData', $weekData);
		$this->assign('monthData', $monthData);
		$this->display();
	}

	public function test($auth){
		$this->authView($auth);
		
		$this->display();
	}

}
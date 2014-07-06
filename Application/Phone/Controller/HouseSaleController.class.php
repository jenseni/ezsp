<?php
namespace Phone\Controller;

class HouseSaleController extends PhoneController{
	/*public function index(){
		$HouseSale = M('Housesale');
		$search = I('get.search');
		$wheresql = 'h.status = 1';

		if(!empty($search)){
			$wheresql = $wheresql.' and (h.community like \'%'.$search.'%\' or h.title like \'%'.$search.'%\')';
		}
		
		$totalCount = $HouseSale->alias('h')
			->where($wheresql)
			->count(1);

		$page = new \Think\Page($totalCount);
		$page->rollPage = 3;
		$page->setConfig('prev', '上一页');
		$page->setConfig('next', '下一页');
		$page->setConfig('theme', '%UP_PAGE% %LINK_PAGE% %DOWN_PAGE%');

		$dataList = $HouseSale->alias('h')
			->field('h.id,h.bed_room,h.live_room,h.decorate,h.price,h.thumbnail,h.community,busi_area.name busi_area_name,h.title,h.square')
			->join('__DISTRICT__ busi_area on busi_area.id=h.busi_area', 'LEFT')
			//->where(array('h.status'=>array('NEQ', 0)))
			->where($wheresql)
			->order('level desc, id desc')
			->limit($page->firstRow, $page->listRows)
			->select();
		if(!empty($dataList)){
			$this->assign('dataList', $dataList);
		}
		$this->assign('page',$page->show());
		$this->display();
	}*/

	public function lists($area = '0', $price = '0', $square = '0', $room = '0', $sort = ''){
		
		$map = array();

		$map['h.city'] = (int)$this->city['id'];
		$map['h.status'] = 1;

		$search = I('get.search');
		if(!empty($search)){
			$where['h.title']  = array('like', '%'.$search.'%');
			$where['h.community'] = array('like','%'.$search.'%');
			$where['_logic'] = 'or';
			$map['_complex'] = $where;
		}

		if($area != '0'){
			$map['_string'] = "h.area=$area OR h.busi_area=$area";
			$param .= ' '.get_p_area($area);
		}
		if($price != '0'){
			$priceRange = explode('-', $price);
			if(is_numeric($priceRange[0]) && is_numeric($priceRange[1])){
				$map['h.price'] = array('BETWEEN', array_map(function($v){return (int)$v;}, $priceRange));
			}elseif(is_numeric($priceRange[0])){
				$map['h.price'] = array('GT', (int)$priceRange[0]);
			}elseif(is_numeric($priceRange[1])){
				$map['h.price'] = array('LT', (int)$priceRange[1]);
			}

			$param .= ' '.get_p_lookup('HOUSE_SALE_PRICE_RANGE',$price);
		}
		if($square != '0'){
			$squareRange = explode('-', $square);
			if(is_numeric($squareRange[0]) && is_numeric($squareRange[1])){
				$map['h.square'] = array('BETWEEN', array_map(function($v){return (int)$v;}, $squareRange));
			}elseif(is_numeric($squareRange[0])){
				$map['h.square'] = array('GT', (int)$squareRange[0]);
			}elseif(is_numeric($squareRange[1])){
				$map['h.square'] = array('LT', (int)$squareRange[1]);
			}

			$param .= ' '.get_p_lookup('HOUSE_SALE_SQUARE_RANGE',$square);
		}
		if($room != '0'){
			$map['h.bed_room'] = (int)$room;
			$param .= ' '.get_p_lookup('HOUSE_RENT_BEDROOM',$room);
		}

		$sortField = 'h.id';
		$sortDir = 'desc';
		if(!empty($sort)){
			$sortInfo = explode('-', $sort);
			if(isset($sortInfo[0])){
				$sortField = $sortInfo[0];
			}
			if(isset($sortInfo[1])){
				$sortDir = $sortInfo[1];
			}
		}

		$model = M('Housesale');

		$totalCount = $model->alias('h')
			->where($map)
			->count(1);

		$page = new \Think\Page($totalCount);
		$page->rollPage = 3;
		$page->setConfig('prev', '上一页');
		$page->setConfig('next', '下一页');
		$page->setConfig('theme', '%UP_PAGE% %LINK_PAGE% %DOWN_PAGE%');

		$dataList = $model->field('h.id,h.title,h.create_time,h.community,h.bed_room,h.live_room,h.floor,h.floor_max,h.decorate,h.structure,h.build_year,h.face,h.thumbnail, h.price, h.add_on, h.square, busi_area.name busi_area_name')
			->alias('h')
			->join('__DISTRICT__ busi_area on h.busi_area=busi_area.id', 'LEFT')
			->where($map)
			->order("$sortField $sortDir")
			->limit($page->firstRow, $page->listRows)
			->select();

		$this->assign('dataList', $dataList);
		
		$this->assign('param',$param);
		$this->assign('price', $price);
		$this->assign('square', $square);
		$this->assign('room', $room);
		$this->assign('page', $page->show());

		$this->assign('nav',1);
		$this->assign('site_title','恒润房产-房屋买卖');
		$this->assign('sort',$sort);

		$this->display();
	}

	public function detail($id){
		$House = M('Housesale');

		$data = $House->field('h.*,area.name area_name,busi_area.name busi_area_name')
			->alias('h')
			->join('__DISTRICT__ area on area.id=h.area', 'LEFT')
			->join('__DISTRICT__ busi_area on busi_area.id=h.busi_area', 'LEFT')
			->where(array('h.id'=>(int)$id))
			->find();

		if(empty($data)){
			$this->error('404:信息已删除或不存在');
		}

		$Picture = M('Picture');
		$housePicList = $Picture->field('path')->where(array('pid'=>$id,'type'=>1))->select();
		$data['picList'] = $housePicList;

		$this->assign('data', $data);

		$this->assign('site_title','恒润房产-房屋买卖');
		$this->display();
	}

	public function sharepathdetail($id, $who = 'root'){
		$House = M('Housesale');

		$data = $House->field('h.*,area.name area_name,busi_area.name busi_area_name')
			->alias('h')
			->join('__DISTRICT__ area on area.id=h.area', 'LEFT')
			->join('__DISTRICT__ busi_area on busi_area.id=h.busi_area', 'LEFT')
			->where(array('h.id'=>(int)$id))
			->find();

		if(empty($data)){
			$this->error('404:信息已删除或不存在');
		}

		if($data['share_path'] == 'Y'){
			$openid = cookie('openid');
			if(empty($openid)){
				$wxapi = \Weixin\Api\Wechat::create();
				$redirecturl = $wxapi->getOauthRedirect('http://'.C('SERVER_IP').__ROOT__.'/phone/house_sale/getopenid/id/'.$id.'/who/'.$who, '123', 'snsapi_base');
				redirect($redirecturl);
			}
			if($openid != $who){
				$SharePath = M('WxSharePath');
				$sharePath = $SharePath->where(array('busi_type'=>1, 'busi_id'=>(int)$id, 'who'=>$openid))->find();
				if(empty($sharePath)){
					$sharePath['busi_id'] = $id;
					$sharePath['busi_type'] = 1;
					$sharePath['created'] = date('Y-m-d H:i:s', NOW_TIME);
					$sharePath['fro'] = $who;
					$sharePath['who'] = $openid;

					$SharePath->data($sharePath)->add();
				}
				$this->redirect('HouseSale/sharepathdetail', array('id'=>$id, 'who'=>$openid));
			}
		}

		$Picture = M('Picture');
		$housePicList = $Picture->field('path')->where(array('pid'=>$id,'type'=>1))->select();
		$data['picList'] = $housePicList;

		$this->assign('data', $data);

		$this->assign('site_title','恒润房产-房屋买卖');
		$this->display('detail');

	}

	public function getopenid($id, $who){
		$wxapi = \Weixin\Api\Wechat::create();
		$result = $wxapi->getOauthAccessToken();
		if(!isset($result['openid'])){
			$this->redirect('HouseSale/detail', array('id'=>$id));
		}
		cookie('openid', $result['openid']);

		$this->sharepathdetail($id, $who);
	}
}
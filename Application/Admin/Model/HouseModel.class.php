<?php
namespace Admin\Model;

use \Think\Model;

abstract class HouseModel extends Model{
	public function updateHousePic($houseId, $type, $picList){
		$picList = json_decode($picList);

		$picIdList = array();

		if(!empty($picList)){
			foreach($picList as $pic){
				$picIdList[] = (int)$pic->id;
			}
		}

		$thumbUri = NULL;
		if(!empty($picIdList)){
			$Picture = M('Picture');
			//失效之前的
			$Picture->where(array('pid'=>(int)$houseId, 'type'=>(int)$type))->setField('pid', 0);
			//设置自己的
			$Picture->where(array('id'=>array('IN', $picIdList)))->setField('pid', $houseId);
			$firstPic = $Picture->find($picIdList[0]);

			//取第一张为封面缩略图
			$picPath = '.'.$firstPic['path'];
			$pathInfo = pathinfo($picPath);
			$thumbPath = $pathInfo['dirname'] . '/' . $pathInfo['filename'] . '_' . C('HOUSE_PIC_CONFIG.THUMB_WIDTH') . '_' . C('HOUSE_PIC_CONFIG.THUMB_HEIGHT') . '.' . $pathInfo['extension'];

			$Image = new \Think\Image();
			$Image->open($picPath)
				->thumb(C('HOUSE_PIC_CONFIG.THUMB_WIDTH'), C('HOUSE_PIC_CONFIG.THUMB_HEIGHT'), \Think\Image::IMAGE_THUMB_CENTER)
				->save($thumbPath);

			$thumbUri = substr($thumbPath, strpos($thumbPath, '/'));
		}

		$this->where(array('id'=>(int)$houseId))->setField('thumbnail', $thumbUri);
	}
}
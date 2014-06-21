<?php
namespace Admin\Controller;

use \Think\Controller;

class FileController extends Controller{
	public function uploadhousepic(){
		//TODO: 用户登录检测
		/* 返回标准数据 */
		$return  = array('status' => 0, 'info' => '上传成功', 'data' => '');

		/* 调用文件上传组件上传文件 */
		$Picture = new \Admin\Model\PictureModel;
		$pic_driver = C('PICTURE_UPLOAD_DRIVER');
		$info = $Picture->upload(
			I('busi_type', 0),
			$_FILES,
			C('PICTURE_UPLOAD'),
			C('PICTURE_UPLOAD_DRIVER'),
			C("UPLOAD_{$pic_driver}_CONFIG")
		);

		/* 记录图片信息 */
		if($info){
			//处理图片大小
			$picPath = '.'.$info['fileUpload']['path'];
			$image = new \Think\Image();
			$image->open($picPath)
				->thumb(C('HOUSE_PIC_CONFIG.MAX_WIDTH'), C('HOUSE_PIC_CONFIG.MAX_HEIGHT'))
				->save($picPath);

			//图片水印
			// $image->open($picPath)
			// 	->water(C('HOUSE_PIC_CONFIG.WARTER_PIC'), C('HOUSE_PIC_CONFIG.POSITION'), C('HOUSE_PIC_CONFIG.ALPHA'))
			// 	->save($picPath);

			$return['status'] = 0;
			$return = array_merge($info['fileUpload'], $return);
		} else {
			$return['status'] = 99;
			$return['info']   = $Picture->getError();
		}

		/* 返回JSON数据 */
		$this->ajaxReturn($return);
	}
}
<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2014 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
namespace Think\Template\TagLib;
use Think\Template\TagLib;
/**
 * CX标签库解析类
 */
class Bs extends TagLib {

    // 标签定义
    protected $tags   =  array(
        // 标签定义： attr 属性列表 close 是否闭合（0 或者1 默认1） alias 标签别名 level 嵌套层次
        'actionErrors'=>array('close'=>0),
		'textfield'=>array('attr'=>'id,name,label,type,layout,value','close'=>0),
    );

    public function _actionErrors($tag, $content){
		
		$str = '<?php if(isset($actionError) && !empty($actionError)):?>';
		$str .= '<div class="alert alert-danger">';
		$str .= '<p><?php echo $actionError?></p>';
		$str .= '</div>';
		$str .= '<?php endif;?>';

		return $str;
	}

	public function _textfield($tag, $content){
		$name = $this->getAttrValue($tag, 'name', '');
		$value = $this->getAttrValue($tag, 'value');
		$id = $this->getAttrValue($tag, 'id', $name);
		$type = $this->getAttrValue($tag, 'type', 'text');
		$label = $this->getAttrValue($tag, 'label');
		$layout = $this->getAttrValue($tag, 'layout', '3:9');
		$space = explode(':', $layout);
		$str = "<div class='form-group <?php if(isset(\$fieldErrors['$name']) && !empty(\$fieldErrors['$name'])):?>has-error<?php endif;?>'>";
		if($label){
			$str .= "<label for='$id' class='control-label";
			if($space[0] > 0){
				$str .= " col-sm-$space[0]";
			}
			$str .="'>$label</label>";
		}
		$inputStr = "<input type='$type' name='$name' id='$id'";
		if($value){
			$inputStr .= " value='$value'";
		}
		$inputStr .=" class='form-control'/>";
		$inputStr .= "<?php if(isset(\$fieldErrors['$name']) && !empty(\$fieldErrors['$name'])):?><span class='help-block small'><?php echo \$fieldErrors['$name'];?></span><?php endif;?>";
		if($space[0] > 0){
			$str .= "<div class='col-sm-$space[1]'>";
			$str .= $inputStr;
			$str .= "</div>";
		}else{
			$str .= $inputStr;
		}
		
		$str .= '</div>';

		return $str;
	}

	private function getAttrValue($tag, $name, $default=false){
		return isset($tag[$name]) ? $tag[$name] : $default;
	}

}

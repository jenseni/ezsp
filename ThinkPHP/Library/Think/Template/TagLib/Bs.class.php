<?php
namespace Think\Template\TagLib;

use Think\Template\TagLib;
/**
 * bootstrap标签库解析类
 */
class Bs extends TagLib {

    // 标签定义
    protected $tags   =  array(
        // 标签定义： attr 属性列表 close 是否闭合（0 或者1 默认1） alias 标签别名 level 嵌套层次
        'actionError'=>array('close'=>0),
        'actionMessage'=>array('close'=>0),
		'textfield'=>array('attr'=>'id,name,label,type,layout,value','close'=>0),
		'textarea'=>array('attr'=>'id,name,label,layout,value', 'close'=>0)
    );

    public function _actionError($tag, $content){
		$str = '<?php if(!isset($actionError)){ ?>';
		$str .= 	'<?php if(session("?actionError")) { ?>';
		$str .= 		'<?php $actionError = session("actionError"); ?>';
		$str .= 		'<?php session("actionError", null); ?>';
		$str .= 	'<?php } ?>';
		$str .= '<?php } ?>';
		$str .= '<?php if(isset($actionError) && !empty($actionError)):?>';
		$str .= '<div class="alert alert-danger">';
		$str .= 	'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
		$str .= 	'<p><?php echo $actionError; ?></p>';
		$str .= '</div>';
		$str .= '<?php endif;?>';

		return $str;
	}

	public function _actionMessage($tag, $content){
		$str = '<?php if(!isset($actionMessage)){ ?>';
		$str .= 	'<?php if(session("?actionMessage")) { ?>';
		$str .= 		'<?php $actionMessage = session("actionMessage"); ?>';
		$str .= 		'<?php session("actionMessage", null); ?>';
		$str .= 	'<?php } ?>';
		$str .= '<?php } ?>';
		$str .= '<?php if(isset($actionMessage) && !empty($actionMessage)):?>';
		$str .= '<div class="alert alert-success">';
		$str .= 	'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
		$str .= 	'<p><?php echo $actionMessage; ?></p>';
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

	public function _textarea($tag, $content){
		$name = $this->getAttrValue($tag, 'name', '');
		$value = $this->getAttrValue($tag, 'value');
		$id = $this->getAttrValue($tag, 'id', $name);
		$label = $this->getAttrValue($tag, 'label');
		$layout = $this->getAttrValue($tag, 'layout', '3:9');
		list($labelSpace, $controlSpace) = explode(':', $layout);

		$str = "<div class='form-group <?php if(isset(\$fieldErrors['$name']) && !empty(\$fieldErrors['$name'])):?>has-error<?php endif;?>'>";
		if($label){
			$str .= "<label for=\"{$id}\" class=\"control-label";
			if($labelSpace > 0){
				$str .= " col-sm-{$labelSpace}";
			}
			$str .= "\">{$label}</label>";
		}

		$str .= "<div class=\"col-sm-{$controlSpace}\">";
		$str .= 	"<textarea id=\"{$id}\" name=\"{$name}\" class=\"form-control\">{$value}</textarea>";
		$str .= "<?php if(isset(\$fieldErrors['$name']) && !empty(\$fieldErrors['$name'])):?><span class='help-block small'><?php echo \$fieldErrors['$name'];?></span><?php endif;?>";
		$str .= '</div>';

		$str .= '</div>';

		return $str;
	}

	private function getAttrValue($tag, $name, $default=false){
		return isset($tag[$name]) ? $tag[$name] : $default;
	}

}

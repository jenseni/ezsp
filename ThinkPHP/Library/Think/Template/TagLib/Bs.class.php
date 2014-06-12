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
		'textarea'=>array('attr'=>'id,name,label,layout,value', 'close'=>0),
		'formgroup'=>array('attr'=>'label,layout,field,cssclass,errorclass,errormsg', 'close'=>1),
		'haserrorclass'=>array('attr'=>'field,cssclass', 'close'=>0)
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

	public function _formgroup($tag, $content){
		$label = $this->getAttrValue($tag, 'label');
		$field = $this->getAttrValue($tag, 'field');
		$layout = $this->getAttrValue($tag, 'layout', '1:11');
		$cssClass = $this->getAttrValue($tag, 'cssclass');
		$errorClass = $this->getAttrValue($tag, 'errorclass', true);
		$errorMsg = $this->getAttrValue($tag, 'errormsg', true);

		list($labelSpace, $controlSpace) = explode(':', $layout);

		$str = '<?php $__ERRTTXT__ = "";?>';
		$str .= '<div class="form-group ';
		if($cssClass){
			$str .= $cssClass;
		}

		$str .= '<?php if(isset($fieldErrors)){ ?>';
		$str .= 	'<?php $field = explode(",", "' . $field . '"); ?>';
		$str .= 	'<?php foreach($field as $f){ ?>';
		$str .=			'<?php if(isset($fieldErrors[$f])){ ?>';
		$str .= 		'<?php $__ERRTTXT__ .= (empty($__ERRTTXT__) ? "" : ",") . $fieldErrors[$f];?>';
		if($errorClass){
			$str .= 	'<?php echo " has-error";?>';
		}
		$str .= 		'<?php break; ?>';
		$str .= 		'<?php } ?>';
		$str .= 	'<?php } ?>';
		$str .= '<?php }?>';

		$str .= '">';

		if($label){
			$str .= '<label class="control-label';
			if($labelSpace){
				$str .= ' col-sm-'.$labelSpace;
			}
			$str .= '">'.$label.'</label>';
		}

		$str .= '<div class="';
		if($labelSpace && !$label){
			$str .= ' col-sm-offset-'.$labelSpace;
		}
		if($controlSpace){
			$str .= ' col-sm-' . $controlSpace;
		}
		$str .= '">';

		$str .= $this->tpl->parse($content);
		if($errorMsg){
			if($errorClass){
				$str .= '<?php if(!empty($__ERRTTXT__)){ ?>';
				$str .= 	'<span class="help-block small"><?php echo $__ERRTTXT__; ?></span>';
				$str .= '<?php } ?>';
			}else{
				$str .= '<?php if(!empty($__ERRTTXT__)){ ?>';
				$str .= '<p class="has-error">';
				$str .= 	'<span class="help-block small"><?php echo $__ERRTTXT__; ?></span>';
				$str .= '</p>';
				$str .= '<?php } ?>';
			}
		}
		$str .= '</div>';

		$str .= '</div>';

		return $str;
	}

	public function _haserrorclass($tag, $content){
		$field = $this->getAttrValue($tag, 'field');
		$cssClass = $this->getAttrValue($tag, 'cssclass');

		$str = '<?php $__CSSCLASS__ = "'.$cssClass.'";?>';

		$str .= '<?php if(isset($fieldErrors)){ ?>';
		$str .= 	'<?php $field = explode(",", "' . $field . '"); ?>';
		$str .= 	'<?php foreach($field as $f){ ?>';
		$str .=			'<?php if(isset($fieldErrors[$f])){ ?>';
		$str .=				'<?php if(empty($__CSSCLASS__)){ ?>';
		$str .= 				'<?php echo " class=\"has-error\""; ?>';
		$str .= 			'<?php }else{?>';
		$str .= 				'<?php echo \' class=\"\'.$__CSSCLASS__.\' has-error\"\'; ?>';
		$str .= 			'<?php } ?>';
		$str .= 			'<?php break; ?>';
		$str .= 		'<?php } ?>';
		$str .= 	'<?php } ?>';
		$str .= '<?php }?>';

		return $str;
	}

	private function getAttrValue($tag, $name, $default=false){
		if(isset($tag[$name])){
			if($tag[$name] == 'false'){
				return false;
			}
			if($tag[$name] == 'true'){
				return true;
			}

			return $tag[$name];
		}
		return $default;
	}

}

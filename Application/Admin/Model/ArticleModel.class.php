<?php
namespace Admin\Model;

use Think\Model\RelationModel;

class ArticleModel extends RelationModel{
	protected $patchValidate = true;

	protected $_auto = array(
		array('status','1'),
		array('create_time','time',1,'function'),
        array('update_time','time',1,'function'),
		array('update_time','time',2,'function'),
	);

	protected $_validate = array(
		array('title', 'require', '请填写标题'),
		array('content', 'require', '请填写详细信息')
	);

	protected $_link = array(
		'Author' => array(
				'mapping_type' 	=> 	self::BELONGS_TO,
				'class_name' 	=> 	'AdminUser',
				'foreign_key'	=> 	'uid',
				//'mapping_name'	=>	'author'
				'as_fields'		=>	'username'
		),
		'Category'=> array(
				'mapping_type'	=>	self::BELONGS_TO,
				'class_name'	=>	'Category',
				'foreign_key'	=>	'category_id',
				'as_fields'		=>	'title:category_name'
		),

	);

	/**
     * 新增或更新一个文档
     * @param array  $data 手动传入的数据
     * @return boolean fasle 失败 ， int  成功 返回完整的数据
     * @author zhujie
     */
    public function update($data = null){
    	
        /* 获取数据对象 */
        $data = $this->create($data);
        if(empty($data)){
            return false;
        }        
        
        $status = $this->save(); //更新基础内容
        if(false === $status){
            $this->error = '更新基础内容出错！';
            return false;
        }
        return $data;
    }

    /**
     * 获取文档列表
     * @param  integer  $category 分类ID, 1：房产，2：优惠活动
     * @param  string   $order    排序规则
     * @param  integer  $status   状态
     * @param  string   $field    字段 true-所有字段
     * @param  string   $limit    分页参数
     * @param  array    $map      查询条件参数
     * @return array              文档列表
     * @author huajie <banhuajie@163.com>
     */
    public function lists($category = '1', $order = '`create_time` DESC', $limit = '10', $limitRows = '10', $map = array(), $status = 1, $field = true){
        if($category=='1'){
        	$map['category_id'] = array('IN','1,2,3,4');
        }else{
        	$map['category_id'] = array('eq','5');
        }
        $map['status'] = array('eq','1');

        return $this->field($field)->relation(true)->where($map)->order($order)->limit($limit,$limitRows)->select();
    }

    /**
     * 计算列表总数
     * @param  number  $category 分类ID, 1：房产，2：优惠活动
     * @param  integer $status   状态
     * @param  array   $map     查询条件参数
     * @return integer           总数
     */
    public function listCount($category = '1', $map = array(), $status = 1){
        if($category=='1'){
        	$map['category_id'] = array('IN','1,2,3,4');
        }else{
        	$map['category_id'] = array('eq','5');
        }
        $map['status'] = array('eq','1');
        return $this->where($map)->count('id');
    }
}
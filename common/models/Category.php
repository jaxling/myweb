<?php

namespace common\models;

use Yii;
use yii\db\Query;

/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property string $name
 * @property string $pinyin_name
 * @property integer $parent_id
 * @property integer $is_show
 * @property string $img
 * @property string $des
 * @property string $create_time
 * @property string $update_time
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name','parent_id'], 'required'],
            [['parent_id', 'is_show'], 'integer'],
            [['des'], 'string'],
            [['create_time', 'update_time'], 'safe'],
            [['name'], 'string', 'max' => 50],
            [['pinyin_name'], 'string', 'max' => 100],
            [['img'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '分类名称',
            'pinyin_name' => '名称-拼音',
            'parent_id' => '上级id',
            'is_show' => '显示状态', //1、显示 2、隐藏
            'img' => '图片',
            'des' => '描述',
            'create_time' => '创建时间',
            'update_time' => '更新时间',
            'level' => '级别'
        ];
    }
    public static function itemAlias ($type, $code = NULL)
    {


        $_items = [
            'is_show' => [
                //''  =>'显示状态',
                '1' => "显示",              
                '2' => "隐藏",              
            ],
        ];

        if (isset($code))
            return isset($_items[$type][$code]) ? $_items[$type][$code] : false;
        else
            return isset($_items[$type]) ? $_items[$type] : false;
    }
    /*
    * 保存前执行的操作
    */
    public function beforeSave($insert) {
        if (parent::beforeSave($insert)) {
            //是否是新添加
            if($this->isNewRecord) {
                if(!$this->is_show) $this->is_show = 1;
                
                $this->create_time = date("Y-m-d H:i:s", time());
                $this->update_time = date("Y-m-d H:i:s", time());
            }else{
                $this->update_time = date("Y-m-d H:i:s", time());
            }
            return true;
        } else {
            return false;
        }
    } 

    /**
     * [分类开表]   
     * 使用办法 Category::getList(1)
     * @return [type] [description]
     */
    public static function getList($is_show = 0){
        $arr = [];
        $is_show = intval($is_show);
        if($is_show == 0) {
            $where = [];
        }  else {
            $where = ['is_show' => $is_show];
        }
        $list = $list1 = $list2 = Category::find()->where($where)->orderBy('id ASC')->asArray()->all();
        if(empty($list)) {
            return $arr;
        }
        foreach ($list as $k => $v) {
            if($v['parent_id'] == 0) {
                $v['level'] = 1;
                $arr[] = $v;  //一级分类
                foreach ($list1 as $k1 => $v1) {
                    if($v1['parent_id'] == $v['id']) {
                        $v1['level'] = 2;
                        $arr[] = $v1;  //二级分类
                        foreach ($list2 as $k2 => $v2) {
                            if($v2['parent_id'] == $v1['id']) {
                                $v2['level'] = 3;
                                $arr[] = $v2;  //三级分类
                            }
                        }
                    }
                }
            }
            //父级不存在且不为零的数据---------上级被误删之后可放出来查看差异
            /*$id_arr [] = $list[$k]['id'];
            if($v['parent_id']!=0 && !in_array($v['parent_id'],$id_arr)){
                $v['level'] = 0;
                $arr[] = $v;
            }*/
        }
        unset($list);
        unset($list1);
        unset($list2);
        return $arr;
    }
}

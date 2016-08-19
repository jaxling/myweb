<?php

namespace common\models;

use Yii;
use Yii\db\query;

/**
 * This is the model class for table "product_gallery".
 *
 * @property string $id
 * @property string $img_url
 * @property string $img_url_thumb
 * @property integer $product_id
 * @property string $title
 * @property string $desc
 * @property integer $is_page_img
 * @property integer $is_show
 * @property string $create_at
 * @property string $update_at
 */
class ProductGallery extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_gallery';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['img_url','product_id'], 'required'],
            [['product_id', 'is_page_img', 'is_show'], 'integer'],
            [['desc'], 'string'],
            [['create_at', 'update_at'], 'safe'],
            [['img_url', 'img_url_thumb'], 'string', 'max' => 255],
            [['title'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'img_url' => '图片地址',
            'img_url_thumb' => '缩略图',
            'product_id' => '商品id ',
            'title' => '标题',
            'desc' => '描述',
            'is_page_img' => '封面图',// 1、否 2、是',
            'is_show' => '显示状态',//1、显示 2隐藏',
            'create_at' => '创建时间',
            'update_at' => '更新时间',
        ];
    }

    public static function itemAlias ($type, $code = NULL)
    {
        $_items = [
            'is_page_img' => [
                //''  =>'显示状态',
                '1' => "否",              
                '2' => "是",
            ],
            'is_show' => [
                //''  =>'显示状态',
                '1' => "显示",              
                '2' => "隐藏",              
            ],
        ];
        $brand = (new Query)
            ->select(['name'])
            ->from('product')
            ->distinct()
            ->all();
            foreach ($brand as $k => $v) {
                $_items['product_id'][$k+1] = $v['name'];
            }

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
                if(!$this->is_page_img) $this->is_page_img = 1;
                if(!$this->is_show) $this->is_show = 1;
                
                $this->create_at = date("Y-m-d H:i:s", time());
                $this->update_at = date("Y-m-d H:i:s", time());
            }else{
                $this->update_at = date("Y-m-d H:i:s", time());
            }
            return true;
        } else {
            return false;
        }
    }
}

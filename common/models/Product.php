<?php

namespace common\models;

use Yii;
use yii\db\Query;

/**
 * This is the model class for table "product".
 *
 * @property integer $id
 * @property string $name
 * @property string $keywords
 * @property string $des
 * @property string $market_price
 * @property string $product_price
 * @property string $promotion_price
 * @property integer $spec
 * @property string $weight
 * @property integer $weight_unit
 * @property integer $brand_id
 * @property integer $stock
 * @property string $serial_number
 * @property integer $full_cut_shipping_free
 * @property integer $supply
 * @property integer $is_show
 * @property string $create_time
 * @property string $update_time
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'market_price','weight','keywords','product_price','brand_id', 'serial_number'], 'required'],
            [['des'], 'string'],
            [['market_price', 'product_price', 'promotion_price', 'weight'], 'number'],
            [['spec', 'weight_unit', 'brand_id', 'stock', 'serial_number', 'full_cut_shipping_free', 'supply', 'is_show'], 'integer'],
            [['create_time', 'update_time'], 'safe'],
            [['name'], 'string', 'max' => 50],
            [['keywords'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '名称',
            'keywords' => '关键词',
            'des' => '描述',
            'market_price' => '市场价',
            'product_price' => '商品价',
            'promotion_price' => '促销价',
            'spec' => '规格',    // 1个，2斤，3公斤 ，4吨',
            'weight' => '重量',
            'weight_unit' => '重量规格',//1千克2克',
            'brand_id' => '品牌',
            'stock' => '库存',
            'serial_number' => '序列号',
            'full_cut_shipping_free' => '参加满多少元减快递费',//1不参加2参加',
            'supply' => '供应方式',//1（3天内发货），2（1星期内发货） 3（其它）',
            'is_show' => '显示否',//1显示2隐藏',
            'create_time' => '创建时间',
            'update_time' => '更新时间',
        ];
    }

    public static function itemAlias ($type, $code = NULL)
    {
        $_items = [
            'supply' => [
                //''  =>'显示状态',
                '1' => "3天内发货",              
                '2' => "1星期内发货",
                '3' => "其他",
            ],
            'full_cut_shipping_free' => [
                //''  =>'显示状态',
                '1' => "不参加",              
                '2' => "参加",              
            ],
            'weight_unit' => [
                //''  =>'显示状态',
                '1' => "千克",              
                '2' => "克",              
            ],
            'spec' => [
                //''  =>'显示状态',
                '1' => "个",              
                '2' => "斤",
                '3' => "公斤",
                '4' => "吨",
            ],
            'is_show' => [
                //''  =>'显示状态',
                '1' => "显示",              
                '2' => "隐藏",              
            ],
        ];
        $brand = (new Query)
            ->select(['name'])
            ->from('brand')
            ->distinct()
            ->all();
            foreach ($brand as $k => $v) {
                $_items['brand_id'][$k+1] = $v['name'];
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
                if(!$this->is_show) $this->is_show = 1;
                if(!$this->stock) $this->stock = 99;
                if(!$this->spec) $this->spec = 99;
                if(!$this->weight_unit) $this->weight_unit = 1;
                if(!$this->full_cut_shipping_free) $this->full_cut_shipping_free = 1;
                if(!$this->supply) $this->supply = 1;
                if(!$this->full_cut_shipping_free) $this->full_cut_shipping_free = 1;

                
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
}

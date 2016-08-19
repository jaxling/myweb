<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "shipping".
 *
 * @property integer $id
 * @property string $shipping_code
 * @property string $shipping_name
 * @property string $desc
 * @property integer $defult_first_weight
 * @property string $defult_first_price
 * @property integer $defult_next_weight
 * @property string $defult_next_price
 * @property integer $status
 */
class Shipping extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shipping';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['shipping_code', 'shipping_name', 'desc', 'defult_first_price', 'defult_next_weight', 'defult_next_price'], 'required'],
            [['desc'], 'string'],
            [['defult_first_weight', 'defult_next_weight', 'status'], 'integer'],
            [['defult_first_price', 'defult_next_price'], 'number'],
            [['shipping_code', 'shipping_name'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'shipping_code' => '快递代码',
            'shipping_name' => '快递名称',
            'desc' => '描述',
            'defult_first_weight' => '首重1(KG)',
            'defult_first_price' => '首重价格',
            'defult_next_weight' => '续重(KG)',
            'defult_next_price' => '续重费用',
            'status' => '状态',
        ];
    }

 public static function itemAlias ($type, $code = NULL)

    {
        $_items = [            
            'status' => [
                //''  =>'显示状态',
                '1' => "开启",              
                '2' => "关闭",              
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
                if(!$this->status) $this->status = 1;
                
                //$this->create_time = date("Y-m-d H:i:s", time());
               // $this->update_time = date("Y-m-d H:i:s", time());
            }else{
               // $this->update_time = date("Y-m-d H:i:s", time());
            }
            return true;
        } else {
            return false;
        }
    } 



}

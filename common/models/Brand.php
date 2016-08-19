<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "brand".
 *
 * @property integer $id
 * @property string $name
 * @property string $en_name
 * @property string $img
 * @property string $des
 * @property integer $is_show
 * @property string $create_time
 */
class Brand extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'brand';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['des'], 'string'],
            [['is_show'], 'integer'],
            [['create_time'], 'safe'],
            [['name'], 'string', 'max' => 50],
            [['en_name'], 'string', 'max' => 100],
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
            'name' => '名称',
            'en_name' => '英文名称',
            'img' => '图片',
            'des' => '描述',

            'is_show' => '显示状态',

         

            'create_time' => '创建时间',
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

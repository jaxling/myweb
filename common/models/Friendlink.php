<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "friendlink".
 *
 * @property integer $id
 * @property string $name
 * @property string $href
 * @property string $logo
 * @property integer $position
 * @property integer $status
 * @property string $create_at
 * @property string $update_at
 */
class Friendlink extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'friendlink';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', ], 'required'],
            [['position', 'status'], 'integer'],
            [['create_at', 'update_at'], 'safe'],
            [['name'], 'string', 'max' => 100],
            [['href', 'logo'], 'string', 'max' => 255],
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
            'href' => '链接',
            'logo' => 'Logo',
            'position' => '1全站 2首页 3其它',
            'status' => '状态',
            'create_at' => '创建时间',
            'update_at' => '更新时间',
        ];
    }

    public static function itemAlias ($type, $code = NULL)
    {
        $_items = [

            'status' => [
                ''  =>'状态',
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
                if(!$this->status) $this->status = 1;
                if(!$this->position) $this->position = 1;
                
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

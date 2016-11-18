<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "music".
 *
 * @property integer $id
 * @property string $name
 * @property string $author
 * @property string $image_url
 * @property string $url
 * @property string $description
 * @property string $lyrics
 * @property string $create_time
 * @property string $update_time
 * @property integer $is_show
 * @property integer $order_num
 */
class Music extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'music';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'author', 'image_url', 'url'], 'required'],
            [['description', 'lyrics'], 'string'],
            [['create_time', 'update_time'], 'safe'],
            [['is_show', 'order_num'], 'integer'],
            [['name', 'author'], 'string', 'max' => 50],
            [['image_url', 'url'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '歌名',
            'author' => '歌手',
            'image_url' => '专辑封面',
            'url' => '歌曲链接',
            'description' => '描述',
            'lyrics' => '歌词',
            'create_time' => '创建时间',
            'update_time' => '更新时间',
            'is_show' => '是否显示',
            'order_num' => '排序',
        ];
    }

    public static function itemAlias ($type, $code = NULL)
    {
        $_items = [
            'is_show' => [
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
}

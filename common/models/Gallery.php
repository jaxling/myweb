<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "gallery".
 *
 * @property integer $id
 * @property string $img_url
 * @property string $img_url_thumb
 * @property integer $album_id
 * @property string $title
 * @property string $desc
 * @property integer $is_page_img
 * @property integer $status
 * @property string $create_at
 * @property string $update_at
 */
class Gallery extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gallery';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['img_url', ], 'required'],
            [['album_id', 'is_page_img', 'status'], 'integer'],
            [['desc'], 'string'],
            [['create_at', 'update_at'], 'safe'],
            [['img_url', 'img_url_thumb'], 'string', 'max' => 255],
            [['title'], 'string', 'max' => 50],
        ];
    }

    /**
     * model->galleries
     * @return [type] [description]
     */
    public function getAlbum()
    {
        return $this->hasOne(Album::className(), ['id' => 'album_id']);
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
            
            'album_id' => '相册ID',
            'title' => '标题',
            'desc' => '描述',
            'is_page_img' => '是否封面图 ',
            'status' => '状态',
            'create_at' => '创建时间',
            'update_at' => '更新时间',
            'album.name' => '相册名称',
        ];
    }

    public static function itemAlias ($type, $code = NULL)
    {
        $_items = [
            'is_page_img' => [
                ''  =>'',
                '1' => "否",              
                '2' => "是",
            ],
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
                if(!$this->album_id) $this->album_id = 1;
                if(!$this->is_page_img) $this->is_page_img = 1;
                if(!$this->status) $this->status = 1;
                
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

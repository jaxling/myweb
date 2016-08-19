<?php

namespace common\models;

use Yii;
use common\models\PostComment;

/**
 * This is the model class for table "post".
 *
 * @property integer $id
 * @property string $title
 * @property integer $post_category_id
 * @property string $desc
 * @property string $content
 * @property string $topic_img
 * @property string $author
 * @property integer $status
 * @property integer $hits
 * @property string $create_at
 * @property string $update_at
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['post_category_id', 'status', 'hits'], 'integer'],
            [['desc', 'content'], 'string'],
            [['create_at', 'update_at'], 'safe'],
            [['title'], 'string', 'max' => 50],
            //[['topic_img'], 'string', 'max' => 255],
            [['topic_img'], 'file', 'extensions' => 'gif, jpg, png','mimeTypes' => 'image/jpeg, image/png',],
            [['author'], 'string', 'max' => 20],
        ];
    }

    /**
     * model->postcomment
     * @return [type] [description]
     */
    public function getPostcomment()
    {
        return $this->hasMany(PostComment::className(), ['post_id' => 'id'])
            ->where("status=2")
            ->orderBy('id desc');
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '标题',
            'post_category_id' => '分类',
            'desc' => '描述',
            'content' => '内容',
            'topic_img' => '特色图',
            'author' => '作者',
            'status' => '状态', //1、发布 2、草稿  3、删除
            'hits' => '阅读数',
            'create_at' => '创建时间',
            'update_at' => '更新时间',
        ];
    }

    public static function itemAlias ($type, $code = NULL)
    {
        $_items = [
            'post_category_id' => [
                ''  =>'分类',
                '1' => "关于",              
                '2' => "公告",
                '3' => "帮助",
                '99' => "其它",   
                             
            ],
            'status' => [
                ''  =>'状态',
                '1' => "在职",              
                '2' => "离职",
                '3' => "暂停",                
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
                if(!$this->post_category_id) $this->post_category_id = 1;
                if(!$this->status) $this->status = 1;
                if(!$this->hits) $this->hits = 0;
                
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

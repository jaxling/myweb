<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "post_comment".
 *
 * @property integer $id
 * @property integer $post_id
 * @property string $author
 * @property string $title
 * @property string $content
 * @property integer $status
 * @property string $create_at
 * @property string $update_at
 */
class PostComment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post_comment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post_id', 'author',   'content', ], 'required'],
            [['post_id', 'status'], 'integer'],
            [['content'], 'string'],
            [['create_at', 'update_at'], 'safe'],
            [['author', 'title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'post_id' => 'Post ID',
            'author' => '作者',
            'title' => '标题',
            'content' => '评论',
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
                '1' => "审核中",              
                '2' => "审核通过",
                '3' => "审核失败",                
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

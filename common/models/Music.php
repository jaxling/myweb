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
            [['name', 'author', 'image_url', 'url', 'description', 'lyrics', 'create_time', 'update_time'], 'required'],
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
            'name' => 'Name',
            'author' => 'Author',
            'image_url' => 'Image Url',
            'url' => 'Url',
            'description' => 'Description',
            'lyrics' => 'Lyrics',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
            'is_show' => 'Is Show',
            'order_num' => 'Order Num',
        ];
    }
}

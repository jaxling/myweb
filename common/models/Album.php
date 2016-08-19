<?php

namespace common\models;

use Yii;
use common\models\Gallery;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "album".
 *
 * @property integer $id
 * @property string $name
 * @property string $des
 * @property integer $category_id
 * @property integer $status
 * @property string $create_at
 * @property string $update_at
 */
class Album extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'album';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['des'], 'string'],
            [['category_id', 'status'], 'integer'],
            [['create_at', 'update_at'], 'safe'],
            [['name'], 'string', 'max' => 100],
        ];
    }

    // public function relations()
    // {
    //     // NOTE: you may need to adjust the relation name and the related
    //     // class name for the relations automatically generated below.
    //     return array(
    //         'gallery'=>array(self::HAS_MANY, 'Gallery', 'album_id'),
    //     );
    // }

    /**
     * model->galleries
     * @return [type] [description]
     */
    public function getGalleries()
    {
        return $this->hasMany(Gallery::className(), ['album_id' => 'id'])->orderBy('id desc');;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '名称',
            'des' => '描述',
            'category_id' => '相册分类',
            'status' => '状态',
            'create_at' => '创建时间',
            'update_at' => '更新时间',
        ];
    }

    public static function itemAlias ($type, $code = NULL)
    {
        $_items = [
            'category_id' => [
                ''  =>'分类',
                '1' => "旅行",              
                '2' => "生活",
                '3' => "随笔",
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


     public static function listId(){

        $list = Album::find()
            ->select(['id', 'name'])
            ->orderBy('id asc')
            ->asArray()
            ->all();
        if (!empty($list)) {
            return ArrayHelper::map($list, 'id', 'name');
        }
        return [];
     } 

    /*
    * 保存前执行的操作
    */
    public function beforeSave($insert) {
        if (parent::beforeSave($insert)) {
            //是否是新添加
            if($this->isNewRecord) {
                if(!$this->category_id) $this->category_id = 1;
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

<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "region".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $name
 * @property string $pinyin
 * @property string $code
 * @property integer $level
 */
class Region extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'region';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'level'], 'integer'],
            [['name'], 'required'],
            [['name'], 'string', 'max' => 120],
            [['pinyin', 'code'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => '上级id',
            'name' => '名称',
            'pinyin' => '拼音',
            'code' => '代码',
            'level' => '层级',
        ];
    }
}

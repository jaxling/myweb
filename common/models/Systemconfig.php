<?php

namespace common\models;

use yii\helpers\ArrayHelper;

use Yii;

/**
 * This is the model class for table "systemconfig".
 *
 * @property integer $id
 * @property string $type
 * @property string $name
 * @property string $keyword
 * @property string $value1
 * @property string $value2
 * @property string $value3
 * @property integer $is_open
 * @property integer $sort_number
 * @property string $remark
 * @property string $create_time
 * @property string $update_time
 */
class Systemconfig extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'systemconfig';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'name', 'keyword'], 'required'],
            [['value1', 'value2', 'value3'], 'string'],
            [['is_open', 'sort_number'], 'integer'],
            [['create_time', 'update_time'], 'safe'],
            [['type'], 'string', 'max' => 20],
            [['name'], 'string', 'max' => 200],
            [['keyword', 'remark'], 'string', 'max' => 50],
            [['keyword'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => '类型',
            'name' => '名称',
            'keyword' => '关键字',
            'value1' => '值1',
            'value2' => '值2',
            'value3' => '值3',
            'is_open' => '启用状态 1启用 2关闭',
            'sort_number' => '排序',
            'remark' => '备注',
            'create_time' => '添加时间',
            'update_time' => '更新时间',
        ];
    }

   /*
    获取配制变量名
     */
    public static function getConfigValue($type){
        if (!$type) {
            return false;
        }
        //缓存
        $config_arr = Yii::$app->cache->get('systemconfig_'.$type);
        if ($config_arr === false) {
            $config_arr = array();
            //->asArray()
            $list = Systemconfig::find()->where(['type' => $type])->asArray()->all();
            if (empty($list)) {
                return false;
            }
            //Yii 自带helper
            $config_arr = ArrayHelper::map($list, 'keyword', 'value1');
            // if (empty($config_arr)) {
            //     file_put_contents('/tmp/key_tmp', 'a_'.$type);
            // }
            Yii::$app->cache->set('systemconfig_'.$type, $config_arr, 60*60);          
        }

        return $config_arr;
    }

    /**
     *  @DESC 根据关键字获取某一个具体的配置项
     */
    public static function getValue ($keyword)
    {
        if (!$keyword) 
            return false;
        $info = Systemconfig::find()->where(['keyword' => $keyword])->one();
        if (!$info)
            return false;
        return $info->value1;
    }

    /*
    * 保存前执行的操作
    */
    public function beforeSave($insert) {
        if (parent::beforeSave($insert)) {
            //是否是新添加
            if($this->isNewRecord) {
                if(!$this->sort_number) $this->sort_number = 0;
                if(!$this->is_open) $this->is_open = 1;
                
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

<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "dd".
 *
 * @property integer $id
 * @property string $dd_name
 * @property string $table_name
 * @property string $field_name
 * @property string $field_key
 * @property string $field_value
 * @property integer $num
 * @property integer $status
 */
class Dd extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dd';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dd_name', 'table_name', 'field_name', 'field_key', 'field_value'], 'required'],
            [['num', 'status'], 'integer'],
            [['dd_name', 'table_name', 'field_name', 'field_key'], 'string', 'max' => 50],
            [['field_value'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'dd_name' => '名称',
            'table_name' => '数据表',
            'field_name' => '字段',
            'field_key' => '键值',
            'field_value' => '值',
            'num' => '排序',
            'status' => '状态',//1启用、2停用 3 暂停
        ];
    }

    public static function itemAlias ($type, $code = NULL)
    {
        $_items = [
            'status' => [
                ''  =>'全部',
                '1' => "启用",              
                '2' => "停用",
                '3' => "暂停",                
            ],
        ];

        if (isset($code))
            return isset($_items[$type][$code]) ? $_items[$type][$code] : false;
        else
            return isset($_items[$type]) ? $_items[$type] : false;
    }


    //table_name 数据表  field_name字段
    public static function getDdValue($table_name, $field_name, $field_key = NULL){
        if (!$table_name || !$field_name) {
            return false;
        }
        //常见的字段可以直接写在这里，不需要用数据字典
    


        //$db = Yii::$app->db;
        // $db->createCommand();


        $list = Dd::find()
            ->where(['table_name' => $table_name,'field_name'=>$field_name])
            ->orderBy('id ASC')
            ->all();

        //$list = Dd::model()->findAll('`table_name`=:table_name AND `field_name`=:field_name  AND `status`=1 ORDER BY `num` asc, `id` ASC',array(':table_name'=>$table_name,':field_name'=>$field_name));

        
        if (empty($list)) {
            return false;
        }

        //$dd_list = array(''=>'全部');
        $dd_list = array();
        foreach ($list as $l_key => $l_value) {
            $d_key = $l_value->field_key;
            $dd_list[$d_key] = $l_value->field_value;
        }   
        if ($field_key) {
            return $dd_list[$field_key];
        }
        return $dd_list;

    }

    public function beforeSave($insert) {
        if (parent::beforeSave($insert)) {
            //是否是新添加(回答不需要能够添加)
            if($this->isNewRecord) {
                if (!$this->num) $this->num = 1;
                if(!$this->status) $this->status = 1;
            }else{
                if (!$this->num) $this->num = 1;
            }
            return true;
        } else {
            return false;
        }
    }
}

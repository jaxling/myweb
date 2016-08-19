<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "product_category".
 *
 * @property integer $id
 * @property integer $category_id
 * @property integer $product_id
 */
class ProductCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'product_id'], 'required'],
            [['category_id', 'product_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => '分类id',
            'product_id' => '商品id',
        ];
    }
}

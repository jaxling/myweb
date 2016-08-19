<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Product;

/**
 * ProductSearch represents the model behind the search form about `common\models\Product`.
 */
class ProductSearch extends Product
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'spec', 'weight_unit', 'brand_id', 'stock', 'serial_number', 'full_cut_shipping_free', 'supply', 'is_show'], 'integer'],
            [['name', 'keywords', 'des', 'create_time', 'update_time'], 'safe'],
            [['market_price', 'product_price', 'promotion_price', 'weight'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Product::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'market_price' => $this->market_price,
            'product_price' => $this->product_price,
            'promotion_price' => $this->promotion_price,
            'spec' => $this->spec,
            'weight' => $this->weight,
            'weight_unit' => $this->weight_unit,
            'brand_id' => $this->brand_id,
            'stock' => $this->stock,
            'serial_number' => $this->serial_number,
            'full_cut_shipping_free' => $this->full_cut_shipping_free,
            'supply' => $this->supply,
            'is_show' => $this->is_show,
            'create_time' => $this->create_time,
            'update_time' => $this->update_time,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'keywords', $this->keywords])
            ->andFilterWhere(['like', 'des', $this->des]);

        return $dataProvider;
    }
}

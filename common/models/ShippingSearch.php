<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Shipping;

/**
 * ShippingSearch represents the model behind the search form about `common\models\Shipping`.
 */
class ShippingSearch extends Shipping
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'defult_first_weight', 'defult_next_weight', 'status'], 'integer'],
            [['shipping_code', 'shipping_name', 'desc'], 'safe'],
            [['defult_first_price', 'defult_next_price'], 'number'],
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
        $query = Shipping::find();

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
            'defult_first_weight' => $this->defult_first_weight,
            'defult_first_price' => $this->defult_first_price,
            'defult_next_weight' => $this->defult_next_weight,
            'defult_next_price' => $this->defult_next_price,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'shipping_code', $this->shipping_code])
            ->andFilterWhere(['like', 'shipping_name', $this->shipping_name])
            ->andFilterWhere(['like', 'desc', $this->desc]);

        return $dataProvider;
    }
}

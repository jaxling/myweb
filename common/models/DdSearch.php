<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Dd;

/**
 * DdSearch represents the model behind the search form about `common\models\Dd`.
 */
class DdSearch extends Dd
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'num', 'status'], 'integer'],
            [['dd_name', 'table_name', 'field_name', 'field_key', 'field_value'], 'safe'],
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
        $query = Dd::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 100], 
            'sort'=> ['defaultOrder' => ['table_name'=>SORT_ASC,'field_name'=>SORT_ASC,'num'=>SORT_ASC]],
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
            'num' => $this->num,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'dd_name', $this->dd_name])
            ->andFilterWhere(['like', 'table_name', $this->table_name])
            ->andFilterWhere(['like', 'field_name', $this->field_name])
            ->andFilterWhere(['like', 'field_key', $this->field_key])
            ->andFilterWhere(['like', 'field_value', $this->field_value]);

        return $dataProvider;
    }
}

<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Systemconfig;

/**
 * SystemconfigSearch represents the model behind the search form about `common\models\Systemconfig`.
 */
class SystemconfigSearch extends Systemconfig
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'is_open', 'sort_number'], 'integer'],
            [['type', 'name', 'keyword', 'value1', 'value2', 'value3', 'remark', 'create_time', 'update_time'], 'safe'],
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
        $query = Systemconfig::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 1000], 
            'sort'=> ['defaultOrder' => ['type'=>SORT_ASC,'id'=>SORT_ASC]],            
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
            'is_open' => $this->is_open,
            'sort_number' => $this->sort_number,
            'create_time' => $this->create_time,
            'update_time' => $this->update_time,
        ]);

        $query->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'keyword', $this->keyword])
            ->andFilterWhere(['like', 'value1', $this->value1])
            ->andFilterWhere(['like', 'value2', $this->value2])
            ->andFilterWhere(['like', 'value3', $this->value3])
            ->andFilterWhere(['like', 'remark', $this->remark]);

        return $dataProvider;
    }
}

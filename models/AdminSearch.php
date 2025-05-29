<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Order;

/**
 * AdminSearch represents the model behind the search form of `app\models\Order`.
 */
class AdminSearch extends Order
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'status_id', 'address_dispatch', 'address_delevery', 'type_id'], 'integer'],
            [['date', 'time', 'weight', 'size', 'created_at', 'feedback'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Order::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 3
            ]
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
            'user_id' => $this->user_id,
            'status_id' => $this->status_id,
            'date' => $this->date,
            'time' => $this->time,
            'address_dispatch' => $this->address_dispatch,
            'address_delevery' => $this->address_delevery,
            'type_id' => $this->type_id,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'status_id', $this->status_id])
            ->andFilterWhere(['like', 'type_id', $this->type_id]);

        return $dataProvider;
    }
}

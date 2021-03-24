<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Order;

/**
 * OrderSearch represents the model behind the search form of `app\models\Order`.
 */
class OrderSearch extends Order
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'cat_id', 'user_id', 'status'], 'integer'],
            [['age_cat', 'user_name', 'pickup_date', 'img_path', 'img_name', 'date', 'review', 'cat_type', 'cat_name'], 'safe'],
            [['price'], 'number'],
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


        $query = Order::find()->orderBy([
            'id' => SORT_DESC,

        ])->where('status != 4');;

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
            'cat_id' => $this->cat_id,
            'price' => $this->price,
            'user_id' => $this->user_id,
            'pickup_date' => $this->pickup_date,
            'status' => $this->status,
            'date' => $this->date,
        ]);

        if (Yii::$app->user->can('User')){
            $query->andFilterWhere(['like', 'age_cat', $this->age_cat])
                ->andFilterWhere(['like', 'user_name', $this->user_name])
                ->andFilterWhere(['like', 'img_path', $this->img_path])
                ->andFilterWhere(['like', 'img_name', $this->img_name])
                ->andFilterWhere(['like', 'review', $this->review])
                ->andFilterWhere(['like', 'pickup_date', $this->pickup_date])
                ->andFilterWhere(['like', 'cat_type', $this->cat_type])
                ->andFilterWhere(['like', 'cat_name', $this->cat_name])
                ->andFilterWhere(['user_id'=> Yii::$app->user->identity->id]);
        }else{
            $query->andFilterWhere(['like', 'age_cat', $this->age_cat])
                ->andFilterWhere(['like', 'user_name', $this->user_name])
                ->andFilterWhere(['like', 'img_path', $this->img_path])
                ->andFilterWhere(['like', 'img_name', $this->img_name])
                ->andFilterWhere(['like', 'pickup_date', $this->pickup_date])
                ->andFilterWhere(['like', 'review', $this->review])
                ->andFilterWhere(['like', 'cat_type', $this->cat_type])
                ->andFilterWhere(['like', 'cat_name', $this->cat_name]);
//                 ->andFilterWhere(['user_id'=> Yii::$app->user->identity->id]);
        }


        return $dataProvider;
    }
}

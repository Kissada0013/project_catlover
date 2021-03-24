<?php


namespace app\models\search;


use app\helper\Helper;
use app\models\Cat;
use yii\data\ActiveDataProvider;

class CatSearch extends Cat
{
    public $search;


    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'birthday', 'type', 'color', 'weight','status','search'], 'safe'],
        ];
    }

    public function search($params)
    {
        $query = Cat::find()->orderBy([
            'id' => SORT_DESC,

        ]);;
        // add conditions that should always apply here
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
//        $this->load($params);
        $this->search = \Yii::$app->request->get('search');
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
    $query
    ->orFilterWhere(['like', 'type', $this->search])
        ->orFilterWhere(['like', 'farm', $this->search])
    ->orFilterWhere(['<', 'price', $this->search])

//        ->where('type','=','User')
    ->andFilterWhere(['status'=> 1]);
//        $query->orFilterWhere(['like', 'brithday', $this->search != '' ? Helper::changeDate($this->brithday) : $this->brithday]);
        return $dataProvider;
    }


    public function searchSell($params)
    {
        $query = Cat::find()->orderBy([
            'id' => SORT_DESC,

        ]);;
        // add conditions that should always apply here
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
//        $this->load($params);
        $this->search = \Yii::$app->request->get('search');
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        $query
            ->orFilterWhere(['like', 'type', $this->search])
            ->orFilterWhere(['like', 'farm', $this->search])
            ->orFilterWhere(['<', 'price', $this->search])

//        ->where('type','=','User')
            ->andFilterWhere(['status'=> 0]);
//        $query->orFilterWhere(['like', 'brithday', $this->search != '' ? Helper::changeDate($this->brithday) : $this->brithday]);
        return $dataProvider;
    }



}
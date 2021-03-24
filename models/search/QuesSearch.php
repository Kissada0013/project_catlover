<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Ques;

/**
 * QuesSearch represents the model behind the search form of `app\models\Ques`.
 */
class QuesSearch extends Ques
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id'], 'integer'],
            [['text', 'ans'], 'safe'],
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
        $query = Ques::find();

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
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'text', $this->text])
            ->andFilterWhere(['like', 'ans', $this->ans]);



        if (Yii::$app->user->can('User')){
            $query->andFilterWhere(['like', 'text', $this->text])
                ->andFilterWhere(['like', 'ans', $this->ans])
                ->andFilterWhere(['user_id'=> Yii::$app->user->identity->id]);
        }else{
            $query->andFilterWhere(['like', 'text', $this->text])
                ->andFilterWhere(['like', 'ans', $this->ans]);
        }

        return $dataProvider;
    }
}

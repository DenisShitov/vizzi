<?php

namespace app\modules\admin\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\Support;

/**
 * AdvertSearch represents the model behind the search form of `app\modules\admin\models\Advert`.
 */
class SupportSearch extends Support
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            //[['uid'], 'integer'],
			//[['date_support'], 'date'],
            [['date_support', 'theme', 'name', 'email', 'msg'], 'safe'],
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
        $query = Support::find();

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
        //$query->andFilterWhere([
            //'id' => $this->id,
        //    'auditory' => $this->auditory,
        //    'age' => $this->age,
        //]);

        $query->andFilterWhere(['like', 'date_support', $this->date_support])
            ->andFilterWhere(['like', 'theme', $this->theme])
			->andFilterWhere(['like', 'name', $this->name])
			->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'msg', $this->msg]);

        return $dataProvider;
    }
}

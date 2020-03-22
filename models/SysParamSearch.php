<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SysParam;

/**
 * SysParamSearch represents the model behind the search form of `app\models\SysParam`.
 */
class SysParamSearch extends SysParam
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['PARAM_CODE', 'PARAM_VALUE', 'PARAM_DESC'], 'safe'],
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
        $query = SysParam::find();

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
        $query->andFilterWhere(['like', 'PARAM_CODE', $this->PARAM_CODE])
            ->andFilterWhere(['like', 'PARAM_VALUE', $this->PARAM_VALUE])
            ->andFilterWhere(['like', 'PARAM_DESC', $this->PARAM_DESC]);

        return $dataProvider;
    }
}

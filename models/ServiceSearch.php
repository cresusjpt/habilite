<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Service;

/**
 * ServiceSearch represents the model behind the search form of `app\models\Service`.
 */
class ServiceSearch extends Service
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID_SERVICE', 'IDENTIFIANT'], 'integer'],
            [['NOM_SERVICE', 'ABBR'], 'safe'],
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
        $query = Service::find();

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
            'ID_SERVICE' => $this->ID_SERVICE,
            'IDENTIFIANT' => $this->IDENTIFIANT,
        ]);

        $query->andFilterWhere(['like', 'NOM_SERVICE', $this->NOM_SERVICE])
            ->andFilterWhere(['like', 'ABBR', $this->ABBR]);

        return $dataProvider;
    }
}
<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Valider;

/**
 * ValiderSearch represents the model behind the search form of `app\models\Valider`.
 */
class ValiderSearch extends Valider
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID_SERVICE', 'ID_HABILITE', 'NUM_ORDRE'], 'integer'],
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
        $query = Valider::find();
        $query->groupBy('ID_HABILITE');

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
            'ID_HABILITE' => $this->ID_HABILITE,
            'NUM_ORDRE' => $this->NUM_ORDRE,
        ]);

        return $dataProvider;
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchBYHABILITE(Valider $model,$params)
    {
        $query = Valider::find();
        $query->where(['ID_HABILITE'=>$model->ID_HABILITE])
            ->orderBy('NUM_ORDRE ASC');

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
            'ID_HABILITE' => $this->ID_HABILITE,
            'NUM_ORDRE' => $this->NUM_ORDRE,
        ]);

        return $dataProvider;
    }
}

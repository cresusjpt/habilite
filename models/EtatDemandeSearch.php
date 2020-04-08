<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\EtatDemande;

/**
 * EtatDemandeSearch represents the model behind the search form of `app\models\EtatDemande`.
 */
class EtatDemandeSearch extends EtatDemande
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID_ETAT'], 'integer'],
            [['NOM_ETAT'], 'safe'],
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
        $query = EtatDemande::find();

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
            'ID_ETAT' => $this->ID_ETAT,
        ]);

        $query->andFilterWhere(['like', 'NOM_ETAT', $this->NOM_ETAT]);

        return $dataProvider;
    }
}

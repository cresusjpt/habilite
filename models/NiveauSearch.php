<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Niveau;

/**
 * NiveauSearch represents the model behind the search form of `app\models\Niveau`.
 */
class NiveauSearch extends Niveau
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID_NIVEAU', 'ACTIF', 'IDENTIFIANT', 'ID_HABILITE', 'ID_DEMANDE', 'ID_ETAT', 'NUM_ORDRE', 'ID_SERVICE'], 'integer'],
            [['COMMENTAIRE_NIVEAU','DATE_TRAITEMENT'], 'safe'],
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
        $query = Niveau::find();

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
            'ID_NIVEAU' => $this->ID_NIVEAU,
            'IDENTIFIANT' => $this->IDENTIFIANT,
            'ID_HABILITE' => $this->ID_HABILITE,
            'ID_DEMANDE' => $this->ID_DEMANDE,
            'ID_ETAT' => $this->ID_ETAT,
            'NUM_ORDRE' => $this->NUM_ORDRE,
            'ID_SERVICE' => $this->ID_SERVICE,
        ]);

        $query->andFilterWhere(['like', 'COMMENTAIRE_NIVEAU', $this->COMMENTAIRE_NIVEAU]);

        return $dataProvider;
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchForMe($params)
    {
        $service = Service::findAll([
            'IDENTIFIANT' => \Yii::$app->user->id,
        ]);

        $query = Niveau::find();
        foreach ($service as $item=>$value) {
            $query->orWhere(['ID_SERVICE'=>$value->ID_SERVICE]);
        };
        $query->orWhere([
            'IDENTIFIANT'=> \Yii::$app->user->id,
            'ID_SERVICE' => -1
        ]);

        $query->andWhere(['ACTIF'=>1]);

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
            'ID_NIVEAU' => $this->ID_NIVEAU,
            'IDENTIFIANT' => $this->IDENTIFIANT,
            'ID_HABILITE' => $this->ID_HABILITE,
            'ID_DEMANDE' => $this->ID_DEMANDE,
            'ID_ETAT' => $this->ID_ETAT,
            'NUM_ORDRE' => $this->NUM_ORDRE,
            'ID_SERVICE' => $this->ID_SERVICE,
        ]);

        $query->andFilterWhere(['like', 'COMMENTAIRE_NIVEAU', $this->COMMENTAIRE_NIVEAU]);

        return $dataProvider;
    }
}

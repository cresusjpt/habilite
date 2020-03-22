<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Demande;

/**
 * DemandeSearch represents the model behind the search form of `app\models\Demande`.
 */
class DemandeSearch extends Demande
{
    public $from_date_demande;
    public $to_date_demande;

    public $from_date_traitement;
    public $to_date_traitement;

    public $date_demande_range;
    public $date_traitement_range;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['IDENTIFIANT', 'ID_HABILITE', 'ID_DEMANDE', 'from_date_demande', 'from_date_traitement', 'to_date_demande', 'to_date_traitement'], 'integer'],
            [['ETAT_DEMANDE', 'DATE_DEMANDE', 'DATE_TRAITEMENT', 'SOURCE_DEMANDE', 'date_demande_range', 'date_traitement_range'], 'safe'],
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
        $query = Demande::find();

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
            'IDENTIFIANT' => $this->IDENTIFIANT,
            'ID_HABILITE' => $this->ID_HABILITE,
            'ID_DEMANDE' => $this->ID_DEMANDE,
            'DATE_DEMANDE' => $this->DATE_DEMANDE,
            'DATE_TRAITEMENT' => $this->DATE_TRAITEMENT,
        ]);

        $query->andFilterWhere(['like', 'ETAT_DEMANDE', $this->ETAT_DEMANDE])
            ->andFilterWhere(['like', 'SOURCE_DEMANDE', $this->SOURCE_DEMANDE]);

        if (!empty($this->date_demande_range) && strpos($this->date_demande_range, '-')) {
            $this->date_demande_range = str_replace('/', '-', $this->date_demande_range);
            list($start_date, $end_date) = explode(' - ', $this->date_demande_range);
            $start_date = date('Y-m-d', strtotime($start_date)) . ' 00:00:00';
            $end_date = date('Y-m-d', strtotime($end_date)) . ' 23:59:59';

            $query->andFilterWhere(['between', 'DATE_DEMANDE', $start_date, $end_date]);
        }

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
        $user = \Yii::$app->user->id;
        $query = Demande::find();
        $query->where(['IDENTIFIANT' => $user])
            ->orderBy('DATE_DEMANDE DESC');
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
            'IDENTIFIANT' => $this->IDENTIFIANT,
            'ID_HABILITE' => $this->ID_HABILITE,
            'ID_DEMANDE' => $this->ID_DEMANDE,
            'DATE_DEMANDE' => $this->DATE_DEMANDE,
            'DATE_TRAITEMENT' => $this->DATE_TRAITEMENT,
        ]);

        $query->andFilterWhere(['like', 'ETAT_DEMANDE', $this->ETAT_DEMANDE])
            ->andFilterWhere(['like', 'SOURCE_DEMANDE', $this->SOURCE_DEMANDE]);

        if (!empty($this->date_demande_range) && strpos($this->date_demande_range, '-')) {
            $this->date_demande_range = str_replace('/', '-', $this->date_demande_range);
            list($start_date, $end_date) = explode(' - ', $this->date_demande_range);
            $start_date = date('Y-m-d', strtotime($start_date)) . ' 00:00:00';
            $end_date = date('Y-m-d', strtotime($end_date)) . ' 23:59:59';

            $query->andFilterWhere(['between', 'DATE_DEMANDE', $start_date, $end_date]);
        }

        return $dataProvider;
    }
}

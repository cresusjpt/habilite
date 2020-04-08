<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Utilisateur;

/**
 * UtilisateurSearch represents the model behind the search form of `app\models\Utilisateur`.
 */
class UtilisateurSearch extends Utilisateur
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['IDENTIFIANT', 'ID_SERVICE'], 'integer'],
            [['EMAIL', 'USERNAME', 'PASSWORD', 'AUTH_KEY', 'ACCESS_TOKEN', 'ETAT', 'DM_MODIFICATION', 'PHOTO'], 'safe'],
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
        $query = Utilisateur::find();

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
            'ID_SERVICE' => $this->ID_SERVICE,
            'DM_MODIFICATION' => $this->DM_MODIFICATION,
        ]);

        $query->andFilterWhere(['like', 'EMAIL', $this->EMAIL])
            ->andFilterWhere(['like', 'USERNAME', $this->USERNAME])
            ->andFilterWhere(['like', 'PASSWORD', $this->PASSWORD])
            ->andFilterWhere(['like', 'AUTH_KEY', $this->AUTH_KEY])
            ->andFilterWhere(['like', 'ACCESS_TOKEN', $this->ACCESS_TOKEN])
            ->andFilterWhere(['like', 'ETAT', $this->ETAT])
            ->andFilterWhere(['like', 'PHOTO', $this->PHOTO]);

        return $dataProvider;
    }
}

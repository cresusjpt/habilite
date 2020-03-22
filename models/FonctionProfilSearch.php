<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\FonctionProfil;

/**
 * FonctionProfilSearch represents the model behind the search form of `app\models\FonctionProfil`.
 */
class FonctionProfilSearch extends FonctionProfil
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID_FONCT'], 'integer'],
            [['CODE_PROFIL'], 'safe'],
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
        $query = FonctionProfil::find();

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
            'ID_FONCT' => $this->ID_FONCT,
        ]);

        $query->andFilterWhere(['like', 'CODE_PROFIL', $this->CODE_PROFIL]);

        return $dataProvider;
    }
}

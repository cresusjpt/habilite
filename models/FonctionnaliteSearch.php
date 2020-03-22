<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Fonctionnalite;

/**
 * FonctionnaliteSearch represents the model behind the search form of `app\models\Fonctionnalite`.
 */
class FonctionnaliteSearch extends Fonctionnalite
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID_FONCT', 'ID_MENU'], 'integer'],
            [['NAME_FONCT', 'LIBEL_FONCT', 'FOCNT_URL', 'CONTROLE_FONCT', 'NUM_ORDREFONCT', 'DESCRIPTION_FONCT'], 'safe'],
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
        $query = Fonctionnalite::find();

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
            'ID_MENU' => $this->ID_MENU,
        ]);

        $query->andFilterWhere(['like', 'NAME_FONCT', $this->NAME_FONCT])
            ->andFilterWhere(['like', 'LIBEL_FONCT', $this->LIBEL_FONCT])
            ->andFilterWhere(['like', 'FOCNT_URL', $this->FOCNT_URL])
            ->andFilterWhere(['like', 'CONTROLE_FONCT', $this->CONTROLE_FONCT])
            ->andFilterWhere(['like', 'NUM_ORDREFONCT', $this->NUM_ORDREFONCT])
            ->andFilterWhere(['like', 'DESCRIPTION_FONCT', $this->DESCRIPTION_FONCT]);

        return $dataProvider;
    }
}

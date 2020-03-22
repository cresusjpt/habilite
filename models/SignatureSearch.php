<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Signature;

/**
 * SignatureSearch represents the model behind the search form of `app\models\Signature`.
 */
class SignatureSearch extends Signature
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID_SIGNATURE', 'IDENTIFIANT', 'ACTIF'], 'integer'],
            [['SOURCE_SIGNATURE','CONTENU_SIGNATURE'], 'safe'],
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
        $query = Signature::find();

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
            'ID_SIGNATURE' => $this->ID_SIGNATURE,
            'IDENTIFIANT' => $this->IDENTIFIANT,
            'ACTIF' => $this->ACTIF,
        ]);

        $query->andFilterWhere(['like', 'SOURCE_SIGNATURE', $this->SOURCE_SIGNATURE]);
        $query->andFilterWhere(['like', 'CONTENU_SIGNATURE', $this->CONTENU_SIGNATURE]);

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
        $query = Signature::find();
        $query->where(['IDENTIFIANT'=>$user]);

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
            'ID_SIGNATURE' => $this->ID_SIGNATURE,
            'IDENTIFIANT' => $this->IDENTIFIANT,
            'ACTIF' => $this->ACTIF,
        ]);

        $query->andFilterWhere(['like', 'SOURCE_SIGNATURE', $this->SOURCE_SIGNATURE]);
        $query->andFilterWhere(['like', 'CONTENU_SIGNATURE', $this->CONTENU_SIGNATURE]);

        return $dataProvider;
    }
}

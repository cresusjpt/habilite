<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Notification;

/**
 * NotificationSearch represents the model behind the search form of `app\models\Notification`.
 */
class NotificationSearch extends Notification
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID_NOTIFICATION', 'IDENTIFIANT', 'ID_DEMANDE', 'ACTIF'], 'integer'],
            [['MESSAGE'], 'safe'],
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
        $query = Notification::find();
        $query->orderBy('ID_NOTIFICATION DESC');

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
            'ID_NOTIFICATION' => $this->ID_NOTIFICATION,
            'IDENTIFIANT' => $this->IDENTIFIANT,
            'ID_DEMANDE' => $this->ID_DEMANDE,
            'ACTIF' => $this->ACTIF,
        ]);

        $query->andFilterWhere(['like', 'MESSAGE', $this->MESSAGE]);

        return $dataProvider;
    }
}

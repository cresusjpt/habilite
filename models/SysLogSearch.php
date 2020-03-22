<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SysLog;

/**
 * SysLogSearch represents the model behind the search form of `app\models\SysLog`.
 */
class SysLogSearch extends SysLog
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID_LOG', 'IDENTIFIANT'], 'integer'],
            [['CODE_ACTION', 'DATE_LOG', 'TABLE_LOG', 'LIB_LOG'], 'safe'],
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
        $query = SysLog::find();

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
            'ID_LOG' => $this->ID_LOG,
            'IDENTIFIANT' => $this->IDENTIFIANT,
            'DATE_LOG' => $this->DATE_LOG,
        ]);

        $query->andFilterWhere(['like', 'CODE_ACTION', $this->CODE_ACTION])
            ->andFilterWhere(['like', 'TABLE_LOG', $this->TABLE_LOG])
            ->andFilterWhere(['like', 'LIB_LOG', $this->LIB_LOG]);

        return $dataProvider;
    }
}

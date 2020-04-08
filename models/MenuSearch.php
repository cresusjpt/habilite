<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Menu;

/**
 * MenuSearch represents the model behind the search form of `app\models\Menu`.
 */
class MenuSearch extends Menu
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID_MENU', 'MEN_ID_MENU'], 'integer'],
            [['NAME_MENU', 'LIBEL_MENU', 'ICONE_NAME_MENU', 'CONTROLE', 'NUM_ORDREMENU', 'MENU_URL'], 'safe'],
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
        $query = Menu::find();

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
            'ID_MENU' => $this->ID_MENU,
            'MEN_ID_MENU' => $this->MEN_ID_MENU,
        ]);

        $query->andFilterWhere(['like', 'NAME_MENU', $this->NAME_MENU])
            ->andFilterWhere(['like', 'LIBEL_MENU', $this->LIBEL_MENU])
            ->andFilterWhere(['like', 'ICONE_NAME_MENU', $this->ICONE_NAME_MENU])
            ->andFilterWhere(['like', 'CONTROLE', $this->CONTROLE])
            ->andFilterWhere(['like', 'NUM_ORDREMENU', $this->NUM_ORDREMENU])
            ->andFilterWhere(['like', 'MENU_URL', $this->MENU_URL]);

        return $dataProvider;
    }
}

<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Habilitation]].
 *
 * @see Habilitation
 */
class HabilitationQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Habilitation[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Habilitation|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}

<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Valider]].
 *
 * @see Valider
 */
class ValiderQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Valider[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Valider|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}

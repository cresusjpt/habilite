<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Niveau]].
 *
 * @see Niveau
 */
class NiveauQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Niveau[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Niveau|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}

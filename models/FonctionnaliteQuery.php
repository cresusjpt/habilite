<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Fonctionnalite]].
 *
 * @see Fonctionnalite
 */
class FonctionnaliteQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Fonctionnalite[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Fonctionnalite|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}

<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Profil]].
 *
 * @see Profil
 */
class ProfilQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Profil[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Profil|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}

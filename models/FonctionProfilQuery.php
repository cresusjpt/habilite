<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[FonctionProfil]].
 *
 * @see FonctionProfil
 */
class FonctionProfilQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return FonctionProfil[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return FonctionProfil|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}

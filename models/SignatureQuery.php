<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Signature]].
 *
 * @see Signature
 */
class SignatureQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Signature[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Signature|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}

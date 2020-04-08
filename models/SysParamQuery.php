<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[SysParam]].
 *
 * @see SysParam
 */
class SysParamQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return SysParam[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return SysParam|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}

<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[SysLog]].
 *
 * @see SysLog
 */
class SysLogQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return SysLog[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return SysLog|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}

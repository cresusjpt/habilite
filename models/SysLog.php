<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sys_log".
 *
 * @property int $ID_LOG
 * @property string $CODE_ACTION
 * @property string $IDENTIFIANT
 * @property string $DATE_LOG
 * @property string $TABLE_LOG
 * @property string $LIB_LOG
 *
 * @property Action $cODEACTION
 * @property Utilisateur $eNTIFIANT
 */
class SysLog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sys_log';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID_LOG', 'CODE_ACTION', 'IDENTIFIANT', 'DATE_LOG', 'TABLE_LOG', 'LIB_LOG'], 'required'],
            [['ID_LOG', 'IDENTIFIANT'], 'integer'],
            [['DATE_LOG'], 'safe'],
            [['CODE_ACTION', 'TABLE_LOG', 'LIB_LOG'], 'string', 'max' => 254],
            [['ID_LOG'], 'unique'],
            [['CODE_ACTION'], 'exist', 'skipOnError' => true, 'targetClass' => Action::className(), 'targetAttribute' => ['CODE_ACTION' => 'CODE_ACTION']],
            [['IDENTIFIANT'], 'exist', 'skipOnError' => true, 'targetClass' => Utilisateur::className(), 'targetAttribute' => ['IDENTIFIANT' => 'IDENTIFIANT']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID_LOG' => Yii::t('app', 'Id Log'),
            'CODE_ACTION' => Yii::t('app', 'Code Action'),
            'IDENTIFIANT' => Yii::t('app', 'Identifiant'),
            'DATE_LOG' => Yii::t('app', 'Date Log'),
            'TABLE_LOG' => Yii::t('app', 'Table Log'),
            'LIB_LOG' => Yii::t('app', 'Lib Log'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCODEACTION()
    {
        return $this->hasOne(Action::className(), ['CODE_ACTION' => 'CODE_ACTION']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getENTIFIANT()
    {
        return $this->hasOne(Utilisateur::className(), ['IDENTIFIANT' => 'IDENTIFIANT']);
    }

    /**
     * {@inheritdoc}
     * @return SysLogQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SysLogQuery(get_called_class());
    }
}

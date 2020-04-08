<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "notification".
 *
 * @property int $ID_NOTIFICATION
 * @property int $IDENTIFIANT
 * @property string $MESSAGE
 * @property int $ID_DEMANDE
 * @property int $ACTIF
 *
 * @property Demande $dEMANDE
 */
class Notification extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'notification';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['IDENTIFIANT', 'MESSAGE', 'ID_DEMANDE', 'ACTIF'], 'required'],
            [['IDENTIFIANT', 'ID_DEMANDE', 'ACTIF'], 'integer'],
            [['MESSAGE'], 'string'],
            [['ID_DEMANDE'], 'exist', 'skipOnError' => true, 'targetClass' => Demande::className(), 'targetAttribute' => ['ID_DEMANDE' => 'ID_DEMANDE']],
            [['IDENTIFIANT'], 'exist', 'skipOnError' => true, 'targetClass' => Utilisateur::className(), 'targetAttribute' => ['IDENTIFIANT' => 'IDENTIFIANT']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID_NOTIFICATION' => Yii::t('app', 'Id Notification'),
            'IDENTIFIANT' => Yii::t('app', 'Identifiant'),
            'MESSAGE' => Yii::t('app', 'Message'),
            'ID_DEMANDE' => Yii::t('app', 'Id Demande'),
            'ACTIF' => Yii::t('app', 'Actif'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDEMANDE()
    {
        return $this->hasOne(Demande::className(), ['ID_DEMANDE' => 'ID_DEMANDE']);
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
     * @return NotificationQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new NotificationQuery(get_called_class());
    }
}

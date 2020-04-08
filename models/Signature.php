<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "signature".
 *
 * @property int $ID_SIGNATURE
 * @property string $IDENTIFIANT
 * @property string $SOURCE_SIGNATURE
 * @property string $CONTENU_SIGNATURE
 * @property int $ACTIF
 *
 * @property Utilisateur $eNTIFIANT
 */
class Signature extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'signature';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['IDENTIFIANT', 'CONTENU_SIGNATURE', 'ACTIF'], 'required'],
            [['ID_SIGNATURE', 'IDENTIFIANT', 'ACTIF'], 'integer'],
            [['SOURCE_SIGNATURE'], 'string', 'max' => 254],
            [['ID_SIGNATURE'], 'unique'],
            [['IDENTIFIANT'], 'exist', 'skipOnError' => true, 'targetClass' => Utilisateur::className(), 'targetAttribute' => ['IDENTIFIANT' => 'IDENTIFIANT']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID_SIGNATURE' => Yii::t('app', 'Id Signature'),
            'IDENTIFIANT' => Yii::t('app', 'Identifiant'),
            'SOURCE_SIGNATURE' => Yii::t('app', 'Source Signature'),
            'ACTIF' => Yii::t('app', 'Actif'),
        ];
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
     * @return SignatureQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SignatureQuery(get_called_class());
    }
}

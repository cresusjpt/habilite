<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "service".
 *
 * @property int $ID_SERVICE
 * @property string $IDENTIFIANT
 * @property string $NOM_SERVICE
 * @property string $ABBR
 *
 * @property Utilisateur $eNTIFIANT
 * @property Utilisateur[] $utilisateurs
 * @property Valider[] $validers
 * @property Habilitation[] $hABILITEs
 */
class Service extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'service';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['NOM_SERVICE'], 'required'],
            [['ID_SERVICE', 'IDENTIFIANT'], 'integer'],
            [['NOM_SERVICE', 'ABBR'], 'string', 'max' => 254],
            [['ID_SERVICE'], 'unique'],
            [['IDENTIFIANT'], 'exist', 'skipOnError' => true, 'targetClass' => Utilisateur::className(), 'targetAttribute' => ['IDENTIFIANT' => 'IDENTIFIANT']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID_SERVICE' => Yii::t('app', 'Id Service'),
            'IDENTIFIANT' => Yii::t('app', 'Responsable du service'),
            'NOM_SERVICE' => Yii::t('app', 'Nom Service'),
            'ABBR' => Yii::t('app', 'Abbréviation'),
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
     * @return \yii\db\ActiveQuery
     */
    public function getUtilisateurs()
    {
        return $this->hasMany(Utilisateur::className(), ['ID_SERVICE' => 'ID_SERVICE']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getValiders()
    {
        return $this->hasMany(Valider::className(), ['ID_SERVICE' => 'ID_SERVICE']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHABILITEs()
    {
        return $this->hasMany(Habilitation::className(), ['ID_HABILITE' => 'ID_HABILITE'])->viaTable('valider', ['ID_SERVICE' => 'ID_SERVICE']);
    }

    /**
     * {@inheritdoc}
     * @return ServiceQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ServiceQuery(get_called_class());
    }
}

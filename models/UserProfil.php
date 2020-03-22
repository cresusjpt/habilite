<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_profil".
 *
 * @property string $IDENTIFIANT
 * @property string $CODE_PROFIL
 *
 * @property Profil $cODEPROFIL
 * @property Utilisateur $eNTIFIANT
 */
class UserProfil extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_profil';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['IDENTIFIANT', 'CODE_PROFIL'], 'required'],
            [['IDENTIFIANT'], 'integer'],
            [['CODE_PROFIL'], 'string', 'max' => 254],
            [['IDENTIFIANT', 'CODE_PROFIL'], 'unique', 'targetAttribute' => ['IDENTIFIANT', 'CODE_PROFIL']],
            [['CODE_PROFIL'], 'exist', 'skipOnError' => true, 'targetClass' => Profil::className(), 'targetAttribute' => ['CODE_PROFIL' => 'CODE_PROFIL']],
            [['IDENTIFIANT'], 'exist', 'skipOnError' => true, 'targetClass' => Utilisateur::className(), 'targetAttribute' => ['IDENTIFIANT' => 'IDENTIFIANT']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'IDENTIFIANT' => Yii::t('app', 'Identifiant'),
            'CODE_PROFIL' => Yii::t('app', 'Code Profil'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCODEPROFIL()
    {
        return $this->hasOne(Profil::className(), ['CODE_PROFIL' => 'CODE_PROFIL']);
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
     * @return UserProfilQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserProfilQuery(get_called_class());
    }
}

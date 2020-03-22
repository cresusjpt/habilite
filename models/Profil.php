<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "profil".
 *
 * @property string $CODE_PROFIL
 * @property string $LIBELLE
 *
 * @property FonctionProfil[] $fonctionProfils
 * @property Fonctionnalite[] $fONCTs
 * @property UserProfil[] $userProfils
 * @property Utilisateur[] $eNTIFIANTs
 */
class Profil extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'profil';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['CODE_PROFIL', 'LIBELLE'], 'required'],
            [['CODE_PROFIL', 'LIBELLE'], 'string', 'max' => 254],
            [['CODE_PROFIL'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'CODE_PROFIL' => Yii::t('app', 'Code Profil'),
            'LIBELLE' => Yii::t('app', 'Libelle Profil'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFonctionProfils()
    {
        return $this->hasMany(FonctionProfil::className(), ['CODE_PROFIL' => 'CODE_PROFIL']);
    }

    /**
     * @return \yii\db\ActiveQuery
     * @throws \yii\base\InvalidConfigException
     */
    public function getFONCTs()
    {
        return $this->hasMany(Fonctionnalite::className(), ['ID_FONCT' => 'ID_FONCT'])->viaTable('fonction_profil', ['CODE_PROFIL' => 'CODE_PROFIL']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserProfils()
    {
        return $this->hasMany(UserProfil::className(), ['CODE_PROFIL' => 'CODE_PROFIL']);
    }

    /**
     * @return \yii\db\ActiveQuery
     * @throws \yii\base\InvalidConfigException
     */
    public function getENTIFIANTs()
    {
        return $this->hasMany(Utilisateur::className(), ['IDENTIFIANT' => 'IDENTIFIANT'])->viaTable('user_profil', ['CODE_PROFIL' => 'CODE_PROFIL']);
    }

    /**
     * {@inheritdoc}
     * @return ProfilQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProfilQuery(get_called_class());
    }
}

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fonction_profil".
 *
 * @property string $ID_FONCT
 * @property string $CODE_PROFIL
 *
 * @property Profil $cODEPROFIL
 * @property Fonctionnalite $fONCT
 */
class FonctionProfil extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fonction_profil';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID_FONCT', 'CODE_PROFIL'], 'required'],
            [['ID_FONCT'], 'integer'],
            [['CODE_PROFIL'], 'string', 'max' => 254],
            [['ID_FONCT', 'CODE_PROFIL'], 'unique', 'targetAttribute' => ['ID_FONCT', 'CODE_PROFIL']],
            [['CODE_PROFIL'], 'exist', 'skipOnError' => true, 'targetClass' => Profil::className(), 'targetAttribute' => ['CODE_PROFIL' => 'CODE_PROFIL']],
            [['ID_FONCT'], 'exist', 'skipOnError' => true, 'targetClass' => Fonctionnalite::className(), 'targetAttribute' => ['ID_FONCT' => 'ID_FONCT']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID_FONCT' => Yii::t('app', 'Id Fonct'),
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
    public function getFONCT()
    {
        return $this->hasOne(Fonctionnalite::className(), ['ID_FONCT' => 'ID_FONCT']);
    }

    /**
     * {@inheritdoc}
     * @return FonctionProfilQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FonctionProfilQuery(get_called_class());
    }
}

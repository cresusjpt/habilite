<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fonctionnalite".
 *
 * @property string $ID_FONCT
 * @property int $ID_MENU
 * @property string $NAME_FONCT
 * @property string $LIBEL_FONCT
 * @property string $FOCNT_URL
 * @property string $CONTROLE_FONCT
 * @property string $NUM_ORDREFONCT
 * @property string $ICONE_FONCT
 * @property string $DESCRIPTION_FONCT
 *
 * @property FonctionProfil[] $fonctionProfils
 * @property Profil[] $cODEPROFILs
 * @property Menu $mENU
 */
class Fonctionnalite extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fonctionnalite';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID_MENU', 'NAME_FONCT', 'LIBEL_FONCT', 'FOCNT_URL', 'CONTROLE_FONCT', 'NUM_ORDREFONCT'], 'required'],
            [['ID_FONCT', 'ID_MENU','NUM_ORDREFONCT'], 'integer'],
            [['NAME_FONCT','ICONE_FONCT', 'LIBEL_FONCT', 'FOCNT_URL', 'CONTROLE_FONCT', 'DESCRIPTION_FONCT'], 'string', 'max' => 254],
            [['ID_FONCT'], 'unique'],
            [['ID_MENU'], 'exist', 'skipOnError' => true, 'targetClass' => Menu::className(), 'targetAttribute' => ['ID_MENU' => 'ID_MENU']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID_FONCT' => Yii::t('app', 'Id Fonct'),
            'ID_MENU' => Yii::t('app', 'Menu'),
            'NAME_FONCT' => Yii::t('app', 'Nom Fonctionnalité'),
            'LIBEL_FONCT' => Yii::t('app', 'Libellé de la Fonctionnalité'),
            'FOCNT_URL' => Yii::t('app', 'Url de la fonctionnalité'),
            'CONTROLE_FONCT' => Yii::t('app', 'Contrôle'),
            'NUM_ORDREFONCT' => Yii::t('app', 'Numero d\'Ordre'),
            'DESCRIPTION_FONCT' => Yii::t('app', 'Description de la Fonctionnalité'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFonctionProfils()
    {
        return $this->hasMany(FonctionProfil::className(), ['ID_FONCT' => 'ID_FONCT']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCODEPROFILs()
    {
        return $this->hasMany(Profil::className(), ['CODE_PROFIL' => 'CODE_PROFIL'])->viaTable('fonction_profil', ['ID_FONCT' => 'ID_FONCT']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMENU()
    {
        return $this->hasOne(Menu::className(), ['ID_MENU' => 'ID_MENU']);
    }

    /**
     * {@inheritdoc}
     * @return FonctionnaliteQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FonctionnaliteQuery(get_called_class());
    }
}

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "habilitation".
 *
 * @property int $ID_HABILITE
 * @property int $SERVICE_RESP
 * @property string $NOM_HABILITE
 * @property string $CONTENU_MODELE
 *
 * @property Demande[] $demandes
 * @property Valider[] $validers
 * @property Service[] $sERVICEs
 */
class Habilitation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'habilitation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['NOM_HABILITE', 'CONTENU_MODELE'], 'required'],
            [['ID_HABILITE','SERVICE_RESP'], 'integer'],
            [['CONTENU_MODELE'], 'string'],
            [['NOM_HABILITE'], 'string', 'max' => 254],
            [['ID_HABILITE'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID_HABILITE' => Yii::t('app', 'Id Habilite'),
            'NOM_HABILITE' => Yii::t('app', 'Nom Habilite'),
            'CONTENU_MODELE' => Yii::t('app', 'Contenu Modele'),
            'SERVICE_RESP' => Yii::t('app', 'Signature du responsable du service du demandeur'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDemandes()
    {
        return $this->hasMany(Demande::className(), ['ID_HABILITE' => 'ID_HABILITE']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getValiders()
    {
        return $this->hasMany(Valider::className(), ['ID_HABILITE' => 'ID_HABILITE']);
    }

    /**
     * @return \yii\db\ActiveQuery
     * @throws \yii\base\InvalidConfigException
     */
    public function getSERVICEs()
    {
        return $this->hasMany(Service::class, ['ID_SERVICE' => 'ID_SERVICE'])->viaTable('valider', ['ID_HABILITE' => 'ID_HABILITE']);
    }

    /**
     * {@inheritdoc}
     * @return HabilitationQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new HabilitationQuery(get_called_class());
    }
}

<?php

namespace app\models;

use phpDocumentor\Reflection\Types\String_;
use Yii;

/**
 * This is the model class for table "niveau".
 *
 * @property int $ID_NIVEAU
 * @property string $IDENTIFIANT
 * @property int $ID_HABILITE
 * @property int $ID_DEMANDE
 * @property int $ID_ETAT
 * @property int $NUM_ORDRE
 * @property int $ID_SERVICE
 * @property int $ACTIF
 * @property String $DATE_TRAITEMENT
 * @property String $IP_ADDRESS
 * @property String $HOSTNAME
 * @property String $MAC_ADDRESS
 * @property string $COMMENTAIRE_NIVEAU
 *
 * @property EtatDemande $eTAT
 * @property Demande $eNTIFIANT
 */
class Niveau extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'niveau';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['IDENTIFIANT','DATE_TRAITEMENT', 'ID_HABILITE', 'ID_DEMANDE', 'ID_ETAT', 'NUM_ORDRE', 'ID_SERVICE'], 'required'],
            [['ID_NIVEAU','ACTIF', 'IDENTIFIANT', 'ID_HABILITE', 'ID_DEMANDE', 'ID_ETAT', 'NUM_ORDRE', 'ID_SERVICE'], 'integer'],
            [['COMMENTAIRE_NIVEAU','IP_ADDRESS','HOSTNAME'], 'string', 'max' => 254],
            [['MAC_ADDRESS'], 'string'],
            [['ID_NIVEAU'], 'unique'],
            [['ID_ETAT'], 'exist', 'skipOnError' => true, 'targetClass' => EtatDemande::className(), 'targetAttribute' => ['ID_ETAT' => 'ID_ETAT']],
            [['IDENTIFIANT', 'ID_HABILITE', 'ID_DEMANDE'], 'exist', 'skipOnError' => true, 'targetClass' => Demande::className(), 'targetAttribute' => ['IDENTIFIANT' => 'IDENTIFIANT', 'ID_HABILITE' => 'ID_HABILITE', 'ID_DEMANDE' => 'ID_DEMANDE']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID_NIVEAU' => Yii::t('app', 'Id Niveau'),
            'IDENTIFIANT' => Yii::t('app', 'Identifiant'),
            'ID_HABILITE' => Yii::t('app', 'Id Habilite'),
            'ID_DEMANDE' => Yii::t('app', 'Id Demande'),
            'ID_ETAT' => Yii::t('app', 'Id Etat'),
            'NUM_ORDRE' => Yii::t('app', 'Num Ordre'),
            'ID_SERVICE' => Yii::t('app', 'Id Service'),
            'IP_ADDRESS' => Yii::t('app', 'Adresse Ip du Signataire'),
            'HOSTNAME' => Yii::t('app', 'Hostname'),
            'MAC_ADDRESS' => Yii::t('app', 'Addresses mac'),
            'ACTIF' => Yii::t('app', 'Actif'),
            'COMMENTAIRE_NIVEAU' => Yii::t('app', 'Commentaire'),
            'DATE_TRAITEMENT' => Yii::t('app', 'Date de traitement'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getETAT()
    {
        return $this->hasOne(EtatDemande::className(), ['ID_ETAT' => 'ID_ETAT']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSERVICE()
    {
        return $this->hasOne(Service::className(), ['ID_SERVICE' => 'ID_SERVICE']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getENTIFIANT()
    {
        return $this->hasOne(Demande::className(), ['IDENTIFIANT' => 'IDENTIFIANT', 'ID_HABILITE' => 'ID_HABILITE', 'ID_DEMANDE' => 'ID_DEMANDE']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDENTIFIANT()
    {
        return $this->hasOne(Utilisateur::className(), ['IDENTIFIANT' => 'IDENTIFIANT']);
    }

    /**
     * {@inheritdoc}
     * @return NiveauQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new NiveauQuery(get_called_class());
    }
}

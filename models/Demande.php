<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "demande".
 *
 * @property string $IDENTIFIANT
 * @property int $ID_HABILITE
 * @property int $ID_DEMANDE
 * @property int $OWNER_SIGN
 * @property string $ETAT_DEMANDE
 * @property string $DATE_DEMANDE
 * @property string $DATE_TRAITEMENT
 * @property string $SOURCE_DEMANDE
 * @property string $CONTENU_DEMANDE
 *
 * @property Habilitation $hABILITE
 * @property Utilisateur $eNTIFIANT
 * @property Niveau[] $niveaus
 */
class Demande extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'demande';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['IDENTIFIANT', 'ID_HABILITE', 'ETAT_DEMANDE', 'DATE_DEMANDE', 'CONTENU_DEMANDE', 'SOURCE_DEMANDE'], 'required'],
            [['IDENTIFIANT', 'ID_HABILITE', 'ID_DEMANDE','OWNER_SIGN'], 'integer'],
            [['DATE_DEMANDE', 'DATE_TRAITEMENT'], 'safe'],
            [['ETAT_DEMANDE', 'SOURCE_DEMANDE'], 'string', 'max' => 254],
            [['IDENTIFIANT', 'ID_HABILITE', 'ID_DEMANDE'], 'unique', 'targetAttribute' => ['IDENTIFIANT', 'ID_HABILITE', 'ID_DEMANDE']],
            [['ID_HABILITE'], 'exist', 'skipOnError' => true, 'targetClass' => Habilitation::className(), 'targetAttribute' => ['ID_HABILITE' => 'ID_HABILITE']],
            [['IDENTIFIANT'], 'exist', 'skipOnError' => true, 'targetClass' => Utilisateur::className(), 'targetAttribute' => ['IDENTIFIANT' => 'IDENTIFIANT']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'IDENTIFIANT' => Yii::t('app', 'Demandeur'),
            'ID_HABILITE' => Yii::t('app', 'Id Habilite'),
            'ID_DEMANDE' => Yii::t('app', 'Id Demande'),
            'ETAT_DEMANDE' => Yii::t('app', 'Etat Demande'),
            'OWNER_SIGN' => Yii::t('app', 'Signature du demandeur'),
            'DATE_DEMANDE' => Yii::t('app', 'Date Demande'),
            'DATE_TRAITEMENT' => Yii::t('app', 'Date Traitement'),
            'SOURCE_DEMANDE' => Yii::t('app', 'Source Demande'),
            'detaildemande' => Yii::t('app', 'Detail de la demande'),
        ];
    }

    /**
     * @return string
     * @throws \yii\base\InvalidConfigException
     */
    public function getDetaildemande(){
        return $this->eNTIFIANT->NOM.' '.$this->hABILITE->NOM_HABILITE.' du '.Yii::$app->formatter->asDatetime($this->DATE_DEMANDE);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHABILITE()
    {
        return $this->hasOne(Habilitation::className(), ['ID_HABILITE' => 'ID_HABILITE']);
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
    public function getNiveaus()
    {
        return $this->hasMany(Niveau::className(), ['IDENTIFIANT' => 'IDENTIFIANT', 'ID_HABILITE' => 'ID_HABILITE', 'ID_DEMANDE' => 'ID_DEMANDE']);
    }

    /**
     * {@inheritdoc}
     * @return DemandeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DemandeQuery(get_called_class());
    }
}

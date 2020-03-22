<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "etat_demande".
 *
 * @property int $ID_ETAT
 * @property string $NOM_ETAT
 *
 * @property Niveau[] $niveaus
 */
class EtatDemande extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'etat_demande';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['NOM_ETAT'], 'required'],
            [['ID_ETAT'], 'integer'],
            [['NOM_ETAT'], 'string', 'max' => 254],
            [['ID_ETAT'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID_ETAT' => Yii::t('app', 'Id Etat'),
            'NOM_ETAT' => Yii::t('app', 'Nom Etat'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNiveaus()
    {
        return $this->hasMany(Niveau::class, ['ID_ETAT' => 'ID_ETAT']);
    }

    /**
     * {@inheritdoc}
     * @return EtatDemandeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EtatDemandeQuery(get_called_class());
    }
}

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "valider".
 *
 * @property int $ID_SERVICE
 * @property int $ID_VALIDER
 * @property int $ID_HABILITE
 * @property int $NUM_ORDRE
 *
 * @property Habilitation $hABILITE
 * @property Service $sERVICE
 */
class Valider extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'valider';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID_SERVICE', 'ID_HABILITE', 'NUM_ORDRE'], 'required'],
            [['NUM_ORDRE'], 'integer','min' => 1],
            [['ID_SERVICE', 'ID_HABILITE', 'NUM_ORDRE','ID_VALIDER'], 'integer'],
            [['ID_SERVICE', 'ID_HABILITE'], 'unique', 'targetAttribute' => ['ID_SERVICE', 'ID_HABILITE']],
            [['ID_HABILITE'], 'exist', 'skipOnError' => true, 'targetClass' => Habilitation::className(), 'targetAttribute' => ['ID_HABILITE' => 'ID_HABILITE']],
            [['ID_SERVICE'], 'exist', 'skipOnError' => true, 'targetClass' => Service::className(), 'targetAttribute' => ['ID_SERVICE' => 'ID_SERVICE']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID_SERVICE' => Yii::t('app', 'Id Service'),
            'ID_VALIDER' => Yii::t('app', 'Id Validateur'),
            'ID_HABILITE' => Yii::t('app', 'Id Habilite'),
            'NUM_ORDRE' => Yii::t('app', 'Num Ordre'),
        ];
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
    public function getSERVICE()
    {
        return $this->hasOne(Service::className(), ['ID_SERVICE' => 'ID_SERVICE']);
    }

    /**
     * {@inheritdoc}
     * @return ValiderQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ValiderQuery(get_called_class());
    }
}

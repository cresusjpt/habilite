<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "menu".
 *
 * @property int $ID_MENU
 * @property int $MEN_ID_MENU
 * @property string $NAME_MENU
 * @property string $LIBEL_MENU
 * @property string $ICONE_NAME_MENU
 * @property string $CONTROLE
 * @property string $NUM_ORDREMENU
 * @property string $MENU_URL
 *
 * @property Fonctionnalite[] $fonctionnalites
 * @property Menu $mENIDMENU
 * @property Menu[] $menus
 */
class Menu extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'menu';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID_MENU', 'NAME_MENU', 'LIBEL_MENU', 'CONTROLE'], 'required'],
            [['ID_MENU', 'MEN_ID_MENU'], 'integer'],
            [['NAME_MENU', 'LIBEL_MENU', 'ICONE_NAME_MENU', 'CONTROLE', 'NUM_ORDREMENU', 'MENU_URL'], 'string', 'max' => 254],
            [['ID_MENU'], 'unique'],
            [['MEN_ID_MENU'], 'exist', 'skipOnError' => true, 'targetClass' => Menu::className(), 'targetAttribute' => ['MEN_ID_MENU' => 'ID_MENU']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID_MENU' => Yii::t('app', 'Id Menu'),
            'MEN_ID_MENU' => Yii::t('app', 'Men Id Menu'),
            'NAME_MENU' => Yii::t('app', 'Name Menu'),
            'LIBEL_MENU' => Yii::t('app', 'Libel Menu'),
            'ICONE_NAME_MENU' => Yii::t('app', 'Icone Name Menu'),
            'CONTROLE' => Yii::t('app', 'Controle'),
            'NUM_ORDREMENU' => Yii::t('app', 'Num Ordremenu'),
            'MENU_URL' => Yii::t('app', 'Menu Url'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFonctionnalites()
    {
        return $this->hasMany(Fonctionnalite::className(), ['ID_MENU' => 'ID_MENU']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMENIDMENU()
    {
        return $this->hasOne(Menu::className(), ['ID_MENU' => 'MEN_ID_MENU']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMenus()
    {
        return $this->hasMany(Menu::className(), ['MEN_ID_MENU' => 'ID_MENU']);
    }

    /**
     * {@inheritdoc}
     * @return MenuQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MenuQuery(get_called_class());
    }
}

<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "utilisateur".
 *
 * @property string $IDENTIFIANT
 * @property int $ID_SERVICE
 * @property string $NOM
 * @property string $EMAIL
 * @property string $USERNAME
 * @property string $PASSWORD
 * @property string $rawpassword
 * @property string $AUTH_KEY
 * @property string $ACCESS_TOKEN
 * @property string $ETAT
 * @property string $DM_MODIFICATION
 * @property string $FONCTION
 * @property string $PHOTO
 *
 * @property Demande[] $demandes
 * @property Service[] $services
 * @property Signature[] $signatures
 * @property SysLog[] $sysLogs
 * @property UserProfil[] $userProfils
 * @property Profil[] $cODEPROFILs
 * @property Service $sERVICE
 */
class Utilisateur extends \yii\db\ActiveRecord implements IdentityInterface
{
    public $rawpassword;
    public $oldpassword;
    public $newpassword;
    public $repeatpassword;

    public $file;

    public $profil;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'utilisateur';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID_SERVICE', 'NOM', 'EMAIL', 'USERNAME', 'PASSWORD', 'ETAT', 'rawpassword'], 'required'],
            ['USERNAME', 'unique', 'targetClass' => 'app\models\Utilisateur', 'message' => 'Le nom d\'utilisateur est déjà pris'],
            [['IDENTIFIANT', 'ID_SERVICE'], 'integer'],
            [['rawpassword'], 'string', 'min' => 8, 'message' => 'Le mot de passe doit être supérieur ou égale à 8'],
            [['PASSWORD'], 'string', 'min' => 8, 'message' => 'Le mot de passe doit être supérieur ou égale à 8'],
            ['rawpassword', 'passwordConform'],
            [['file'], 'file'],
            [['EMAIL'], 'email'],
            [['oldpassword', 'rawpassword', 'newpassword', 'repeatpassword', 'ACCESS_TOKEN', 'DM_MODIFICATION','profil'], 'safe'],
            [['EMAIL', 'USERNAME', 'NOM', 'PASSWORD', 'AUTH_KEY', 'ACCESS_TOKEN', 'ETAT','FONCTION', 'PHOTO'], 'string', 'max' => 254],
            [['IDENTIFIANT'], 'unique'],
            [['ID_SERVICE'], 'exist', 'skipOnError' => true, 'targetClass' => Service::className(), 'targetAttribute' => ['ID_SERVICE' => 'ID_SERVICE']],
        ];
    }

    public function bothPasswordConform($attribute, $params)
    {
        if (!$this->hasErrors()) {
            if (!$this->password === $this->rawpassword) {
                $this->addError($this->rawpassword, "Les deux mots de passe ne sont pas conforme");
                $this->addError($attribute, "Les deux mots de passe ne sont pas conforme");
            }
        }
    }

    /**
     * @param $attribute
     * @param $params
     * @return bool
     */
    public function passwordConform($attribute, $params)
    {
        if (!$this->hasErrors()) {
            if (preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{8,}$#', $this->rawpassword)) {
                return true;
            }
        }
        return false;
    }

    public function verifyIsConform($password)
    {
        if (!$this->hasErrors()) {
            if (preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{8,}$#', $password)) {
                return true;
            }
        }
        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'IDENTIFIANT' => Yii::t('app', 'ID'),
            'ID_SERVICE' => Yii::t('app', 'Service'),
            'EMAIL' => Yii::t('app', 'Email'),
            'NOM' => Yii::t('app', 'Nom'),
            'USERNAME' => Yii::t('app', 'Nom d\'utilisateur'),
            'PASSWORD' => Yii::t('app', 'Mot de passe'),
            'rawpassword' => Yii::t('app', 'Confirmer mot de passe'),
            'AUTH_KEY' => Yii::t('app', 'Auth Key'),
            'ACCESS_TOKEN' => Yii::t('app', 'Access Token'),
            'ETAT' => Yii::t('app', 'Etat'),
            'DM_MODIFICATION' => Yii::t('app', 'Date de derniere Modification'),
            'PHOTO' => Yii::t('app', 'Photo de profil'),
            'FONCTION' => Yii::t('app', 'Fonction'),
            'oldpassword' => Yii::t('app', 'Ancien mot de passe'),
            'newpassword' => Yii::t('app', 'Nouveau mot de passe'),
            'repeatpassword' => Yii::t('app', 'Confirmer nouveau mot de passe'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDemandes()
    {
        return $this->hasMany(Demande::className(), ['IDENTIFIANT' => 'IDENTIFIANT']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServices()
    {
        return $this->hasMany(Service::className(), ['IDENTIFIANT' => 'IDENTIFIANT']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSignatures()
    {
        return $this->hasMany(Signature::className(), ['IDENTIFIANT' => 'IDENTIFIANT']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSysLogs()
    {
        return $this->hasMany(SysLog::className(), ['IDENTIFIANT' => 'IDENTIFIANT']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserProfils()
    {
        return $this->hasMany(UserProfil::className(), ['IDENTIFIANT' => 'IDENTIFIANT']);
    }

    /**
     * @return \yii\db\ActiveQuery
     * @throws \yii\base\InvalidConfigException
     */
    public function getCODEPROFILs()
    {
        return $this->hasMany(Profil::className(), ['CODE_PROFIL' => 'CODE_PROFIL'])->viaTable('user_profil', ['IDENTIFIANT' => 'IDENTIFIANT']);
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
     * @return UtilisateurQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UtilisateurQuery(get_called_class());
    }

    /**
     * Finds an identity by the given ID.
     * @param string|int $id the ID to be looked for
     * @return IdentityInterface|null the identity object that matches the given ID.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentity($id)
    {
        return static::findOne([
            'IDENTIFIANT' => $id
        ]);
    }

    /**
     * Finds an identity by the given token.
     * @param mixed $token the token to be looked for
     * @param mixed $type the type of the token. The value of this parameter depends on the implementation.
     * For example, [[\yii\filters\auth\HttpBearerAuth]] will set this parameter to be `yii\filters\auth\HttpBearerAuth`.
     * @return IdentityInterface|null the identity object that matches the given token.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne([
            'ACCESS_TOKEN' => $token
        ]);
    }

    public static function findByUsername($username)
    {
        return static::findOne([
            'USERNAME' => $username,
        ]);
    }

    /**
     * Returns an ID that can uniquely identify a user identity.
     * @return string|int an ID that uniquely identifies a user identity.
     */
    public function getId()
    {
        return $this->IDENTIFIANT;
    }

    /**
     * Returns a key that can be used to check the validity of a given identity ID.
     *
     * The key should be unique for each individual user, and should be persistent
     * so that it can be used to check the validity of the user identity.
     *
     * The space of such keys should be big enough to defeat potential identity attacks.
     *
     * This is required if [[User::enableAutoLogin]] is enabled. The returned key will be stored on the
     * client side as a cookie and will be used to authenticate user even if PHP session has been expired.
     *
     * Make sure to invalidate earlier issued authKeys when you implement force user logout, password change and
     * other scenarios, that require forceful access revocation for old sessions.
     *
     * @return string a key that is used to check the validity of a given identity ID.
     * @see validateAuthKey()
     */
    public function getAuthKey()
    {
        return $this->AUTH_KEY;
    }

    /**
     * Validates the given auth key.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @param string $authKey the given auth key
     * @return bool whether the given auth key is valid.
     * @see getAuthKey()
     */
    public function validateAuthKey($authKey)
    {
        return $this->AUTH_KEY = $authKey;
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param $password
     * @return void
     * @throws yii\base\Exception
     */
    public function setPassword($password)
    {
        $this->PASSWORD = Yii::$app->security->generatePasswordHash($password);
    }

    public function isSamePassword($password1, $password2)
    {
        if ($password1 === $password2) {
            return true;
        }
        return false;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        //return true;
        return Yii::$app->security->validatePassword($password, $this->PASSWORD);
    }

    /**
     * @throws \yii\base\Exception
     */
    public function generateAuthKey()
    {
        $this->AUTH_KEY = Yii::$app->security->generateRandomString();
    }

    /**
     * @throws \yii\base\Exception
     */
    public function generateAccessToken()
    {
        $this->ACCESS_TOKEN = Yii::$app->security->generateRandomString();
    }
}

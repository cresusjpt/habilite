<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property Utilisateur|null $user This property is read-only.
 *
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => Yii::t('app', 'Nom d\'utilisateur'),
            'password' => Yii::t('app', 'Mot de passe'),
            'rememberMe' => Yii::t('app', 'Rester connecté'),
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Nom d\'utilisateur ou mot de passe incorrect.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            $user = $this->getUser();
            if ($user->ETAT = 'ACTIF'){
                return Yii::$app->user->login($this->getUser(),$this->rememberMe ? 3600 * 24 : 0); //one day if remember me is checked
            }else{
                Yii::$app->session->setFlash('warning', 'Votre compte a été desactivé. Veuillez contacter l\'administrateur');
            }
        }
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return Utilisateur|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = Utilisateur::findByUsername($this->username);
        }

        return $this->_user;
    }
}

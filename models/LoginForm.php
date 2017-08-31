<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class LoginForm extends Model
{
    const USERNAME = 'username';
    const USER_PASS = 'password';
    public $username;
    public $password;
    public $rememberMe = true;
    private $user = false;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [[self::USERNAME, self::USER_PASS], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            [self::USER_PASS, 'validatePassword'],

            [[self::USERNAME], 'match', 'pattern' => "/^.{1,45}$/", 'message' => 'Mínimo 1 caracter'],
            [[self::USERNAME], 'email', 'message' => 'Tiene que ser un correo válido.'],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            self::USERNAME => 'Usuario',
            self::USER_PASS => 'Contraseña',
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     */
    public function validatePassword($attribute)
    {
        if (!$this->hasErrors()) {
            if (!$this->getUser()) {
                $this->addError($attribute, 'Usuario ingresado es incorrecto.');
            } elseif (!$this->getUser()->validatePassword($this->password)) {
                $this->addError($attribute, 'Contraseña ingresada es incorrecta.');
            } elseif (!$this->getUser() && !$this->getUser()->validatePassword($this->password)) {
                $this->addError($attribute, 'Usuario ó Contraseña Incorrecta.');
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
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        }

        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->user === false) {
            $this->user = User::findByUsername($this->username, true);
        }

        return $this->user;
    }
}

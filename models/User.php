<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * Class User
 * This is the model class for table "usuario".
 * @package app\models
 * @property integer $id
 * @property integer $cliente_id
 * @property string $nombres
 * @property string $correo
 * @property string $contrasena
 * @property string $authKey
 * @property string $accessToken
 * @property integer $estado
 * @property string $fecha_digitada
 * @property string $fecha_modificada
 * @property string $fecha_eliminada
 * @property string $usuario_digitado
 * @property string $usuario_modificado
 * @property string $usuario_eliminado
 * @property string $ip
 * @property string $host
 */

class User extends ActiveRecord implements IdentityInterface
{
    const MESSAGE_MIN_6_PW = "Mínimo 6 digitos para la contraseña.";
    const MESSAGE_MIN_6_PW_REP = "Mínimo 6 digitos para la contraseña repetida.";
    const MESSAGE_COMPARE = "Las contraseñas no coinciden.";
    const FIELD_VALID = "El campo correo debe de ser válido.";
    const MESSAGE_MIN_3 = "Mínimo 3 caracteres del correo corporativo.";

    public $contrasena_desc;

    /**
     * @return string
     */
    public static function tableName()
    {
        return 'usuario';
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['estado'], 'integer'],
            [['nombres', 'contrasena', 'contrasena_desc', 'correo', 'estado'], 'required'],
            ['correo', 'unique'],
            [['correo'], 'match', 'pattern' => "/^.{3,45}$/", 'message' => self::MESSAGE_MIN_3],
            [['correo'], 'email', 'message' => self::FIELD_VALID],
            ['contrasena', 'match', 'pattern' => "/^.{6,255}$/", 'message' => self::MESSAGE_MIN_6_PW],
            ['contrasena_desc', 'match', 'pattern' => "/^.{6,255}$/", 'message' => self::MESSAGE_MIN_6_PW_REP],
            ['contrasena_desc', 'compare', 'compareAttribute' => 'contrasena', 'message' => self::MESSAGE_COMPARE],
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cliente_id' => 'Cliente ID',
            'nombres' => 'Nombres',
            'correo' => 'Correo Corporativo',
            'contrasena' => 'Contraseña',
            'contrasena_desc' => 'Repetir Contraseña',
            'authKey' => 'Auth Key',
            'accessToken' => 'Access Token',
            'estado' => 'Estado',
            'fecha_digitada' => 'Fecha Digitada',
            'fecha_modificada' => 'Fecha Modificada',
            'fecha_eliminada' => 'Fecha Eliminada',
            'usuario_digitado' => 'Usuario Digitado',
            'usuario_modificado' => 'Usuario Modificado',
            'usuario_eliminado' => 'Usuario Eliminado',
            'ip' => 'Ip',
            'host' => 'Host',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRutas()
    {
        return $this->hasMany(Ruta::className(), ['usuario_id' => 'id']);
    }

    /**
     * @param int|string $id
     * @return User|array|null|ActiveRecord
     */
    public static function findIdentity($id)
    {
        return static::find()->select([
            'id',
            'nombres',
            'correo',
            'contrasena',
        ])->where('id = :id', [':id' => $id])->one();
    }

    /**
     * @param mixed $token
     * @param null $type
     * @return User|array|null|ActiveRecord
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::find()->select([
            'id',
            'nombres',
            'correo',
            'contrasena',
        ])->where('accessToken = :token', [':token' => $token])->one();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @param string $authKey
     * @return bool
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * @param $username
     * @param $estado
     * @return User|array|null|ActiveRecord
     */
    public static function findByUsername($username, $estado)
    {
        return self::find()->select([
            'id',
            'nombres',
            'correo',
            'contrasena',
        ])->where([
            'correo' => $username,
            'estado' => (int)$estado,
        ])->one();
    }

    /**
     * @param $password
     * @return bool
     */
    public function validatePassword($password)
    {
        return Yii::$app->getSecurity()->validatePassword($password, $this->contrasena);
    }

    /**
     * @param $password
     */
    public function setPassword($password)
    {
        $this->contrasena = Yii::$app->getSecurity()->generatePasswordHash($password);
    }
}


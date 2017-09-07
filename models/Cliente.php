<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cliente".
 *
 * @property integer $id
 * @property string $nombres
 * @property string $apellidos
 * @property string $email
 * @property integer $dni
 * @property string $numero_celular
 * @property string $area
 * @property string $cargo
 * @property string $fecha_digitada
 * @property string $fecha_modificada
 * @property string $fecha_eliminada
 * @property string $usuario_digitado
 * @property string $usuario_modificado
 * @property string $usuario_eliminado
 * @property integer $estado
 * @property string $ip
 * @property string $host
 */
class Cliente extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cliente';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'nombres', 'apellidos', 'email', 'dni', 'numero_celular', 'area', 'cargo'], 'required'],
            [['id', 'dni', 'estado'], 'integer'],
            [['fecha_digitada', 'fecha_modificada', 'fecha_eliminada'], 'safe'],
            [['nombres', 'apellidos', 'email', 'numero_celular', 'area', 'cargo', 'host'], 'string', 'max' => 150],
            [['usuario_digitado', 'usuario_modificado', 'usuario_eliminado'], 'string', 'max' => 50],
            [['ip'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombres' => 'Nombres',
            'apellidos' => 'Apellidos',
            'email' => 'Email',
            'dni' => 'Dni',
            'numero_celular' => 'Numero Celular',
            'area' => 'Area',
            'cargo' => 'Cargo',
            'fecha_digitada' => 'Fecha Digitada',
            'fecha_modificada' => 'Fecha Modificada',
            'fecha_eliminada' => 'Fecha Eliminada',
            'usuario_digitado' => 'Usuario Digitado',
            'usuario_modificado' => 'Usuario Modificado',
            'usuario_eliminado' => 'Usuario Eliminado',
            'estado' => 'Estado',
            'ip' => 'Ip',
            'host' => 'Host',
        ];
    }
}

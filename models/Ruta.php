<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ruta".
 *
 * @property integer $id
 * @property string $rol_usuario
 * @property string $nombre_url
 * @property string $url
 * @property string $fecha_digitada
 * @property string $fecha_modificada
 * @property string $fecha_eliminada
 * @property string $usuario_digitado
 * @property string $usuario_modificado
 * @property string $usuario_eliminado
 * @property string $ip
 * @property string $host
 * @property integer $estado
 */
class Ruta extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ruta';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fecha_digitada', 'fecha_modificada', 'fecha_eliminada'], 'safe'],
            [['estado'], 'integer'],
            [['rol_usuario', 'ip'], 'string', 'max' => 30],
            [['nombre_url', 'url'], 'string', 'max' => 150],
            [['usuario_digitado', 'usuario_modificado', 'usuario_eliminado'], 'string', 'max' => 50],
            [['host'], 'string', 'max' => 40],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'rol_usuario' => 'Rol Usuario',
            'nombre_url' => 'Nombre Url',
            'url' => 'Url',
            'fecha_digitada' => 'Fecha Digitada',
            'fecha_modificada' => 'Fecha Modificada',
            'fecha_eliminada' => 'Fecha Eliminada',
            'usuario_digitado' => 'Usuario Digitado',
            'usuario_modificado' => 'Usuario Modificado',
            'usuario_eliminado' => 'Usuario Eliminado',
            'ip' => 'Ip',
            'host' => 'Host',
            'estado' => 'Estado',
        ];
    }
}

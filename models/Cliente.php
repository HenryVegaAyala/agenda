<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cliente".
 *
 * @property integer $id
 * @property string $nombres
 * @property string $apellidos
 * @property string $dni
 * @property string $fecha_nacimiento
 * @property string $genero
 * @property string $email_personal
 * @property string $ubicacion
 * @property string $estado_civil
 * @property string $numero_celular
 * @property string $area
 * @property string $puesto
 * @property string $categoria
 * @property string $email_corp
 * @property string $numero_emergencia
 * @property string $fecha_ingreso
 * @property string $numero_oficina
 * @property string $anexo
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
            [['nombres', 'apellidos', 'dni', 'email_corp'], 'required'],
            [['fecha_nacimiento', 'fecha_ingreso', 'fecha_digitada', 'fecha_modificada', 'fecha_eliminada'], 'safe'],
            [['estado'], 'integer'],
            [['nombres', 'apellidos', 'email_personal', 'area', 'email_corp', 'host'], 'string', 'max' => 150],
            [['dni', 'numero_celular'], 'string', 'max' => 15],
            [['genero'], 'string', 'max' => 1],
            [['ubicacion'], 'string', 'max' => 250],
            [['estado_civil'], 'string', 'max' => 2],
            [['puesto', 'categoria', 'numero_emergencia'], 'string', 'max' => 45],
            [['numero_oficina', 'anexo'], 'string', 'max' => 20],
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
            'dni' => 'Dni',
            'fecha_nacimiento' => 'Fecha Nacimiento',
            'genero' => 'Genero',
            'email_personal' => 'Email Personal',
            'ubicacion' => 'Ubicacion',
            'estado_civil' => 'Estado Civil',
            'numero_celular' => 'Numero Celular',
            'area' => 'Área',
            'puesto' => 'Puesto',
            'categoria' => 'Categoria',
            'email_corp' => 'Email',
            'numero_emergencia' => 'Numero Emergencia',
            'fecha_ingreso' => 'Fecha Ingreso',
            'numero_oficina' => 'Numero Oficina',
            'anexo' => 'Anexo',
        ];
    }
}

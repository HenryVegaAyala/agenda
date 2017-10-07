<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * Class Cliente
 * @property false|null|string id
 * @property false|string fecha_nacimiento
 * @property false|string fecha_ingreso
 * @property false|string estado
 * @package app\models
 */
class Cliente extends ActiveRecord
{
    public $image;
    public $excel_import;

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
            [['fecha_nacimiento', 'fecha_ingreso'], 'safe'],
            //[['fecha_nacimiento', 'fecha_ingreso'], 'date'],
            [['estado'], 'integer'],
            [['nombres', 'apellidos', 'email_personal', 'area', 'email_corp', 'host'], 'string', 'max' => 150],
            [['dni', 'numero_celular'], 'string', 'max' => 15],
            [['genero'], 'string', 'max' => 1],
            [['ubicacion', 'fecha_nacimiento', 'fecha_ingreso'], 'string', 'max' => 250],
            [['estado_civil'], 'string', 'max' => 2],
            [['puesto', 'categoria', 'numero_emergencia'], 'string', 'max' => 45],
            [['numero_oficina', 'anexo'], 'string', 'max' => 20],
            [['usuario_digitado', 'usuario_modificado', 'usuario_eliminado'], 'string', 'max' => 50],
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
            'dni' => 'DNI',
            'fecha_nacimiento' => 'Fecha de Nacimiento',
            'genero' => 'Género',
            'email_personal' => 'Email Personal',
            'ubicacion' => 'Ubicación',
            'estado_civil' => 'Estado Civil',
            'numero_celular' => 'Número de Celular',
            'area' => 'Área',
            'puesto' => 'Puesto',
            'categoria' => 'Categoría',
            'email_corp' => 'Email',
            'numero_emergencia' => 'Numero de Emergencia',
            'fecha_ingreso' => 'Fecha de Ingreso',
            'numero_oficina' => 'Número Oficina',
            'anexo' => 'Anexo',
            'image' => 'Foto',
            'excel_import' => 'Excel',
        ];
    }

    /**
     * @return Cliente[]|array|\yii\db\ActiveRecord[]
     */
    public static function listaClientes()
    {
        return Cliente::find()
            ->select([
                'nombres',
                'apellidos',
                'email_corp',
                'dni',
                'area',
                'categoria',
                'puesto',
                '(CASE WHEN genero = \'M\' THEN \'MASCULINO\' ELSE \'FEMENINO\' END) AS genero',
                'date_format(fecha_nacimiento, \'%d-%m-%Y\')   AS fecha_nacimiento',
                'date_format(fecha_ingreso, \'%d-%m-%Y\')   AS fecha_ingreso',
                '(CASE
                   WHEN estado_civil = \'CO\' THEN \'COMPROMETIDO\'
                   WHEN estado_civil = \'CA\' THEN \'CASADO\'
                   WHEN estado_civil = \'SO\' THEN \'SOLTERO\'
                   WHEN estado_civil = \'VI\' THEN \'VIUDO\'
                   ELSE \'FEMENINO\' END) AS estado_civil',
            ])
            ->where('estado = :estado', [':estado' => 1])
            ->all();
    }
}

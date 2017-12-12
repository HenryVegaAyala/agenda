<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "cliente".
 *
 * @property integer $id
 * @property integer $empresa_id
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
 * @property string tipo
 * @property string empresa
 *
 * @property Incidencia[] $incidencias
 */
class Cliente extends ActiveRecord
{
    public $image;
    public $excel_import;

    /**
     * @inheritdoc
     */
    public static function tableName(): string
    {
        return 'cliente';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['empresa_id', 'estado'], 'integer'],
            [['nombres', 'apellidos', 'email_corp', 'area'], 'required'],
            [['fecha_nacimiento', 'fecha_ingreso', 'fecha_digitada', 'fecha_modificada', 'fecha_eliminada'], 'safe'],
            [['nombres', 'apellidos', 'email_personal', 'area', 'email_corp', 'host'], 'string', 'max' => 150],
            [['dni', 'numero_celular'], 'string', 'max' => 15],
            [['genero'], 'string', 'max' => 1],
            [['ubicacion', 'fecha_nacimiento', 'fecha_ingreso', 'empresa'], 'string', 'max' => 250],
            [['tipo'], 'string', 'max' => 200],
            [['estado_civil'], 'string', 'max' => 2],
            [['puesto', 'categoria', 'numero_emergencia'], 'string', 'max' => 45],
            [['numero_oficina', 'anexo'], 'string', 'max' => 20],
            [['dni'], 'string', 'max' => 8],
            [['usuario_digitado', 'usuario_modificado', 'usuario_eliminado'], 'string', 'max' => 50],
            [['ip'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'empresa_id' => 'Empresa ID',
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
            'estado' => 'Estado',
            'fecha_digitada' => 'Fecha Digitada',
            'fecha_modificada' => 'Fecha Modificada',
            'fecha_eliminada' => 'Fecha Eliminada',
            'usuario_digitado' => 'Usuario Digitado',
            'usuario_modificado' => 'Usuario Modificado',
            'usuario_eliminado' => 'Usuario Eliminado',
            'ip' => 'Ip',
            'host' => 'Host',
            'image' => 'Foto',
            'excel_import' => 'Excel',
            'tipo' => 'Tipo',
            'empresa' => 'Empresa',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIncidencias(): ActiveQuery
    {
        return $this->hasMany(Incidencia::className(), ['cliente_id' => 'id']);
    }

    /**
     * @param $empresa
     * @return array|ActiveRecord[]
     */
    public static function listaClientes($empresa): array
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
            ->andWhere('empresa_id = :empresa', [':empresa' => $empresa])
            ->all();
    }

    /**
     * @param $empresa
     * @return array|ActiveRecord[]
     */
    public static function listaAnalistas($empresa)
    {
        return Cliente::find()
            ->select([
                'cliente.nombres',
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
            ->where('cliente.estado = :estado', [':estado' => 1])
            ->andWhere('cliente.empresa_id = :empresa', [':empresa' => $empresa])
            ->andWhere(' usuario.type = :type', [':type' => 2])
            ->andWhere(' usuario.cliente_id <> :cliente_id', [':cliente_id' => 0])
            ->leftJoin('usuario', 'cliente.id = usuario.cliente_id')
            ->orderBy(['cliente.nombres' => SORT_DESC])
            ->all();
    }

    /**
     * @param $empresa
     * @return array|ActiveRecord[]
     */
    public static function listaProveedores($empresa)
    {
        return Cliente::find()
            ->select([
                'cliente.nombres',
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
            ->where('cliente.estado = :estado', [':estado' => 1])
            ->andWhere('cliente.empresa_id = :empresa', [':empresa' => $empresa])
            ->andWhere(' cliente.tipo = :tipo', [':tipo' => 'PROVEEDOR'])
            ->orderBy(['cliente.nombres' => SORT_DESC])
            ->all();
    }
}
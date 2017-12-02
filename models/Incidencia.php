<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "incidencia".
 *
 * @property integer $id
 * @property integer $cliente_id
 * @property integer $empresa_id
 * @property string $notas
 * @property string $resumen
 * @property string $servico
 * @property string $ci
 * @property string $fecha_deseada
 * @property string $impacto
 * @property string $urgencia
 * @property string $prioridad
 * @property string $tipo_incidencia
 * @property string $fuente_reportada
 * @property string $fecha_digitada
 * @property string $fecha_modificada
 * @property string $fecha_eliminada
 * @property string $usuario_digitado
 * @property string $usuario_modificado
 * @property string $usuario_eliminado
 * @property integer $estado
 * @property string $ip
 * @property string $host
 *
 * @property Cliente $cliente
 */
class Incidencia extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'incidencia';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [
                [
                    'cliente_id',
                    'empresa_id',
                    'notas',
                    'resumen',
                    'servico',
                    'ci',
                    'fecha_deseada',
                    'impacto',
                    'urgencia',
                    'prioridad',
                    'tipo_incidencia',
                    'fuente_reportada',
                ],
                'required',
            ],
            [['cliente_id', 'empresa_id', 'estado'], 'integer'],
            [['fecha_digitada', 'fecha_modificada', 'fecha_eliminada'], 'safe'],
            [
                [
                    'notas',
                    'resumen',
                    'servico',
                    'ci',
                    'fecha_deseada',
                    'impacto',
                    'urgencia',
                    'prioridad',
                    'tipo_incidencia',
                    'fuente_reportada',
                    'host',
                ],
                'string',
                'max' => 150,
            ],
            [['usuario_digitado', 'usuario_modificado', 'usuario_eliminado'], 'string', 'max' => 50],
            [['ip'], 'string', 'max' => 30],
            [
                ['cliente_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Cliente::className(),
                'targetAttribute' => ['cliente_id' => 'id'],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cliente_id' => 'Cliente ID',
            'empresa_id' => 'Empresa ID',
            'notas' => 'Notas',
            'resumen' => 'Resumen',
            'servico' => 'Servico',
            'ci' => 'Ci',
            'fecha_deseada' => 'Fecha Deseada',
            'impacto' => 'Impacto',
            'urgencia' => 'Urgencia',
            'prioridad' => 'Prioridad',
            'tipo_incidencia' => 'Tipo Incidencia',
            'fuente_reportada' => 'Fuente Reportada',
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCliente()
    {
        return $this->hasOne(Cliente::className(), ['id' => 'cliente_id']);
    }

    /**
     * @return array
     */
    public static function servicio()
    {
        return [
            0 => 'OUTSOURCING DESKTOP',
        ];
    }

    /**
     * @return array
     */
    public static function ci()
    {
        return [
            0 => 'CI_DUMMY',
        ];
    }

    /**
     * @return array
     */
    public static function impacto()
    {
        return [
            'Urgente' => 'Urgente',
            'Alta' => 'Alta',
            'Media' => 'Media',
            'Baja' => 'Baja',
        ];
    }

    /**
     * @return array
     */
    public static function urgencia()
    {
        return [
            'Urgente' => 'Urgente',
            'Alta' => 'Alta',
            'Media' => 'Media',
            'Baja' => 'Baja',
        ];
    }

    /**
     * @return array
     */
    public static function prioridad()
    {
        return [
            'Urgente' => 'Urgente',
            'Alta' => 'Alta',
            'Media' => 'Media',
            'Baja' => 'Baja',
        ];
    }

    /**
     * @return array
     */
    public static function tipoIncidencia()
    {
        return [
            0 => 'Petición de Servicio',
            1 => 'Restauración de Servicio',
        ];
    }

    /**
     * @return array
     */
    public static function fuenteReportada()
    {
        return [
            0 => 'Correo Electronico',
        ];
    }

    public static function CatNivelOpeUno()
    {
        return [
            0 => 'Outsourcing',
        ];
    }

    public static function CatNivelOpeDos()
    {
        return [
            0 => 'Solicitud',
        ];
    }

    public static function CatNivelOpeTres()
    {
        return [
            0 => 'Permisos/Habilitar',
        ];
    }

    public static function CatNivelProUno()
    {
        return [
            0 => 'Software',
        ];
    }

    public static function CatNivelProDos()
    {
        return [
            0 => 'Software de Aplicación',
        ];
    }

    public static function CatNivelProTres()
    {
        return [
            0 => 'Aplicaciones de Informatica',
        ];
    }

    public static function nombreDelProducto()
    {
        return [
            0 => 'Internet Explorer',
        ];
    }
}
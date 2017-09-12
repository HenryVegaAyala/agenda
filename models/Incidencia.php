<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "incidencia".
 *
 * @property integer $id
 * @property integer $usuario_id
 * @property string $empresa
 * @property string $cliente
 * @property string $contacto
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
                    'id',
                    'usuario_id',
                    'empresa',
                    'cliente',
                    'contacto',
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
            [['id', 'usuario_id', 'estado'], 'integer'],
            [['fecha_digitada', 'fecha_modificada', 'fecha_eliminada'], 'safe'],
            [
                [
                    'empresa',
                    'cliente',
                    'contacto',
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
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'usuario_id' => 'Usuario ID',
            'empresa' => 'Empresa',
            'cliente' => 'Cliente',
            'contacto' => 'Contacto',
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
}

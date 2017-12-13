<?php

namespace app\models;

use Carbon\Carbon;
use Yii;
use yii\base\Model;
use yii\caching\DbDependency;
use yii\data\ActiveDataProvider;
use app\models\Incidencia;
use yii\db\Expression;

/**
 * IncidenciaSearch represents the model behind the search form about `app\models\Incidencia`.
 */
class IncidenciaSearch extends Incidencia
{
    const CACHE_TIMEOUT = 3600;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'cliente_id', 'empresa_id', 'estado'], 'integer'],
            [
                [
                    'notas',
                    'numero',
                    'resumen',
                    'producto',
                    'servico',
                    'ci',
                    'fecha_deseada',
                    'impacto',
                    'urgencia',
                    'prioridad',
                    'tipo_incidencia',
                    'tipo',
                    'empresa',
                    'cliente',
                    'fuente_reportada',
                    'fecha_digitada',
                    'fecha_modificada',
                    'fecha_eliminada',
                    'usuario_digitado',
                    'usuario_modificado',
                    'usuario_eliminado',
                    'ip',
                    'host',
                    'status',
                ],
                'safe',
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     * @throws \Exception
     * @throws \yii\base\InvalidParamException
     */
    public function search($params)
    {
        $db = Yii::$app->db;
        $dep = new DbDependency();
        $query = Incidencia::getDb()->cache(function ($db) {
            $sentence = new Expression('concat(cliente.nombres, \' \', cliente.apellidos) AS cliente');

            return Incidencia::find()
                ->select([
                    'incidencia.id                                         AS id',
                    'incidencia.numero                                     AS numero',
                    'empresa.nombre                                        AS empresa',
                    'incidencia.producto                                   AS producto',
                    'incidencia.prioridad                                  AS prioridad',
                    'date_format(incidencia.fecha_deseada, \'%d-%m-%Y\')   AS fecha_deseada',
                    'incidencia.status                                     AS status',
                ])
                ->addSelect([new Expression($sentence)])
                ->leftJoin('cliente', 'cliente.id = incidencia.cliente_id')
                ->leftJoin('empresa', 'empresa.id = incidencia.empresa_id')
                ->where('cliente_id = :cliente', [':cliente' => Yii::$app->user->identity->cliente_id])
                ->andWhere('incidencia.estado = :estado', [':estado' => 1])
                ->orderBy(['numero' => SORT_DESC]);
        }, self::CACHE_TIMEOUT, $dep);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'cliente_id' => $this->cliente_id,
            'empresa_id' => $this->empresa_id,
            'fecha_digitada' => $this->fecha_digitada,
            'empresa' => $this->empresa,
            'fecha_modificada' => $this->fecha_modificada,
            'fecha_eliminada' => $this->fecha_eliminada,
            'estado' => $this->estado,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'notas', $this->notas])
            ->andFilterWhere(['like', 'numero', $this->numero])
            ->andFilterWhere(['like', 'resumen', $this->resumen])
            ->andFilterWhere(['like', 'producto', $this->producto])
            ->andFilterWhere(['like', 'servico', $this->servico])
            ->andFilterWhere(['like', 'ci', $this->ci])
            ->andFilterWhere(['like', 'impacto', $this->impacto])
            ->andFilterWhere(['like', 'urgencia', $this->urgencia])
            ->andFilterWhere(['like', 'prioridad', $this->prioridad])
            ->andFilterWhere(['like', 'tipo_incidencia', $this->tipo_incidencia])
            ->andFilterWhere(['like', 'tipo', $this->tipo])
            ->andFilterWhere(['like', 'fuente_reportada', $this->fuente_reportada])
            ->andFilterWhere(['like', 'usuario_digitado', $this->usuario_digitado])
            ->andFilterWhere(['like', 'usuario_modificado', $this->usuario_modificado])
            ->andFilterWhere(['like', 'usuario_eliminado', $this->usuario_eliminado])
            ->andFilterWhere(['like', 'ip', $this->ip])
            ->andFilterWhere(['like', 'host', $this->host]);

        if (!empty($this->fecha_deseada)) {
            $query->andFilterWhere(['like', 'fecha_deseada', Carbon::parse($this->fecha_deseada)->format('Y-m-d')]);
        }


        return $dataProvider;
    }

    public function search2($params)
    {
        $db = Yii::$app->db;
        $dep = new DbDependency();
        $query = Incidencia::getDb()->cache(function ($db) {
            $sentence = new Expression('concat(cliente.nombres, \' \', cliente.apellidos) AS cliente');

            return Incidencia::find()
                ->select([
                    'incidencia.id                                         AS id',
                    'incidencia.numero                                     AS numero',
                    'incidencia.ci                                         AS ci',
                    'empresa.nombre                                        AS empresa',
                    'incidencia.producto                                   AS producto',
                    'incidencia.prioridad                                  AS prioridad',
                    'date_format(incidencia.fecha_deseada, \'%d-%m-%Y\')   AS fecha_deseada',
                    'incidencia.status                                     AS status',
                ])
                ->addSelect([new Expression($sentence)])
                ->leftJoin('cliente', 'cliente.id = incidencia.cliente_id')
                ->leftJoin('empresa', 'empresa.id = incidencia.empresa_id')
                ->andWhere('incidencia.estado = :estado', [':estado' => 1])
                ->orderBy(['numero' => SORT_DESC]);
        }, self::CACHE_TIMEOUT, $dep);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'cliente_id' => $this->cliente_id,
            'empresa_id' => $this->empresa_id,
            'fecha_digitada' => $this->fecha_digitada,
            'empresa' => $this->empresa,
            'fecha_modificada' => $this->fecha_modificada,
            'fecha_eliminada' => $this->fecha_eliminada,
            'estado' => $this->estado,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'notas', $this->notas])
            ->andFilterWhere(['like', 'numero', $this->numero])
            ->andFilterWhere(['like', 'resumen', $this->resumen])
            ->andFilterWhere(['like', 'producto', $this->producto])
            ->andFilterWhere(['like', 'servico', $this->servico])
            ->andFilterWhere(['like', 'ci', $this->ci])
            ->andFilterWhere(['like', 'impacto', $this->impacto])
            ->andFilterWhere(['like', 'urgencia', $this->urgencia])
            ->andFilterWhere(['like', 'prioridad', $this->prioridad])
            ->andFilterWhere(['like', 'tipo_incidencia', $this->tipo_incidencia])
            ->andFilterWhere(['like', 'tipo', $this->tipo])
            ->andFilterWhere(['like', 'fuente_reportada', $this->fuente_reportada])
            ->andFilterWhere(['like', 'usuario_digitado', $this->usuario_digitado])
            ->andFilterWhere(['like', 'usuario_modificado', $this->usuario_modificado])
            ->andFilterWhere(['like', 'usuario_eliminado', $this->usuario_eliminado])
            ->andFilterWhere(['like', 'ip', $this->ip])
            ->andFilterWhere(['like', 'host', $this->host]);

        if (!empty($this->fecha_deseada)) {
            $query->andFilterWhere(['like', 'fecha_deseada', Carbon::parse($this->fecha_deseada)->format('Y-m-d')]);
        }


        return $dataProvider;
    }

    public function search22($params)
    {
        $db = Yii::$app->db;
        $dep = new DbDependency();
        $query = Incidencia::getDb()->cache(function ($db) {
            $sentence = new Expression('concat(cliente.nombres, \' \', cliente.apellidos) AS cliente');

            return Incidencia::find()
                ->select([
                    'incidencia.id                                         AS id',
                    'incidencia.numero                                     AS numero',
                    'incidencia.ci                                         AS ci',
                    'empresa.nombre                                        AS empresa',
                    'incidencia.producto                                   AS producto',
                    'incidencia.prioridad                                  AS prioridad',
                    'date_format(incidencia.fecha_deseada, \'%d-%m-%Y\')   AS fecha_deseada',
                    'incidencia.status                                     AS status',
                ])
                ->addSelect([new Expression($sentence)])
                ->leftJoin('cliente', 'cliente.id = incidencia.cliente_id')
                ->leftJoin('empresa', 'empresa.id = incidencia.empresa_id')
                ->where('ci = :cliente', [':cliente' => Yii::$app->user->identity->nombres])
                ->andWhere('incidencia.estado = :estado', [':estado' => 1])
                ->orderBy(['numero' => SORT_DESC]);
        }, self::CACHE_TIMEOUT, $dep);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'cliente_id' => $this->cliente_id,
            'empresa_id' => $this->empresa_id,
            'fecha_digitada' => $this->fecha_digitada,
            'empresa' => $this->empresa,
            'fecha_modificada' => $this->fecha_modificada,
            'fecha_eliminada' => $this->fecha_eliminada,
            'estado' => $this->estado,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'notas', $this->notas])
            ->andFilterWhere(['like', 'numero', $this->numero])
            ->andFilterWhere(['like', 'resumen', $this->resumen])
            ->andFilterWhere(['like', 'producto', $this->producto])
            ->andFilterWhere(['like', 'servico', $this->servico])
            ->andFilterWhere(['like', 'ci', $this->ci])
            ->andFilterWhere(['like', 'impacto', $this->impacto])
            ->andFilterWhere(['like', 'urgencia', $this->urgencia])
            ->andFilterWhere(['like', 'prioridad', $this->prioridad])
            ->andFilterWhere(['like', 'tipo_incidencia', $this->tipo_incidencia])
            ->andFilterWhere(['like', 'tipo', $this->tipo])
            ->andFilterWhere(['like', 'fuente_reportada', $this->fuente_reportada])
            ->andFilterWhere(['like', 'usuario_digitado', $this->usuario_digitado])
            ->andFilterWhere(['like', 'usuario_modificado', $this->usuario_modificado])
            ->andFilterWhere(['like', 'usuario_eliminado', $this->usuario_eliminado])
            ->andFilterWhere(['like', 'ip', $this->ip])
            ->andFilterWhere(['like', 'host', $this->host]);

        if (!empty($this->fecha_deseada)) {
            $query->andFilterWhere(['like', 'fecha_deseada', Carbon::parse($this->fecha_deseada)->format('Y-m-d')]);
        }


        return $dataProvider;
    }
}

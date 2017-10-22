<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\caching\DbDependency;
use yii\data\ActiveDataProvider;

/**
 * ClienteSearch represents the model behind the search form about `app\models\Cliente`.
 */
class ClienteSearch extends Cliente
{
    const CACHE_TIMEOUT = 3600;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'estado'], 'integer'],
            [
                [
                    'nombres',
                    'apellidos',
                    'dni',
                    'area',
                    'email_corp',
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
        return Model::scenarios();
    }

    /**
     * @param $params
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $db = Yii::$app->db;
        $dep = new DbDependency();
        $query = Cliente::getDb()->cache(function ($db) {

            return Cliente::find()
                ->select([
                    'id                       AS id',
                    'nombres                  AS nombres',
                    'apellidos                AS apellidos',
                    'area                     AS area',
                    'email_corp               AS email_corp',
                ])
                ->where(['empresa_id' => Yii::$app->user->identity->empresa_id])
                ->orderBy(['apellidos' => SORT_ASC]);
        }, self::CACHE_TIMEOUT, $dep);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'nombres', $this->nombres])
            ->andFilterWhere(['like', 'apellidos', $this->apellidos])
            ->andFilterWhere(['like', 'dni', $this->dni])
            ->andFilterWhere(['like', 'area', $this->area])
            ->andFilterWhere(['like', 'email_corp', $this->email_corp]);

        return $dataProvider;
    }

    /**
     * @param $params
     * @return ActiveDataProvider
     */
    public function searchAnalistas($params)
    {
        $db = Yii::$app->db;
        $dep = new DbDependency();
        $query = Cliente::getDb()->cache(function ($db) {

            return Cliente::find()
                ->select([
                    'cliente.id                       AS id',
                    'cliente.nombres                  AS nombres',
                    'apellidos                AS apellidos',
                    'area                     AS area',
                    'email_corp               AS email_corp',
                ])
                ->where('cliente.empresa_id = :empresa', [':empresa' => Yii::$app->user->identity->empresa_id])
                ->andWhere('cliente.estado = :estado', [':estado' => 1])
                ->andWhere(' usuario.type = :type', [':type' => 2])
                ->andWhere(' usuario.cliente_id <> :cliente_id', [':cliente_id' => 0])
                ->leftJoin('usuario', 'cliente.id = usuario.cliente_id')
                ->orderBy(['usuario.nombres' => SORT_DESC]);
        }, self::CACHE_TIMEOUT, $dep);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'nombres', $this->nombres])
            ->andFilterWhere(['like', 'apellidos', $this->apellidos])
            ->andFilterWhere(['like', 'dni', $this->dni])
            ->andFilterWhere(['like', 'area', $this->area])
            ->andFilterWhere(['like', 'email_corp', $this->email_corp]);

        return $dataProvider;
    }
}

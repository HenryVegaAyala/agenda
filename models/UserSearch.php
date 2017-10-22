<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\caching\DbDependency;
use yii\data\ActiveDataProvider;

/**
 * Class UserSearch
 * @package app\models
 */
class UserSearch extends User
{
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
                    'correo',
                    'type',
                ],
                'safe',
            ],
        ];
    }

    /**
     * @return array
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
        $dependency = new DbDependency();
        $query = User::getDb()->cache(function ($db) {
            return User::find()->select([
                'usuario.id',
                'usuario.nombres',
                'correo',
                'type',
                'usuario.estado',
            ])
                ->where('usuario.empresa_id = :empresa', [':empresa' => Yii::$app->user->identity->empresa_id])
                ->andWhere('cliente.estado = :estado', [':estado' => 1])
                ->andWhere(' usuario.type = :type', [':type' => 2])
                ->andWhere(' usuario.cliente_id <> :cliente_id', [':cliente_id' => 0])
                ->leftJoin('cliente', 'cliente.id = usuario.cliente_id')
                ->orderBy(['usuario.nombres' => SORT_DESC]);
        }, 3600, $dependency);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'estado' => $this->estado,
        ]);

        $query->andFilterWhere(['like', 'nombres', $this->nombres])
            ->andFilterWhere(['like', 'correo', $this->correo])
            ->andFilterWhere(['like', 'type', $this->type]);

        return $dataProvider;
    }
}

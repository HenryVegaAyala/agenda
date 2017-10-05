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
                'id',
                'nombres',
                'correo',
                'estado',
            ])
                ->orderBy(['nombres' => SORT_ASC]);
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
            ->andFilterWhere(['like', 'correo', $this->correo]);

        return $dataProvider;
    }
}

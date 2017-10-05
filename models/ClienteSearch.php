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
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
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
}

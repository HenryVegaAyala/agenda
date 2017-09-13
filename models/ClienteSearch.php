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
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dni', 'estado'], 'integer'],
            [
                [
                    'nombres',
                    'apellidos',
                    'area',
                    'cargo',
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
     */
    public function search($params)
    {
        $db = Yii::$app->db;
        $dependency = new DbDependency();
        $query = Cliente::getDb()->cache(function ($db) {
            return Cliente::find()->select([
                'id',
                'nombres',
                'apellidos',
                'email',
                'dni',
                'numero_celular',
                'area',
                'cargo',
                'estado',
            ])
                ->orderBy(['id' => SORT_ASC]);
        }, 3600, $dependency);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'dni' => $this->dni,
            'estado' => $this->estado,
        ]);

        $query->andFilterWhere(['like', 'nombres', $this->nombres])
            ->andFilterWhere(['like', 'apellidos', $this->apellidos])
            ->andFilterWhere(['like', 'area', $this->area])
            ->andFilterWhere(['like', 'cargo', $this->cargo]);

        return $dataProvider;
    }
}

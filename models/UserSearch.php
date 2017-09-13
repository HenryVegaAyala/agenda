<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\caching\DbDependency;
use yii\data\ActiveDataProvider;

/**
 * UserSearch represents the model behind the search form about `app\models\User`.
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
                    'nombre',
                    'apellido',
                    'correo',
                    'privilegio',
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
        $query = User::getDb()->cache(function ($db) {
            return User::find()->select([
                'id',
                'nombre',
                'apellido',
                'telefono',
                'dni',
                'correo',
                'privilegio',
                'estado',
                'genero',
                'date_format(fecha_inicio, \'%d-%m-%Y\') AS fecha_inicio',
                'date_format(fecha_cumpleanos, \'%d-%m-%Y\') AS fecha_cumpleanos',
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
            'id' => $this->id,
            'estado' => $this->estado,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'apellido', $this->apellido])
            ->andFilterWhere(['like', 'correo', $this->correo])
            ->andFilterWhere(['like', 'privilegio', $this->privilegio]);

        return $dataProvider;
    }
}

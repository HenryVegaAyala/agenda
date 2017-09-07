<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Cliente;

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
            [['id', 'dni', 'estado'], 'integer'],
            [['nombres', 'apellidos', 'email', 'numero_celular', 'area', 'cargo', 'fecha_digitada', 'fecha_modificada', 'fecha_eliminada', 'usuario_digitado', 'usuario_modificado', 'usuario_eliminado', 'ip', 'host'], 'safe'],
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
        $query = Cliente::find();

        // add conditions that should always apply here

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
            'dni' => $this->dni,
            'fecha_digitada' => $this->fecha_digitada,
            'fecha_modificada' => $this->fecha_modificada,
            'fecha_eliminada' => $this->fecha_eliminada,
            'estado' => $this->estado,
        ]);

        $query->andFilterWhere(['like', 'nombres', $this->nombres])
            ->andFilterWhere(['like', 'apellidos', $this->apellidos])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'numero_celular', $this->numero_celular])
            ->andFilterWhere(['like', 'area', $this->area])
            ->andFilterWhere(['like', 'cargo', $this->cargo])
            ->andFilterWhere(['like', 'usuario_digitado', $this->usuario_digitado])
            ->andFilterWhere(['like', 'usuario_modificado', $this->usuario_modificado])
            ->andFilterWhere(['like', 'usuario_eliminado', $this->usuario_eliminado])
            ->andFilterWhere(['like', 'ip', $this->ip])
            ->andFilterWhere(['like', 'host', $this->host]);

        return $dataProvider;
    }
}

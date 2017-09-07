<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Incidencia;

/**
 * IncidenciaSearch represents the model behind the search form about `app\models\Incidencia`.
 */
class IncidenciaSearch extends Incidencia
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'estado'], 'integer'],
            [['empresa', 'cliente', 'contacto', 'notas', 'resumen', 'servico', 'ci', 'fecha_deseada', 'impacto', 'urgencia', 'prioridad', 'tipo_incidencia', 'fuente_reportada', 'fecha_digitada', 'fecha_modificada', 'fecha_eliminada', 'usuario_digitado', 'usuario_modificado', 'usuario_eliminado', 'ip', 'host'], 'safe'],
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
        $query = Incidencia::find();

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
            'fecha_digitada' => $this->fecha_digitada,
            'fecha_modificada' => $this->fecha_modificada,
            'fecha_eliminada' => $this->fecha_eliminada,
            'estado' => $this->estado,
        ]);

        $query->andFilterWhere(['like', 'empresa', $this->empresa])
            ->andFilterWhere(['like', 'cliente', $this->cliente])
            ->andFilterWhere(['like', 'contacto', $this->contacto])
            ->andFilterWhere(['like', 'notas', $this->notas])
            ->andFilterWhere(['like', 'resumen', $this->resumen])
            ->andFilterWhere(['like', 'servico', $this->servico])
            ->andFilterWhere(['like', 'ci', $this->ci])
            ->andFilterWhere(['like', 'fecha_deseada', $this->fecha_deseada])
            ->andFilterWhere(['like', 'impacto', $this->impacto])
            ->andFilterWhere(['like', 'urgencia', $this->urgencia])
            ->andFilterWhere(['like', 'prioridad', $this->prioridad])
            ->andFilterWhere(['like', 'tipo_incidencia', $this->tipo_incidencia])
            ->andFilterWhere(['like', 'fuente_reportada', $this->fuente_reportada])
            ->andFilterWhere(['like', 'usuario_digitado', $this->usuario_digitado])
            ->andFilterWhere(['like', 'usuario_modificado', $this->usuario_modificado])
            ->andFilterWhere(['like', 'usuario_eliminado', $this->usuario_eliminado])
            ->andFilterWhere(['like', 'ip', $this->ip])
            ->andFilterWhere(['like', 'host', $this->host]);

        return $dataProvider;
    }
}

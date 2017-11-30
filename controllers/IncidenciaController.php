<?php

namespace app\controllers;

use app\helpers\Utils;
use Carbon\Carbon;
use Yii;
use app\models\Incidencia;
use app\models\IncidenciaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * Class IncidenciaController
 * @package app\controllers
 */
class IncidenciaController extends Controller
{
    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new IncidenciaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param $id
     * @return string
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Incidencia();

        if ($model->load(Yii::$app->request->post())) {
            $model->cliente_id = Yii::$app->user->identity->cliente_id;
            $model->empresa_id = Yii::$app->user->identity->empresa_id;
            $model->fecha_deseada = Carbon::parse($model->fecha_deseada)->format('Y-m-d');
            $model->estado = true;
            $model->fecha_digitada = Carbon::now('America/Lima');
            $model->usuario_digitado = Yii::$app->user->identity->id;
            $model->host = strval(php_uname());
            $model->ip = Utils::getRealIpAddr();
            $model->save();

            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * @param $id
     * @return string|\yii\web\Response
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * @param $id
     * @return \yii\web\Response
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * @param $id
     * @return Incidencia
     * @throws NotFoundHttpException
     */
    protected function findModel($id)
    {
        if (($model = Incidencia::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

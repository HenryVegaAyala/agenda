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
use yii\web\Response;

/**
 * Class IncidenciaController
 * @package app\controllers
 */
class IncidenciaController extends Controller
{
    /**
     * @return array
     */
    public function behaviors(): array
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
     * @throws \yii\base\InvalidParamException
     */
    public function actionIndex(): string
    {
        $searchModel = new IncidenciaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @return string|\yii\web\Response
     * @throws \yii\base\InvalidParamException
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
            $model->usuario_digitado = Yii::$app->user->identity->nombres;
            $model->host = (string)PHP_OS;
            $model->ip = Utils::getRealIpAddr();
            $model->save();

            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * @param $id
     * @return string|\yii\web\Response
     * @throws \yii\base\InvalidParamException
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->fecha_modificada = Carbon::now('America/Lima');
            $model->usuario_modificado = Yii::$app->user->identity->nombres;
            $model->host = (string)php_uname();
            $model->ip = Utils::getRealIpAddr();
            $model->save();

            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * @param $id
     * @return Response
     * @throws \yii\db\StaleObjectException
     * @throws \Exception
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionDelete($id): Response
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * @param $id
     * @return Incidencia
     * @throws NotFoundHttpException
     */
    protected function findModel($id): Incidencia
    {
        if (($model = Incidencia::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

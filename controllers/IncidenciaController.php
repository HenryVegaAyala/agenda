<?php

namespace app\controllers;

use app\helpers\Utils;
use app\models\Cliente;
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
     * @throws \Exception
     * @throws \yii\base\InvalidParamException
     */
    public function actionIndex(): string
    {
        $searchModel = new IncidenciaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->post());

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @return string|\yii\web\Response
     * @throws \yii\db\Exception
     * @throws \yii\base\InvalidParamException
     */
    public function actionCreate()
    {
        $model = new Incidencia();
        $cliente = Cliente::find()->where(['id' => Yii::$app->user->identity->cliente_id])->one();
        $ticket = 'INC-' . str_pad(Utils::numeroTicket(), 10, '0', STR_PAD_LEFT);

        if ($model->load(Yii::$app->request->post())) {
            $model->cliente_id = Yii::$app->user->identity->cliente_id;
            $model->empresa_id = Yii::$app->user->identity->empresa_id;
            $model->fecha_digitada = Carbon::now('America/Lima');
            $model->usuario_digitado = Yii::$app->user->identity->nombres;
            $model->host = (string)php_uname();
            $model->fecha_deseada = Carbon::parse($model->fecha_deseada)->format('Y-m-d');
            $model->ip = Utils::getRealIpAddr();
            $model->numero = $ticket;
            $model->tipo = 'CLIENTE';
            $model->estado = true;
            $model->status = 'CREADO';
            $model->save();

            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
            'cliente' => $cliente,
            'ticket' => $ticket,
        ]);
    }

    /**
     * @param $id
     * @return string|Response
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if (Yii::$app->user->identity->type === 2) {
            $cliente = Cliente::find()->where(['id' => $model->cliente_id])->one();
            if ($model->load(Yii::$app->request->post())) {
                $model->fecha_modificada = Carbon::now('America/Lima');
                $model->usuario_modificado = Yii::$app->user->identity->nombres;
                $model->host = (string)php_uname();
                $model->ip = Utils::getRealIpAddr();
                $model->status = 'PENDIENTE';
                $model->save();

                return $this->redirect(['lista']);
            } else {
                return $this->render('incidencia', [
                    'model' => $model,
                    'cliente' => $cliente,
                ]);
            }
        } else {

            $cliente = Cliente::find()->where(['id' => Yii::$app->user->identity->cliente_id])->one();
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
                'cliente' => $cliente,
            ]);
        }
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

    /**
     * @return string
     * @throws \Exception
     * @throws \yii\base\InvalidParamException
     */
    public function actionLista(): string
    {
        $searchModel = new IncidenciaSearch();
        $dataProvider = $searchModel->search2(Yii::$app->request->post());

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @return string
     * @throws \Exception
     * @throws \yii\base\InvalidParamException
     */
    public function actionTecnico(): string
    {
        $searchModel = new IncidenciaSearch();
        $dataProvider = $searchModel->search2(Yii::$app->request->post());

        return $this->render('lista', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionAsignar($id)
    {
        $model = $this->findModel($id);
        if (Yii::$app->user->identity->type === 2) {
            $cliente = Cliente::find()->where(['id' => $model->cliente_id])->one();
            if ($model->load(Yii::$app->request->post())) {
                $model->fecha_modificada = Carbon::now('America/Lima');
                $model->usuario_modificado = Yii::$app->user->identity->nombres;
                $model->host = (string)php_uname();
                $model->ip = Utils::getRealIpAddr();
                $model->status = 'EN PROCESO';
                $model->save();

                return $this->redirect(['tecnico']);
            } else {
                return $this->render('asignar', [
                    'model' => $model,
                    'cliente' => $cliente,
                ]);
            }
        } else {

            $cliente = Cliente::find()->where(['id' => Yii::$app->user->identity->cliente_id])->one();
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
                'cliente' => $cliente,
            ]);
        }
    }

    /**
     * @return string
     * @throws \Exception
     * @throws \yii\base\InvalidParamException
     */
    public function actionEnd(): string
    {
        $searchModel = new IncidenciaSearch();
        $dataProvider = $searchModel->search22(Yii::$app->request->post());

        return $this->render('terminar', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionTerminar($id)
    {
        $model = $this->findModel($id);
        $cliente = Cliente::find()->where(['id' => $model->cliente_id])->one();
        if ($model->load(Yii::$app->request->post())) {
            $model->fecha_modificada = Carbon::now('America/Lima');
            $model->usuario_modificado = Yii::$app->user->identity->nombres;
            $model->fecha_final = Carbon::parse($model->fecha_final)->format('Y-m-d');
            $model->host = (string)php_uname();
            $model->ip = Utils::getRealIpAddr();
            $model->ci = Yii::$app->user->identity->nombres;
            $model->save();

            return $this->redirect(['end']);
        } else {
            return $this->render('cerrar', [
                'model' => $model,
                'cliente' => $cliente,
            ]);
        }
    }
}

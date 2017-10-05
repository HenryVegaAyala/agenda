<?php

namespace app\controllers;

use app\helpers\Utils;
use tebazil\runner\ConsoleCommandRunner;
use Yii;
use app\models\Cliente;
use app\models\ClienteSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * Class ClienteController
 * @package app\controllers
 */
class ClienteController extends Controller
{
    /**
     * @inheritdoc
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
        $searchModel = new ClienteSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->post());

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
        $model = new Cliente();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
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
     * @return string
     */
    public function actionImport()
    {
        $model = new Cliente();
        if ($model->load(Yii::$app->request->post())) {
            $model->excel_import = UploadedFile::getInstance($model, 'excel_import');
            var_dump($model->excel_import);
            exit();

            //$model->save();

            return $this->render('details');
        } else {
            return $this->render('import', [
                'model' => $model,
            ]);
        }
    }

    /**
     * @return \yii\web\Response
     */
    public function actionExport()
    {
        $runner = new ConsoleCommandRunner();
        $runner->run('command/export');
        $runner->getExitCode();

        $path = Yii::getAlias('@PathReporteDownload');
        $file = 'Colaboradores.xlsx';
        Utils::downloadFile($path, $file);

        return $this->redirect(['cliente/import']);
    }

    /**
     * @param $id
     * @return static
     * @throws NotFoundHttpException
     */
    protected function findModel($id)
    {
        if (($model = Cliente::find()->select([
                'id',
                'nombres',
                'apellidos',
                'dni',
                'date_format(fecha_nacimiento, \'%d-%m-%Y\')   AS fecha_nacimiento',
                'genero',
                'email_personal',
                'ubicacion',
                'estado_civil',
                'numero_celular',
                'area',
                'puesto',
                'categoria',
                'email_corp',
                'numero_emergencia',
                'date_format(fecha_ingreso, \'%d-%m-%Y\')   AS fecha_ingreso',
                'numero_oficina',
                'anexo',
            ])
                ->where('id = :id', [':id' => $id])
                ->andwhere('estado = :estado', [':estado' => 1])
                ->one()
            ) !== null
        ) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

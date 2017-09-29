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
 * ClienteController implements the CRUD actions for Cliente model.
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
     * Lists all Cliente models.
     * @return mixed
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
     * Displays a single Cliente model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Cliente model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
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
     * Updates an existing Cliente model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
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
     * Deletes an existing Cliente model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Import Cliente model.
     * If is successful, the browser will be redirected to the 'details' page.
     */
    public function actionImport()
    {
        $model = new Cliente();
        if ($model->load(Yii::$app->request->post())) {

            //$model->excel_import = UploadedFile::getInstance($model, 'excel_import');
            //var_dump($model->excel_import);
            //exit();

            //$model->save();

            return $this->render('details');
        } else {
            return $this->render('import', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Import Cliente model.
     * If is successful, the browser will be redirected to the 'details' page.
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
     * Finds the Cliente model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Cliente the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Cliente::find()->select([
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
                ->where('id = :id', [':id' => $id])
                ->one()
            ) !== null
        ) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

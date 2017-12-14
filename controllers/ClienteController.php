<?php

namespace app\controllers;

use app\helpers\Notificaciones;
use app\helpers\Utils;
use PHPExcel_IOFactory;
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
 * @property false|string fecha_nacimiento
 * @property false|string fecha_ingreso
 * @property int          estado
 * @property mixed        nombres
 * @property mixed        apellidos
 * @property mixed        email_corp
 * @property mixed        dni
 * @package app\controllers
 */
class ClienteController extends Controller
{
    const TABLE_CLIENTE = 'cliente';
    const TABLE_USUARIO = 'usuario';

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
     * @throws \Exception
     */
    public function actionIndex(): string
    {
        $type = Yii::$app->user->identity->type;
        $searchModel = new ClienteSearch();
        $dataProvider = ($type === 0) ? $searchModel->searchAnalistas(Yii::$app->request->post()) :
            $searchModel->search(Yii::$app->request->post());

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param $id
     * @return string
     * @throws \yii\base\InvalidParamException
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

        if ($model->load(Yii::$app->request->post())) {
            $type = Yii::$app->user->identity->type;

            $model->id = Utils::idTable(self::TABLE_CLIENTE);
            $model->empresa_id = Yii::$app->user->identity->empresa_id;
            $model->fecha_nacimiento = Utils::formatDate($model->fecha_nacimiento);
            $model->fecha_ingreso = Utils::formatDate($model->fecha_ingreso);
            $model->estado = 1;
            $model->save();

            $data = [
                'cliente_id' => $model->id,
                'empresa_id' => Yii::$app->user->identity->empresa_id,
                'nombres' => $model->nombres . ' ' . $model->apellidos,
                'correo' => $model->email_corp,
                'contrasena' => Yii::$app->getSecurity()->generatePasswordHash($model->dni),
                'authKey' => 1,
                'accessToken' => 1,
                'estado' => 1,
                'type' => ($type === 0) ? 2 : 1,

            ];

            Yii::$app->db->createCommand()->insert('usuario', $data)->execute();

            return ($type === 0) ? $this->redirect(['user/index']) : $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * @param $id
     * @return string|\yii\web\Response
     * @throws \yii\db\Exception
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {
            $model->fecha_nacimiento = (empty($model->fecha_nacimiento) ? '' : Utils::formatDate($model->fecha_nacimiento));
            $model->fecha_ingreso = (empty($model->fecha_ingreso) ? '' : Utils::formatDate($model->fecha_ingreso));
            $model->save();

            Yii::$app->db->createCommand()
                ->update(self::TABLE_USUARIO,
                    [
                        'fecha_modificada' => Utils::zonaHoraria(),
                        'usuario_modificado' => Yii::$app->user->identity->correo,
                        'ip' => Yii::$app->request->userIP,
                        'host' => strval(php_uname()),
                        'estado' => 1,
                        'nombres' => $model->nombres . ' ' . $model->apellidos,
                        'correo' => $model->email_corp,
                        'contrasena' => (string)Yii::$app->getSecurity()->generatePasswordHash($model->dni),
                    ],
                    'cliente_id = :cliente_id', [':cliente_id' => $id])
                ->execute();

            return $this->redirect(['index']);
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
        Yii::$app->db->createCommand()->delete('usuario', ['cliente_id' => $id])->execute();

        return $this->redirect(['index']);
    }

    /**
     * @return string
     */
    public function actionImport()
    {
        Utils::fileReporte();
        $model = new Cliente();
        if ($model->load(Yii::$app->request->post())) {
            $data = [];
            $file = UploadedFile::getInstance($model, 'excel_import');
            $filename = 'Data.' . $file->extension;
            $file->saveAs('temp/' . $filename);

            $fileXlsx = Yii::getAlias('@webroot') . '/temp/' . $filename;
            $typeFile = PHPExcel_IOFactory::identify($fileXlsx);
            $readFile = PHPExcel_IOFactory::createReader($typeFile);
            $readFile->setReadDataOnly(true);
            $objPHPExcel = $readFile->load($fileXlsx);

            $fileExcel = $objPHPExcel->getSheet(0);
            $highestRow = $fileExcel->getHighestRow();
            //$highestCol = $fileExcel->getHighestColumn();
            //$indexCol = PHPExcel_Cell::columnIndexFromString($highestCol);
            for ($row = 2; $row <= $highestRow; $row++) {
                //for ($col = 0; $col <= $indexCol; $col++) {
                //$batchFile = $fileExcel->getCellByColumnAndRow($col, $row)->getValue();
                array_push($data, [
                    Yii::$app->user->identity->empresa_id,
                    $fileExcel->getCellByColumnAndRow(0, $row)->getValue(),
                    $fileExcel->getCellByColumnAndRow(1, $row)->getValue(),
                    $fileExcel->getCellByColumnAndRow(2, $row)->getValue(),
                    (int)$fileExcel->getCellByColumnAndRow(3, $row)->getValue(),
                    $fileExcel->getCellByColumnAndRow(4, $row)->getValue(),
                    $fileExcel->getCellByColumnAndRow(5, $row)->getValue(),
                    $fileExcel->getCellByColumnAndRow(6, $row)->getValue(),
                    Utils::generoSet($fileExcel->getCellByColumnAndRow(7, $row)->getValue()),
                    Utils::formatDate($fileExcel->getCellByColumnAndRow(8, $row)->getValue()),
                    Utils::formatDate($fileExcel->getCellByColumnAndRow(9, $row)->getValue()),
                    Utils::estadoCivilSet($fileExcel->getCellByColumnAndRow(10, $row)->getValue()),
                    1,
                ]);
                //}
            }

            Yii::$app->db->createCommand()->batchInsert(
                'cliente',
                [
                    'empresa_id',
                    'nombres',
                    'apellidos',
                    'email_corp',
                    'dni',
                    'area',
                    'categoria',
                    'puesto',
                    'genero',
                    'fecha_nacimiento',
                    'fecha_ingreso',
                    'estado_civil',
                    'estado',
                ],
                $data
            )->execute();

            $runner = new ConsoleCommandRunner();
            $runner->run('generate/usuario', [Yii::$app->user->identity->empresa_id]);
            $runner->getExitCode();

            Notificaciones::notificationImportSuccess();

            return $this->render('import');
        } else {
            return $this->render('import');
        }
    }

    /**
     * @return \yii\web\Response
     */
    public function actionExport()
    {
        Utils::fileReporte();
        $runner = new ConsoleCommandRunner();
        $runner->run('command/export', [Yii::$app->user->identity->empresa_id]);
        $runner->getExitCode();

        //$path = Yii::getAlias('@PathReporteDownload');
        //$file = 'Colaboradores.xlsx';
        //Utils::downloadFile($path, $file);
        //
        //return $this->redirect(['cliente/import']);
        $path = '/reporte/';
        $file = 'Colaboradores.xlsx';

        return  $this->redirect($path. $file);
    }

    /**
     * @param $id
     * @return Cliente|array|\yii\db\ActiveRecord
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

    /**
     * @return string|\yii\web\Response
     * @throws \yii\base\InvalidParamException
     */
    public function actionPersonal()
    {
        $model = new Cliente();
        if ($model->load(Yii::$app->request->post())) {
            $model->id = Utils::idTable(self::TABLE_CLIENTE);
            $model->empresa_id = Yii::$app->user->identity->empresa_id;
            $model->fecha_nacimiento = Utils::formatDate($model->fecha_nacimiento);
            $model->fecha_ingreso = Utils::formatDate($model->fecha_ingreso);
            $model->estado = 1;
            $model->tipo = 'PROVEEDOR';
            $model->save();

            return $this->redirect(['lista']);
        }

        return $this->render('personal', [
            'model' => $model,
        ]);
    }

    /**
     * @param $id
     * @return string|\yii\web\Response
     * @throws \yii\web\NotFoundHttpException
     * @throws \yii\base\InvalidParamException
     */
    public function actionPersonalu($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {
            $model->fecha_nacimiento = (empty($model->fecha_nacimiento) ? '' : Utils::formatDate($model->fecha_nacimiento));
            $model->fecha_ingreso = (empty($model->fecha_ingreso) ? '' : Utils::formatDate($model->fecha_ingreso));
            $model->save();

            return $this->redirect(['lista']);
        }

        return $this->render('personalu', [
            'model' => $model,
        ]);
    }

    /**
     * @return string
     * @throws \Exception
     * @throws \yii\base\InvalidParamException
     */
    public function actionLista(): string
    {

        $searchModel = new ClienteSearch();
        $dataProvider = $searchModel->searchProveedor(Yii::$app->request->post());

        return $this->render('lista', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param $id
     * @return string
     * @throws \yii\web\NotFoundHttpException
     * @throws \yii\base\InvalidParamException
     */
    public function actionPersonalview($id): string
    {
        return $this->render('personalv', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * @return string
     * @throws \yii\base\InvalidParamException
     */
    public function actionProveedor()
    {
        return $this->render('proveedor');
    }

    public function actionExecute()
    {
        Utils::fileReporte();
        $runner = new ConsoleCommandRunner();
        $runner->run('command/proveedor', [Yii::$app->user->identity->empresa_id]);
        $runner->getExitCode();

        //$path = Yii::getAlias('@PathReporteDownload');
        //
        //Utils::downloadFile($path, $file);
        $path = '/reporte/';
        $file = 'Proveedor.xlsx';

        return  $this->redirect($path. $file);
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionTecnico()
    {
        $model = new Cliente();
        if ($model->load(Yii::$app->request->post())) {
            $model->id = Utils::idTable(self::TABLE_CLIENTE);
            $model->empresa_id = Yii::$app->user->identity->empresa_id;
            $model->fecha_nacimiento = Utils::formatDate($model->fecha_nacimiento);
            $model->fecha_ingreso = Utils::formatDate($model->fecha_ingreso);
            $model->estado = 1;
            $model->tipo = 'TECNICO';
            $model->save();

            $data = [
                'cliente_id' => $model->id,
                'empresa_id' => Yii::$app->user->identity->empresa_id,
                'nombres' => $model->nombres . ' ' . $model->apellidos,
                'correo' => $model->email_corp,
                'contrasena' => Yii::$app->getSecurity()->generatePasswordHash($model->dni),
                'authKey' => 1,
                'accessToken' => 1,
                'estado' => 1,
                'type' => 3,

            ];

            Yii::$app->db->createCommand()->insert('usuario', $data)->execute();

            return $this->redirect(['listatecnico']);
        }

        return $this->render('tecnico', [
            'model' => $model,
        ]);
    }

    /**
     * @param $id
     * @return string|\yii\web\Response
     * @throws \yii\db\Exception
     */
    public function actionTecnicoupdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {
            $model->fecha_nacimiento = (empty($model->fecha_nacimiento) ? '' : Utils::formatDate($model->fecha_nacimiento));
            $model->fecha_ingreso = (empty($model->fecha_ingreso) ? '' : Utils::formatDate($model->fecha_ingreso));
            $model->save();

            Yii::$app->db->createCommand()
                ->update(self::TABLE_USUARIO,
                    [
                        'fecha_modificada' => Utils::zonaHoraria(),
                        'usuario_modificado' => Yii::$app->user->identity->correo,
                        'ip' => Yii::$app->request->userIP,
                        'host' => strval(php_uname()),
                        'estado' => 1,
                        'nombres' => $model->nombres . ' ' . $model->apellidos,
                        'correo' => $model->email_corp,
                        'contrasena' => (string)Yii::$app->getSecurity()->generatePasswordHash($model->dni),
                    ],
                    'cliente_id = :cliente_id', [':cliente_id' => $id])
                ->execute();

            return $this->redirect(['listatecnico']);
        }

        return $this->render('tecnicou', [
            'model' => $model,
        ]);
    }

    /**
     * @return string
     * @throws \Exception
     * @throws \yii\base\InvalidParamException
     */
    public function actionListatecnico(): string
    {

        $searchModel = new ClienteSearch();
        $dataProvider = $searchModel->searchTenico(Yii::$app->request->post());

        return $this->render('listatecnico', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param $id
     * @return string
     * @throws \yii\base\InvalidParamException
     */
    public function actionTecnicoview($id)
    {
        return $this->render('tecnicoview', [
            'model' => $this->findModel($id),
        ]);
    }
}

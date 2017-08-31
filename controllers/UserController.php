<?php

namespace app\controllers;

use app\helpers\Utils;
use Yii;
use app\models\User;
use app\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    const DATE_FORMAT = 'Y-MM-dd';
    const INDEX = 'index';
    const SUCCESS = 'success';

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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->post());

        return $this->render(self::INDEX, [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post())) {
            $model->id = (int)$model->getIdTable();
            $model->authKey = md5(rand(1, 9999));
            $model->accessToken = md5(rand(1, 9999));
            $model->fecha_digitada = Utils::zonaHoraria();
            $model->usuario_digitado = Yii::$app->user->identity->correo;
            $model->ip = Yii::$app->request->userIP;
            $model->host = strval(php_uname());
            $model->estado = (int)$model->estado;
            $model->genero = (string)$model->genero;
            $model->fecha_inicio = ($model->fecha_inicio == '') ? '' : Yii::$app->formatter->asDate(strtotime($model->fecha_inicio),
                self::DATE_FORMAT);
            $model->fecha_cumpleanos = ($model->fecha_cumpleanos == '') ? '' : Yii::$app->formatter->asDate(strtotime($model->fecha_cumpleanos),
                self::DATE_FORMAT);
            $model->save();
            $this->encryptPassword($model->id, $model->contrasena);
            $names = $model->nombre . ' ' . $model->apellido;
            $rol = $model->getRol($model->privilegio);
            $this->notification(1, $names, $rol);

            return $this->redirect([self::INDEX]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $connection = Yii::$app->db;
        if ($model->load(Yii::$app->request->post())) {

            $connection->createCommand()
                ->update('usuario',
                    [
                        'fecha_modificada' => Utils::zonaHoraria(),
                        'usuario_modificado' => Yii::$app->user->identity->correo,
                        'ip' => Yii::$app->request->userIP,
                        'host' => strval(php_uname()),
                        'privilegio' => $model->privilegio,
                        'estado' => (int)$model->estado,
                        'genero' => $model->genero,
                        'fecha_inicio' => ($model->fecha_inicio == '') ? '' : Yii::$app->formatter->asDate(strtotime($model->fecha_inicio),
                            self::DATE_FORMAT),
                        'fecha_cumpleanos' => ($model->fecha_cumpleanos == '') ? '' : Yii::$app->formatter->asDate(strtotime($model->fecha_cumpleanos),
                            self::DATE_FORMAT),
                    ],
                    'id = :id', [':id' => $id])
                ->execute();
            $names = $model->nombre . ' ' . $model->apellido;
            $rol = $model->getRol($model->privilegio);
            $this->notification(2, $names, $rol);

            return $this->redirect([self::INDEX]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * @param $id
     * @return string|\yii\web\Response
     */
    public function actionChange($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $password = $model->contrasena;
            $model->fecha_modificada = Utils::zonaHoraria();
            $model->usuario_modificado = Yii::$app->user->identity->correo;
            $model->ip = Yii::$app->request->userIP;
            $model->host = strval(php_uname());
            $model->update();

            $this->encryptPassword($model->id, $password);
            $this->notification(4, $model->nombre . ' ' . $model->apellido, $model->getRol($model->privilegio));

            return $this->redirect([self::INDEX]);
        } else {
            return $this->render('change', [
                'model' => $model,
            ]);
        }
    }


    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the self::INDEX page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $user = User::find()->where(['id' => $id])->one();
        $names = $user->nombre . ' ' . $user->apellido;
        $this->notification(3, $names, '');
        $this->findModel($id)->delete();

        return $this->redirect([self::INDEX]);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::find()->select([
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
                ->where('id = :id', [':id' => $id])
                ->one()
            ) !== null
        ) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * @param $estado
     * @param $usuario
     * @param $rol
     */
    public function notification($estado, $usuario, $rol)
    {
        switch ($estado) {
            case 1:
                $title = 'Se registró un Usuario Nuevo';
                $message = 'Se ha registrado satisfactoriamente a ' . $usuario . ' como usuario ' . $rol . '.';
                $type = self::SUCCESS;
                break;
            case 2:
                $title = 'El Usuario fué Actualizado';
                $message = 'Se ha actualizado satisfactoriamente el usuario ' . $usuario . '.';
                $type = self::SUCCESS;
                break;
            case 3:
                $title = 'Se Eliminado un Usuario';
                $message = 'Se ha eliminado satisfactoriamente al usuario ' . $usuario . '.';
                $type = self::SUCCESS;
                break;
            case 4:
                $title = 'Se Actualizado el Perfil de ' . $usuario;
                $message = 'Se ha actualizado satisfactoriamente los datos del perfil.';
                $type = self::SUCCESS;
                break;
            default :

                break;
        }

        return Yii::$app->getSession()->setFlash(self::SUCCESS, [
            'type' => $type,
            'duration' => 6000,
            'icon' => 'fa fa-users',
            'message' => $message,
            'title' => $title,
            'positonY' => 'top',
            'positonX' => 'right',
        ]);
    }

    /**
     * @param $title
     * @param $message
     */
    public function notificationError($title, $message)
    {
        return Yii::$app->getSession()->setFlash(self::SUCCESS, [
            'type' => 'danger',
            'duration' => 6000,
            'icon' => 'fa fa-ban',
            'message' => $message,
            'title' => $title,
            'positonY' => 'top',
            'positonX' => 'right',
        ]);
    }

    /**
     * @param $id
     * @param $password
     * @return string
     */
    public function encryptPassword($id, $password)
    {
        $transaction = Yii::$app->db;
        $transaction->createCommand()
            ->update('usuario',
                [
                    'contrasena' => (string)Yii::$app->getSecurity()->generatePasswordHash($password),
                ],
                'id = ' . (int)$id)
            ->execute();

        return 'ok';
    }
}

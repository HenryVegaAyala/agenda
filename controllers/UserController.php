<?php

namespace app\controllers;

use app\helpers\Notificaciones;
use app\helpers\Utils;
use Yii;
use app\models\User;
use app\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * Class UserController
 * @package app\controllers
 */
class UserController extends Controller
{
    const TABLE = 'usuario';
    const INDEX = 'index';
    const SUCCESS = 'success';

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
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->post());

        return $this->render(self::INDEX, [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new User();
        if ($model->load(Yii::$app->request->post())) {
            $model->id = (int)Utils::idTable(self::TABLE);
            $model->cliente_id = 0;
            $model->empresa_id = Yii::$app->user->identity->empresa_id;
            $model->authKey = md5(rand(1, 9999));
            $model->accessToken = md5(rand(1, 9999));
            $model->fecha_digitada = Utils::zonaHoraria();
            $model->usuario_digitado = Yii::$app->user->identity->correo;
            $model->ip = Yii::$app->request->userIP;
            $model->host = strval(php_uname());
            $model->estado = (int)$model->estado;
            $model->type = 0;
            $model->save();

            $this->encryptPassword($model->id, $model->contrasena);
            Notificaciones::notificacionUsuario(1, $model->nombres);

            return $this->redirect([self::INDEX]);
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
        if ($model->load(Yii::$app->request->post())) {
            $connection = Yii::$app->db;
            $connection->createCommand()
                ->update(self::TABLE,
                    [
                        'fecha_modificada' => Utils::zonaHoraria(),
                        'usuario_modificado' => Yii::$app->user->identity->correo,
                        'ip' => Yii::$app->request->userIP,
                        'host' => strval(php_uname()),
                        'estado' => (int)$model->estado,
                        'nombres' => $model->nombres,
                        'correo' => $model->correo,
                        'type' => (int)$model->type,
                    ],
                    'id = :id', [':id' => $id])
                ->execute();
            $this->encryptPassword($model->id, $model->contrasena);
            Notificaciones::notificacionUsuario(2, $model->nombres);

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
            $this->notification(4, $model->nombre . ' ' . $model->apellido, Utils::getRol($model->privilegio));

            return $this->redirect([self::INDEX]);
        } else {
            return $this->render('change', [
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
        $user = User::find()->where(['id' => $id])->one();
        Notificaciones::notificacionUsuario(3, $user->nombres);
        $this->findModel($id)->delete();

        return $this->redirect([self::INDEX]);
    }

    /**
     * @param $id
     * @return \yii\web\Response
     */
    public function actionStatus($id)
    {
        $transaction = Yii::$app->db;
        $transaction->createCommand()
            ->update(self::TABLE,
                [
                    'estado' => (int)0,
                ],
                'id = ' . (int)$id)
            ->execute();

        return $this->redirect([self::INDEX]);
    }

    /**
     * @param $id
     * @return User|array|null|\yii\db\ActiveRecord
     * @throws NotFoundHttpException
     */
    protected function findModel($id)
    {
        if (($model = User::find()->select([
                'id',
                'nombres',
                'correo',
                'estado',
                'type',
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
     * @param $id
     * @param $password
     * @return string
     */
    public function encryptPassword($id, $password)
    {
        $transaction = Yii::$app->db;
        $transaction->createCommand()
            ->update(self::TABLE,
                [
                    'contrasena' => (string)Yii::$app->getSecurity()->generatePasswordHash($password),
                ],
                'id = ' . (int)$id)
            ->execute();

        return 'ok';
    }
}

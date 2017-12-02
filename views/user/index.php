<?php

use app\helpers\Utils;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sistema de Ticket - Listas de Usuario';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="right_col" role="main">
    <div class="clearfix"></div>
    <div class="x_panel">
        <div class="x_content">
            <?php Pjax::begin([
                'timeout' => false,
                'enablePushState' => false,
                'clientOptions' => ['method' => 'POST'],
            ]); ?>
            <div class="table table-striped table-responsive">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?= $this->title ?></h3>
                    </div>
                    <p class="note"></p>
                    <div class="container-fluid">
                        <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                                [
                                    'attribute' => 'nombres',
                                    'label' => 'Nombres y Apellidos',
                                    'value' => 'nombres',
                                ],
                                'correo',
                                [
                                    'attribute' => 'estado',
                                    'label' => 'Estado',
                                    'filter' => Utils::status(),
                                    'value' => function ($data) {
                                        return Utils::getStatus($data->estado);
                                    },
                                ],
                                [
                                    'attribute' => 'type',
                                    'label' => 'Tipo Usuario',
                                    'filter' => Utils::typeUserOption(),
                                    'value' => function ($data) {
                                        return Utils::getTypeUser($data->type);
                                    },
                                ],
                                [
                                    'class' => 'yii\grid\ActionColumn',
                                    'header' => 'Opciones',
                                    'options' => ['style' => 'width:100px;'],
                                    'template' => ' {update} / {delete} / {cancel}',
                                    'headerOptions' => ['class' => 'itemHide'],
                                    'contentOptions' => ['class' => 'itemHide'],
                                    'buttons' => [
                                        'update' => function ($url, $model) {
                                            return Html::a('<span class="fa fa-pencil-square-o fa-lg-icon"></span>',
                                                Yii::$app->urlManager->createUrl(['actualizar-usuario/' . $model->id]),
                                                ['title' => Yii::t('yii', 'Actualizar'),]
                                            );
                                        },
                                        'delete' => function ($url, $model) {
                                            return Html::a('<i class="fa fa-trash-o fa-lg-icon" aria-hidden="true"></i>',
                                                ['eliminar-usuario/' . $model['id']], [
                                                    'title' => Yii::t('app', 'Eliminar'),
                                                    'data-confirm' => Yii::t('app',
                                                        '¿Esta Seguro de eliminar este usuario?'),
                                                    'data-method' => 'post',
                                                ]);
                                        },
                                        'cancel' => function ($url, $model) {
                                            return Html::a('<i class="fa fa-ban fa-lg-icon" aria-hidden="true"></i>',
                                                Yii::$app->urlManager->createUrl(['inactivar/' . $model->id]),
                                                [
                                                    'title' => Yii::t('yii', 'Inactivar Usuario'),
                                                ]
                                            );
                                        },
                                    ],
                                ],
                            ],
                        ]); ?>
                    </div>
                    <div class="panel-footer container-fluid">
                        <div class="col-sm-12">
                            <?= Html::a('<i class="fa fa-refresh" aria-hidden="true"></i> Refrescar', ['index'],
                                ['class' => 'btn btn-primary']) ?>
                        </div>
                    </div>
                </div>
                <?php Pjax::end(); ?>
            </div>
        </div>
    </div>
</div>
<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ClienteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ticket - Lista de Clientes';
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
            <div class="table table-striped table-responsive jambo_table bulk_action">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?= "Lista de Clientes" ?></h3>
                    </div>
                    <p class="note"></p>
                    <div class="container-fluid">
                        <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],

                                'nombres',
                                'apellidos',
                                'area',
                                'email_corp:email',

                                [
                                    'class' => 'yii\grid\ActionColumn',
                                    'header' => 'Opciones',
                                    'options' => ['style' => 'width:100px;'],
                                    'template' => ' {view} / {update} / {delete}',
                                    'headerOptions' => ['class' => 'itemHide'],
                                    'contentOptions' => ['class' => 'itemHide'],
                                    'buttons' => [
                                        'view' => function ($url, $model) {
                                            return Html::a('<i class="fa fa-eye fa-lg-icon" aria-hidden="true"></i>',
                                                Yii::$app->urlManager->createUrl(['ver-cliente/' . $model->id]),
                                                [
                                                    'title' => Yii::t('yii', 'Ver Detalle'),
                                                ]
                                            );
                                        },
                                        'update' => function ($url, $model) {
                                            return Html::a('<span class="fa fa-pencil-square-o fa-lg-icon"></span>',
                                                Yii::$app->urlManager->createUrl(['actualizar-cliente/' . $model->id]),
                                                ['title' => Yii::t('yii', 'Actualizar'),]
                                            );
                                        },
                                        'delete' => function ($url, $model) {
                                            return Html::a('<i class="fa fa-trash-o fa-lg-icon" aria-hidden="true"></i>',
                                                ['eliminar-cliente/' . $model['id']], [
                                                    'title' => Yii::t('app', 'Eliminar'),
                                                    'data-confirm' => Yii::t('app',
                                                        '¿Esta Seguro de eliminar este usuario?'),
                                                    'data-method' => 'post',
                                                ]);
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

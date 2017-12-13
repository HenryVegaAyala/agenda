<?php

use kartik\date\DatePicker;
use kartik\daterange\DateRangePicker;
use kartik\widgets\Select2;
use yii\grid\ActionColumn;
use yii\grid\SerialColumn;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\IncidenciaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ticket - Asignar Técnico';
$this->params['breadcrumbs'][] = $this->title;
$indencia = new \app\models\Incidencia()
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
                        <?php if (Yii::$app->user->identity->type === 2) { ?>
                            <?= GridView::widget([
                                'dataProvider' => $dataProvider,
                                'filterModel' => $searchModel,
                                'columns' => [
                                    ['class' => SerialColumn::class],
                                    'numero',
                                    'cliente',
                                    [
                                        'attribute' => 'ci',
                                        'label' => 'Técnico',
                                        'value' => 'ci',
                                    ],
                                    [
                                        'attribute' => 'prioridad',
                                        'value' => 'prioridad',
                                        'filter' => Html::activeDropDownList($searchModel, 'prioridad',
                                            $indencia::prioridad(),
                                            ['class' => 'form-control', 'prompt' => '']),
                                    ],
                                    [
                                        'attribute' => 'fecha_deseada',
                                        'value' => 'fecha_deseada',
                                        'format' => ['date', 'php:d-m-Y'],
                                        'options' => ['style' => 'width: 20%;'],
                                        'filter' => DatePicker::widget([
                                            'model' => $searchModel,
                                            'attribute' => 'fecha_deseada',
                                            'options' => ['placeholder' => ''],
                                            'pluginOptions' => [
                                                'id' => 'fecha_deseada',
                                                'autoclose' => true,
                                                'format' => 'dd-mm-yyyy',
                                                'startView' => 'days',
                                            ],
                                        ]),
                                    ],
                                    [
                                        'attribute' => 'status',
                                        'value' => 'status',
                                        'filter' => Html::activeDropDownList($searchModel, 'status',
                                            $indencia::estado(),
                                            ['class' => 'form-control', 'prompt' => '']),
                                    ],
                                    [
                                        'class' => ActionColumn::class,
                                        'header' => 'Opciones',
                                        'options' => ['style' => 'width:80px;'],
                                        'template' => ' {update}',
                                        'headerOptions' => ['class' => 'itemHide'],
                                        'contentOptions' => ['class' => 'itemHide'],
                                        'buttons' => [
                                            'update' => function ($url, $model) {
                                                return Html::a('<span class="fa fa-pencil-square-o fa-lg-icon"></span>',
                                                    Yii::$app->urlManager->createUrl(['asignar-incidencia/' . $model->id]),
                                                    ['title' => Yii::t('yii', 'Actualizar'),]
                                                );
                                            },
                                            'delete' => function ($url, $model) {
                                                return Html::a('<i class="fa fa-trash-o fa-lg-icon" aria-hidden="true"></i>',
                                                    ['eliminar-incidencia/' . $model['id']], [
                                                        'title' => Yii::t('app', 'Eliminar'),
                                                        'data-confirm' => Yii::t('app',
                                                            '¿Esta Seguro de eliminar esta incidencia?'),
                                                        'data-method' => 'post',
                                                    ]);
                                            },
                                        ],
                                    ],
                                ],
                            ]); ?>
                        <?php } else { ?>
                            <?= GridView::widget([
                                'dataProvider' => $dataProvider,
                                'filterModel' => $searchModel,
                                'columns' => [
                                    ['class' => SerialColumn::class],
                                    'numero',
                                    'cliente',
                                    [
                                        'attribute' => 'prioridad',
                                        'value' => 'prioridad',
                                        'filter' => Html::activeDropDownList($searchModel, 'prioridad',
                                            $indencia::prioridad(),
                                            ['class' => 'form-control', 'prompt' => '']),
                                    ],
                                    [
                                        'attribute' => 'fecha_deseada',
                                        'value' => 'fecha_deseada',
                                        'format' => ['date', 'php:d-m-Y'],
                                        'options' => ['style' => 'width: 20%;'],
                                        'filter' => DatePicker::widget([
                                            'model' => $searchModel,
                                            'attribute' => 'fecha_deseada',
                                            'options' => ['placeholder' => ''],
                                            'pluginOptions' => [
                                                'id' => 'fecha_deseada',
                                                'autoclose' => true,
                                                'format' => 'dd-mm-yyyy',
                                                'startView' => 'days',
                                            ],
                                        ]),
                                    ],
                                    [
                                        'attribute' => 'status',
                                        'value' => 'status',
                                        'filter' => Html::activeDropDownList($searchModel, 'status',
                                            $indencia::estado(),
                                            ['class' => 'form-control', 'prompt' => '']),
                                    ],
                                    [
                                        'class' => ActionColumn::class,
                                        'header' => 'Opciones',
                                        'options' => ['style' => 'width:80px;'],
                                        'template' => ' {update} / {delete}',
                                        'headerOptions' => ['class' => 'itemHide'],
                                        'contentOptions' => ['class' => 'itemHide'],
                                        'buttons' => [
                                            'update' => function ($url, $model) {
                                                return Html::a('<span class="fa fa-pencil-square-o fa-lg-icon"></span>',
                                                    Yii::$app->urlManager->createUrl(['actualizar-incidencia/' . $model->id]),
                                                    ['title' => Yii::t('yii', 'Actualizar'),]
                                                );
                                            },
                                            'delete' => function ($url, $model) {
                                                return Html::a('<i class="fa fa-trash-o fa-lg-icon" aria-hidden="true"></i>',
                                                    ['eliminar-incidencia/' . $model['id']], [
                                                        'title' => Yii::t('app', 'Eliminar'),
                                                        'data-confirm' => Yii::t('app',
                                                            '¿Esta Seguro de eliminar esta incidencia?'),
                                                        'data-method' => 'post',
                                                    ]);
                                            },
                                        ],
                                    ],
                                ],
                            ]); ?>
                        <?php } ?>
                    </div>
                    <div class="panel-footer container-fluid">
                        <div class="col-sm-12">
                            <?= Html::a('<i class="fa fa-refresh" aria-hidden="true"></i> Refrescar', ['tecnico'],
                                ['class' => 'btn btn-primary']) ?>
                        </div>
                    </div>
                </div>
                <?php Pjax::end(); ?>
            </div>
        </div>
    </div>
</div>
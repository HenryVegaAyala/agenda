<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\IncidenciaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ticket - Lista de Incidencias';
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
            <div class="table table-striped table-responsive jambo_table bulk_action">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?= "Lista de Indicencias" ?></h3>
                    </div>
                    <p class="note"></p>
                    <div class="container-fluid">
                        <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],

                                'empresa',
                                'cliente',
                                'contacto',
                                'notas',
                                'impacto',
                                'urgencia',
                                'prioridad',
                                'tipo_incidencia',
                                'estado',
                                ['class' => 'yii\grid\ActionColumn'],
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
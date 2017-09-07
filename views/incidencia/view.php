<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Incidencia */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Incidencias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="incidencia-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'empresa',
            'cliente',
            'contacto',
            'notas',
            'resumen',
            'servico',
            'ci',
            'fecha_deseada',
            'impacto',
            'urgencia',
            'prioridad',
            'tipo_incidencia',
            'fuente_reportada',
            'fecha_digitada',
            'fecha_modificada',
            'fecha_eliminada',
            'usuario_digitado',
            'usuario_modificado',
            'usuario_eliminado',
            'estado',
            'ip',
            'host',
        ],
    ]) ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\IncidenciaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="incidencia-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'empresa') ?>

    <?= $form->field($model, 'cliente') ?>

    <?= $form->field($model, 'contacto') ?>

    <?= $form->field($model, 'notas') ?>

    <?php // echo $form->field($model, 'resumen') ?>

    <?php // echo $form->field($model, 'servico') ?>

    <?php // echo $form->field($model, 'ci') ?>

    <?php // echo $form->field($model, 'fecha_deseada') ?>

    <?php // echo $form->field($model, 'impacto') ?>

    <?php // echo $form->field($model, 'urgencia') ?>

    <?php // echo $form->field($model, 'prioridad') ?>

    <?php // echo $form->field($model, 'tipo_incidencia') ?>

    <?php // echo $form->field($model, 'fuente_reportada') ?>

    <?php // echo $form->field($model, 'fecha_digitada') ?>

    <?php // echo $form->field($model, 'fecha_modificada') ?>

    <?php // echo $form->field($model, 'fecha_eliminada') ?>

    <?php // echo $form->field($model, 'usuario_digitado') ?>

    <?php // echo $form->field($model, 'usuario_modificado') ?>

    <?php // echo $form->field($model, 'usuario_eliminado') ?>

    <?php // echo $form->field($model, 'estado') ?>

    <?php // echo $form->field($model, 'ip') ?>

    <?php // echo $form->field($model, 'host') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

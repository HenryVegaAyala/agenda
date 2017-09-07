<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ClienteSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cliente-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'nombres') ?>

    <?= $form->field($model, 'apellidos') ?>

    <?= $form->field($model, 'email') ?>

    <?= $form->field($model, 'dni') ?>

    <?php // echo $form->field($model, 'numero_celular') ?>

    <?php // echo $form->field($model, 'area') ?>

    <?php // echo $form->field($model, 'cargo') ?>

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

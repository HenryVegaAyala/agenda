<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Incidencia */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="incidencia-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'empresa')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cliente')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contacto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'notas')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'resumen')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'servico')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ci')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fecha_deseada')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'impacto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'urgencia')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'prioridad')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tipo_incidencia')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fuente_reportada')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fecha_digitada')->textInput() ?>

    <?= $form->field($model, 'fecha_modificada')->textInput() ?>

    <?= $form->field($model, 'fecha_eliminada')->textInput() ?>

    <?= $form->field($model, 'usuario_digitado')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'usuario_modificado')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'usuario_eliminado')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'estado')->textInput() ?>

    <?= $form->field($model, 'ip')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'host')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

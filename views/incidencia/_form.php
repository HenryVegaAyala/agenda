<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\Incidencia */
/* @var $form yii\widgets\ActiveForm */

$descripcion = "Registrar Incidencia";
?>
<div class="clearfix"></div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_content">
                <?php Pjax::begin(); ?>
                <?php $form = ActiveForm::begin(
                    [
                        'id' => 'dynamic-form',
                        'enableAjaxValidation' => false,
                        'enableClientValidation' => true,
                        'validateOnChange' => false,
                        'method' => 'post',
                        'options' => [
                            'class' => 'form-horizontal form-label-left',
                            'data-pjax' => true,
                        ],
                    ]
                ); ?>
                <span class="section"><?php echo Html::encode($descripcion) ?></span>
                <div class="row">
                    <div class="item form-group">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?= $form->field($model, 'empresa')->textInput([
                                        'class' => 'form-control col-md-7 col-xs-12',
                                    ]) ?>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?= $form->field($model, 'cliente')->textInput([
                                        'class' => 'form-control col-md-7 col-xs-12',
                                    ]) ?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?= $form->field($model, 'contacto')->textInput([
                                        'class' => 'form-control col-md-7 col-xs-12',
                                    ]) ?>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?= $form->field($model, 'notas')->textInput([
                                        'class' => 'form-control col-md-7 col-xs-12',
                                    ]) ?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?= $form->field($model, 'resumen')->textInput([
                                        'class' => 'form-control col-md-7 col-xs-12',
                                    ]) ?>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?= $form->field($model, 'servico')->textInput([
                                        'class' => 'form-control col-md-7 col-xs-12',
                                    ]) ?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?= $form->field($model, 'ci')->textInput([
                                        'class' => 'form-control col-md-7 col-xs-12',
                                    ]) ?>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?= $form->field($model, 'fecha_deseada')->textInput([
                                        'class' => 'form-control col-md-7 col-xs-12',
                                    ]) ?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?= $form->field($model, 'impacto')->textInput([
                                        'class' => 'form-control col-md-7 col-xs-12',
                                    ]) ?>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?= $form->field($model, 'urgencia')->textInput([
                                        'class' => 'form-control col-md-7 col-xs-12',
                                    ]) ?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?= $form->field($model, 'prioridad')->textInput([
                                        'class' => 'form-control col-md-7 col-xs-12',
                                    ]) ?>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?= $form->field($model, 'tipo_incidencia')->textInput([
                                        'class' => 'form-control col-md-7 col-xs-12',
                                    ]) ?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?= $form->field($model, 'fuente_reportada')->textInput([
                                        'class' => 'form-control col-md-7 col-xs-12',
                                    ]) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ln_solid"></div>
                <div class="form-group">
                    <center>
                        <div class="col-md-6 col-xs-12 col-md-offset-3">
                            <?= Html::submitButton('<i class="fa fa-floppy-o fa-lg"></i> ' . ' Guardar',
                                ['class' => 'btn btn-success']) ?>
                            <?= Html::resetButton('<i class="fa fa-times fa-lg"></i> ' . ' Cancelar',
                                ['class' => 'btn btn-primary', 'id' => 'cancelar']) ?>
                        </div>
                    </center>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
            <?php Pjax::end(); ?>
        </div>
    </div>
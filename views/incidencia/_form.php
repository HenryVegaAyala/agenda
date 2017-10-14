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
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="container-fluid">

                                <span class="center-left">* Datos Empresarial</span>

                                <div class="row">
                                    <div class="col-md-12 col-sm-6 col-xs-12">
                                        <?= $form->field($model, 'empresa', [
                                            'inputOptions' => [
                                                'class' => 'form-control col-md-7 col-xs-12',
                                                'value' => 'Admisnitradora Clinica',
                                                'readonly' => true,
                                            ],
                                        ])->textInput()->input('text', ['placeholder' => "Empresa"])->label(false) ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-sm-6 col-xs-12">
                                        <?= $form->field($model, 'cliente', [
                                            'inputOptions' => [
                                                'class' => 'form-control col-md-7 col-xs-12',
                                                'value' => Yii::$app->user->identity->nombres,
                                                'readonly' => true,
                                            ],
                                        ])->textInput()->input('text',
                                            ['placeholder' => "Cliente"])->label(false) ?>
                                    </div>
                                </div>

                                <span class="center-left">* Resumen</span>

                                <div class="row">
                                    <div class="col-md-12 col-sm-6 col-xs-12">
                                        <?= $form->field($model, 'notas', [
                                            'inputOptions' => [
                                                'class' => 'form-control col-md-7 col-xs-12',
                                            ],
                                        ])->textarea(['rows' => '2', 'placeholder' => "Notas"])->label(false) ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-sm-6 col-xs-12">
                                        <?= $form->field($model, 'resumen', [
                                            'inputOptions' => [
                                                'class' => 'form-control col-md-7 col-xs-12',
                                            ],
                                        ])->textInput()->input('text',
                                            ['placeholder' => "Resumen"])->label(false) ?>
                                    </div>
                                </div>

                                <span class="center-left">* Servicio</span>

                                <div class="row">
                                    <div class="col-md-12 col-sm-6 col-xs-12">
                                        <?= $form->field($model, 'servico', [
                                            'inputOptions' => [
                                                'class' => 'form-control col-md-7 col-xs-12',
                                            ],
                                        ])->textInput()->input('text',
                                            ['placeholder' => "Servicio"])->label(false) ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-sm-6 col-xs-12">
                                        <?= $form->field($model, 'ci', [
                                            'inputOptions' => [
                                                'class' => 'form-control col-md-7 col-xs-12',
                                            ],
                                        ])->textInput()->input('text',
                                            ['placeholder' => "C.I."])->label(false) ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-sm-6 col-xs-12">
                                        <?= $form->field($model, 'fecha_deseada', [
                                            'inputOptions' => [
                                                'class' => 'form-control col-md-7 col-xs-12',
                                            ],
                                        ])->textInput()->input('text',
                                            ['placeholder' => "Fecha Deseada"])->label(false) ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-sm-6 col-xs-12">
                                        <?= $form->field($model, 'impacto', [
                                            'inputOptions' => [
                                                'class' => 'form-control col-md-7 col-xs-12',
                                            ],
                                        ])->textInput()->input('text',
                                            ['placeholder' => "Impacto"])->label(false) ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-sm-6 col-xs-12">
                                        <?= $form->field($model, 'urgencia', [
                                            'inputOptions' => [
                                                'class' => 'form-control col-md-7 col-xs-12',
                                            ],
                                        ])->textInput()->input('text',
                                            ['placeholder' => "Urgencia"])->label(false) ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-sm-6 col-xs-12">
                                        <?= $form->field($model, 'prioridad', [
                                            'inputOptions' => [
                                                'class' => 'form-control col-md-7 col-xs-12',
                                            ],
                                        ])->textInput()->input('text',
                                            ['placeholder' => "Prioridad"])->label(false) ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-sm-6 col-xs-12">
                                        <?= $form->field($model, 'tipo_incidencia', [
                                            'inputOptions' => [
                                                'class' => 'form-control col-md-7 col-xs-12',
                                            ],
                                        ])->textInput()->input('text',
                                            ['placeholder' => "Tipo de Incidencia"])->label(false) ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-sm-6 col-xs-12">
                                        <?= $form->field($model, 'fuente_reportada', [
                                            'inputOptions' => [
                                                'class' => 'form-control col-md-7 col-xs-12',
                                            ],
                                        ])->textInput()->input('text',
                                            ['placeholder' => "Fuente Reportada"])->label(false) ?>
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
    </div>
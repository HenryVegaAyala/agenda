<?php

use app\helpers\Utils;
use kartik\widgets\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\Cliente */
/* @var $form yii\widgets\ActiveForm */

$descripcion = "Registrar Cliente";
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

                                <span class="center-text">Datos Personales</span>

                                <div class="row">
                                    <div class="col-md-12 col-sm-6 col-xs-12">
                                        <?= $form->field($model, 'nombres', [
                                            'inputOptions' => [
                                                'class' => 'form-control col-md-7 col-xs-12',
                                            ],
                                        ])->textInput()->input('text', ['placeholder' => "Nombres"])->label(false) ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-sm-6 col-xs-12">
                                        <?= $form->field($model, 'apellidos', [
                                            'inputOptions' => [
                                                'class' => 'form-control col-md-7 col-xs-12',
                                            ],
                                        ])->textInput()->input('text', ['placeholder' => "Apellidos"])->label(false) ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-sm-6 col-xs-12">
                                        <?= $form->field($model, 'dni', [
                                            'inputOptions' => [
                                                'class' => 'form-control col-md-7 col-xs-12',
                                            ],
                                        ])->textInput()->input('text', ['placeholder' => "DNI"])->label(false) ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-sm-6 col-xs-12">
                                        <?= $form->field($model, 'fecha_nacimiento')->widget(DatePicker::classname(), [
                                            'options' => ['placeholder' => 'Fecha de Nacimiento'],
                                            'value' => date('d-M-Y'),
                                            'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                                            'pluginOptions' => [
                                                'autoclose' => true,
                                                'format' => 'dd-mm-yyyy',
                                                'todayHighlight' => true,
                                                'class' => 'form-control col-md-7 col-xs-12',
                                            ],
                                        ])->label(false);
                                        ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-sm-6 col-xs-12">
                                        <?= $form->field($model,
                                            'genero')->dropDownList(Utils::genero(), [
                                            'prompt' => 'Seleccionar Género',
                                            'class' => 'form-control col-md-7 col-xs-12',
                                        ])->label(false) ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-sm-6 col-xs-12">
                                        <?= $form->field($model, 'email_personal', [
                                            'inputOptions' => [
                                                'class' => 'form-control col-md-7 col-xs-12',
                                            ],
                                        ])->textInput()->input('text',
                                            ['placeholder' => "Email Personal"])->label(false) ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-sm-6 col-xs-12">
                                        <?= $form->field($model, 'ubicacion', [
                                            'inputOptions' => [
                                                'class' => 'form-control col-md-7 col-xs-12',
                                            ],
                                        ])->textInput()->input('text', ['placeholder' => "Dirección"])->label(false) ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-sm-6 col-xs-12">
                                        <?= $form->field($model,
                                            'estado_civil')->dropDownList(Utils::estadoCivil(), [
                                            'prompt' => 'Seleccionar Estado Civil',
                                            'class' => 'form-control col-md-7 col-xs-12',
                                        ])->label(false) ?>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-sm-6 col-xs-12">
                                        <?= $form->field($model, 'numero_celular', [
                                            'inputOptions' => [
                                                'class' => 'form-control col-md-7 col-xs-12',
                                            ],
                                        ])->textInput()->input('text',
                                            ['placeholder' => "Número de Celular"])->label(false) ?>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="container-fluid">

                                <span class="center-text">Datos Laborales</span>

                                <div class="row">
                                    <div class="col-md-12 col-sm-6 col-xs-12">
                                        <?= $form->field($model, 'area', [
                                            'inputOptions' => [
                                                'class' => 'form-control col-md-7 col-xs-12',
                                            ],
                                        ])->textInput()->input('text', ['placeholder' => "Área"])->label(false) ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-sm-6 col-xs-12">
                                        <?= $form->field($model, 'puesto', [
                                            'inputOptions' => [
                                                'class' => 'form-control col-md-7 col-xs-12',
                                            ],
                                        ])->textInput()->input('text', ['placeholder' => "Puesto"])->label(false) ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-sm-6 col-xs-12">
                                        <?= $form->field($model, 'categoria', [
                                            'inputOptions' => [
                                                'class' => 'form-control col-md-7 col-xs-12',
                                            ],
                                        ])->textInput()->input('text', ['placeholder' => "Categoría"])->label(false) ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-sm-6 col-xs-12">
                                        <?= $form->field($model, 'email_corp', [
                                            'inputOptions' => [
                                                'class' => 'form-control col-md-7 col-xs-12',
                                            ],
                                        ])->textInput()->input('text',
                                            ['placeholder' => "Email Corporativo"])->label(false) ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-sm-6 col-xs-12">
                                        <?= $form->field($model, 'numero_emergencia', [
                                            'inputOptions' => [
                                                'class' => 'form-control col-md-7 col-xs-12',
                                            ],
                                        ])->textInput()->input('text',
                                            ['placeholder' => "Número de Emergencia"])->label(false) ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-sm-6 col-xs-12">
                                        <?= $form->field($model, 'fecha_ingreso')->widget(DatePicker::classname(), [
                                            'options' => ['placeholder' => 'Fecha de Ingreso'],
                                            'value' => date('d-M-Y'),
                                            'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                                            'pluginOptions' => [
                                                'autoclose' => true,
                                                'format' => 'dd-mm-yyyy',
                                                'todayHighlight' => true,
                                                'class' => 'form-control col-md-7 col-xs-12',
                                            ],
                                        ])->label(false);
                                        ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <?= $form->field($model, 'numero_oficina', [
                                            'inputOptions' => [
                                                'class' => 'form-control col-md-7 col-xs-12',
                                            ],
                                        ])->textInput()->input('text',
                                            ['placeholder' => "Número de Oficina"])->label(false) ?>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <?= $form->field($model, 'anexo', [
                                            'inputOptions' => [
                                                'class' => 'form-control col-md-7 col-xs-12',
                                            ],
                                        ])->textInput()->input('text', ['placeholder' => "Anexo"])->label(false) ?>
                                    </div>
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
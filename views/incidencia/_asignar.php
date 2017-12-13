<?php

use app\models\Incidencia;
use dosamigos\tinymce\TinyMce;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Incidencia */
/* @var $cliente app\models\Incidencia */
/* @var $ticket app\models\Incidencia */
/* @var $form yii\widgets\ActiveForm */

$descripcion = 'Asignar Técnico';
?>
<div class='clearfix'></div>
<div class='row'>
    <div class='col-md-12 col-sm-12 col-xs-12'>
        <div class='x_panel'>
            <div class='x_content'>
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
                <span class='section'><?php echo Html::encode($descripcion) ?></span>
                <div class='row'>
                    <div class='item form-group'>
                        <div class='col-md-6 col-sm-12 col-xs-12'>
                            <div class='container-fluid'>

                                <span class='center-left'>* Datos Personales</span>

                                <div class='row'>
                                    <div class='col-md-12 col-sm-6 col-xs-12'>
                                        <?= $form->field($model, 'numero', [
                                            'inputOptions' => [
                                                'class' => 'form-control col-md-7 col-xs-12',
                                                'readonly' => true,
                                            ],
                                        ])->textInput()->input('text',
                                            ['placeholder' => 'N° de Ticket'])->label(false) ?>
                                    </div>
                                </div>

                                <div class='row'>
                                    <div class='col-md-12 col-sm-6 col-xs-12'>
                                        <?= $form->field($model, 'cliente', [
                                            'inputOptions' => [
                                                'class' => 'form-control col-md-7 col-xs-12',
                                                'value' => $cliente->nombres . ' ' . $cliente->apellidos,
                                                'readonly' => true,
                                            ],
                                        ])->textInput()->input('text',
                                            ['placeholder' => 'Nombre del Cliente Cliente'])->label(false) ?>
                                    </div>
                                </div>

                                <div class='row'>
                                    <div class='col-md-12 col-sm-6 col-xs-12'>
                                        <?= $form->field($model, 'area', [
                                            'inputOptions' => [
                                                'class' => 'form-control col-md-7 col-xs-12',
                                                'value' => $cliente->area,
                                                'readonly' => true,
                                            ],
                                        ])->textInput()->input('text',
                                            ['placeholder' => 'Area'])->label(false) ?>
                                    </div>
                                </div>

                                <div class='row'>
                                    <div class='col-md-12 col-sm-6 col-xs-12'>
                                        <?= $form->field($model, 'cargo', [
                                            'inputOptions' => [
                                                'class' => 'form-control col-md-7 col-xs-12',
                                                'value' => $cliente->puesto,
                                                'readonly' => true,
                                            ],
                                        ])->textInput()->input('text',
                                            ['placeholder' => 'Cargo'])->label(false) ?>
                                    </div>
                                </div>

                                <div class='row'>
                                    <div class='col-md-12 col-sm-6 col-xs-12'>
                                        <?= $form->field($model, 'anexo', [
                                            'inputOptions' => [
                                                'class' => 'form-control col-md-7 col-xs-12',
                                                'value' => $cliente->anexo,
                                                'readonly' => true,
                                            ],
                                        ])->textInput()->input('text',
                                            ['placeholder' => 'Anexo'])->label(false) ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-sm-6 col-xs-12">
                                        <?= $form->field($model,
                                            'producto')->dropDownList(Incidencia::producto(), [
                                            'prompt' => 'Seleccionar un Productos',
                                            'class' => 'form-control col-md-7 col-xs-12',
                                            'disabled' => true,
                                        ])->label(false) ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-sm-6 col-xs-12">
                                        <?= $form->field($model,
                                            'ci')->dropDownList(Incidencia::userTecnico(), [
                                            'prompt' => 'Seleccionar un Técnico',
                                            'class' => 'form-control col-md-7 col-xs-12',
                                        ])->label(false) ?>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class='col-md-6 col-sm-12 col-xs-12'>
                            <div class='container-fluid'>

                                <span class='center-left'>* Detalle de la Incidencia</span>

                                <?= $form->field($model, 'resumen')->widget(TinyMce::className(), [
                                    'options' => ['rows' => 8],
                                    'language' => 'es',
                                    'clientOptions' => [
                                        'plugins' => [
                                            'advlist autolink lists link charmap print preview anchor',
                                            'searchreplace visualblocks code fullscreen',
                                            'insertdatetime media table contextmenu paste',
                                            'textcolor colorpicker',
                                        ],
                                        'toolbar' => 'undo redo | 
                                                      styleselect  fontselect fontsizeselect forecolor backcolor | 
                                                      bold italic | 
                                                      alignleft aligncenter alignright alignjustify | 
                                                      bullist numlist outdent indent | 
                                                      link image',
                                    ],
                                ])->label(false); ?>
                            </div>
                        </div>
                    </div>
                    <div class='ln_solid'></div>
                    <div class='form-group'>
                        <center>
                            <div class='col-md-6 col-xs-12 col-md-offset-3'>
                                <?= Html::submitButton('<i class=\'fa fa-floppy-o fa-lg\'></i>' . ' Guardar',
                                    ['class' => 'btn btn-success']) ?>
                                <?= Html::resetButton('<i class=\'fa fa-times fa-lg\'></i>' . ' Cancelar',
                                    ['class' => 'btn btn-primary', 'id' => 'cancelar']) ?>
                            </div>
                        </center>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
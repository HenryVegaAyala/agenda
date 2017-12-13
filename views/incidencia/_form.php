<?php

use app\models\Incidencia;
use dosamigos\tinymce\TinyMce;
use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\Incidencia */
/* @var $cliente app\models\Incidencia */
/* @var $ticket app\models\Incidencia */
/* @var $form yii\widgets\ActiveForm */

$descripcion = 'Registrar Incidencia';
?>
<div class='clearfix'></div>
<div class='row'>
    <div class='col-md-12 col-sm-12 col-xs-12'>
        <div class='x_panel'>
            <div class='x_content'>
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
                <span class='section'><?php echo Html::encode($descripcion) ?></span>
                <div class='row'>
                    <div class='item form-group'>
                        <div class='col-md-6 col-sm-12 col-xs-12'>
                            <div class='container-fluid'>

                                <span class='center-left'>* Datos Personales</span>

                                <div class='row'>
                                    <div class='col-md-12 col-sm-6 col-xs-12'>
                                        <?= $form->field($model, 'num_ticket', [
                                            'inputOptions' => [
                                                'class' => 'form-control col-md-7 col-xs-12',
                                                'value' => $ticket,
                                                'readonly' => true,
                                            ],
                                        ])->textInput()->input('text', ['placeholder' => 'N° de Ticket'])->label(false) ?>
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
                                            'prompt' => 'Seleccionar un Producto',
                                            'class' => 'form-control col-md-7 col-xs-12',
                                            'value' => '0',
                                        ])->label(false) ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-sm-6 col-xs-12">
                                        <?= $form->field($model, 'fecha_deseada')->widget(DatePicker::classname(), [
                                            'options' => ['placeholder' => 'Fecha Deseada'],
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
                <?php Pjax::end(); ?>
            </div>
        </div>
    </div>
</div>
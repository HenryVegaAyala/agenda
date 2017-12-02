<?php

use app\helpers\Utils;
use app\models\Incidencia;
use kartik\tabs\TabsX;
use kartik\widgets\DatePicker;
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
                                                'value' => Utils::empresaName(Yii::$app->user->identity->empresa_id),
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
                                        <?= $form->field($model,
                                            'servico')->dropDownList(Incidencia::servicio(), [
                                            'prompt' => 'Seleccionar Servicio',
                                            'class' => 'form-control col-md-7 col-xs-12',
                                            'value' => '0',
                                        ])->label(false) ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-sm-6 col-xs-12">
                                        <?= $form->field($model,
                                            'ci')->dropDownList(Incidencia::ci(), [
                                            'prompt' => 'Seleccionar Servicio',
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

                                <div class="row">
                                    <div class="col-md-12 col-sm-6 col-xs-12">
                                        <?= $form->field($model,
                                            'impacto')->dropDownList(Incidencia::impacto(), [
                                            'prompt' => 'Seleccionar Impacto',
                                            'class' => 'form-control col-md-7 col-xs-12',
                                        ])->label(false) ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-sm-6 col-xs-12">
                                        <?= $form->field($model,
                                            'urgencia')->dropDownList(Incidencia::urgencia(), [
                                            'prompt' => 'Seleccionar Urgencia',
                                            'class' => 'form-control col-md-7 col-xs-12',
                                        ])->label(false) ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-sm-6 col-xs-12">
                                        <?= $form->field($model,
                                            'prioridad')->dropDownList(Incidencia::prioridad(), [
                                            'prompt' => 'Seleccionar Prioridad',
                                            'class' => 'form-control col-md-7 col-xs-12',
                                        ])->label(false) ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-sm-6 col-xs-12">
                                        <?= $form->field($model,
                                            'tipo_incidencia')->dropDownList(Incidencia::tipoIncidencia(), [
                                            'prompt' => 'Seleccionar Tipo de Incidencia',
                                            'class' => 'form-control col-md-7 col-xs-12',
                                        ])->label(false) ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-sm-6 col-xs-12">
                                        <?= $form->field($model,
                                            'fuente_reportada')->dropDownList(Incidencia::fuenteReportada(), [
                                            'prompt' => 'Seleccionar Fuente Reportada',
                                            'class' => 'form-control col-md-7 col-xs-12',
                                        ])->label(false) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="container-fluid">
                                <?php
                                $items = [
                                    [
                                        'label' => 'Categorización',
                                        'content' =>
                                        "
                                        <div class='col-md-12 col-sm-12 col-xs-12'>
                                            <div class='container-fluid'>
                                                <span class='center-left'>* Categorización Operacional</span>
                                                <div class='row'>
                                                    <div class='col-md-12 col-sm-6 col-xs-12'>
                                                       ".
                                                         $form->field($model,
                                                        'fuente_reportada')->dropDownList(Incidencia::CatNivelOpeUno(), [
                                                        'prompt' => 'Seleccionar Categoria Operacional Nivel 1',
                                                        'class' => 'form-control col-md-7 col-xs-12',
                                                        ])->label(false)
                                                        ."
                                                    </div>
                                                </div>
                                                <div class='row'>
                                                    <div class='col-md-12 col-sm-6 col-xs-12'>
                                                       ".
                                                        $form->field($model,
                                                            'fuente_reportada')->dropDownList(Incidencia::CatNivelOpeDos(), [
                                                            'prompt' => 'Seleccionar Categoria Operacional Nivel 2',
                                                            'class' => 'form-control col-md-7 col-xs-12',
                                                        ])->label(false)
                                                        ."
                                                    </div>
                                                </div>
                                                <div class='row'>
                                                    <div class='col-md-12 col-sm-6 col-xs-12'>
                                                       ".
                                                        $form->field($model,
                                                            'fuente_reportada')->dropDownList(Incidencia::CatNivelOpeTres(), [
                                                            'prompt' => 'Seleccionar Categoria Operacional Nivel 3',
                                                            'class' => 'form-control col-md-7 col-xs-12',
                                                        ])->label(false)
                                                        ."
                                                    </div>
                                                </div>
                                                <span class='center-left'>* Categorización de Producto</span>
                                                <div class='row'>
                                                    <div class='col-md-12 col-sm-6 col-xs-12'>
                                                       ".
                                                        $form->field($model,
                                                            'fuente_reportada')->dropDownList(Incidencia::CatNivelProUno(), [
                                                            'prompt' => 'Seleccionar Categoria de Prodcuto Nivel 1',
                                                            'class' => 'form-control col-md-7 col-xs-12',
                                                        ])->label(false)
                                                        ."
                                                    </div>
                                                </div>
                                                <div class='row'>
                                                    <div class='col-md-12 col-sm-6 col-xs-12'>
                                                       ".
                                                        $form->field($model,
                                                            'fuente_reportada')->dropDownList(Incidencia::CatNivelProDos(), [
                                                            'prompt' => 'Seleccionar Categoria de Prodcuto Nivel 2',
                                                            'class' => 'form-control col-md-7 col-xs-12',
                                                        ])->label(false)
                                                        ."
                                                    </div>
                                                </div>
                                                <div class='row'>
                                                    <div class='col-md-12 col-sm-6 col-xs-12'>
                                                       ".
                                                        $form->field($model,
                                                            'fuente_reportada')->dropDownList(Incidencia::CatNivelProTres(), [
                                                            'prompt' => 'Seleccionar Categoria de Prodcuto Nivel 3',
                                                            'class' => 'form-control col-md-7 col-xs-12',
                                                        ])->label(false)
                                                        ."
                                                    </div>
                                                </div>
                                                <div class='row'>
                                                    <div class='col-md-12 col-sm-6 col-xs-12'>
                                                       ".
                                                        $form->field($model,
                                                            'fuente_reportada')->dropDownList(Incidencia::nombreDelProducto(), [
                                                            'prompt' => 'Nombre del Producto',
                                                            'class' => 'form-control col-md-7 col-xs-12',
                                                        ])->label(false)
                                                        ."
                                                    </div>
                                                </div>
                                                <div class='row'>
                                                    <div class=\"col-md-12 col-sm-6 col-xs-12\">
                                                    ".
                                                     $form->field($model, 'fuente_reportada', [
                                                         'inputOptions' => [
                                                             'class' => 'form-control col-md-7 col-xs-12',
                                                         ],
                                                     ])->textInput()->input('text', ['placeholder' => 'Modelo ó Version'])->label(false)
                                                     ."
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        ",
                                        'headerOptions' => [
                                            'style' => 'font-weight:bold',
                                            'id' => 'elemento1',
                                            'value' => '1',
                                        ],
                                        'options' => ['id' => '1'],
                                    ],
                                    [
                                        'label' => 'Tareas',
                                        'content' => '
                                        ',
                                        'headerOptions' => [
                                            'style' => 'font-weight:bold',
                                            'id' => 'elemento1',
                                            'value' => '1',
                                        ],
                                        'options' => ['id' => '2'],
                                    ],
                                ];

                                echo TabsX::widget([
                                    'position' => TabsX::POS_ABOVE,
                                    'items' => $items,
                                    'height' => TabsX::SIZE_LARGE,
                                    'bordered' => false,
                                    'encodeLabels' => true,
                                ]);
                                ?>
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
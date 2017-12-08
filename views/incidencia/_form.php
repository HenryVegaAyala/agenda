<?php

use app\helpers\Utils;
use app\models\Incidencia;
use dosamigos\tinymce\TinyMce;
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

                                <span class="center-left">* Datos Personales</span>

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

                                <?= $form->field($model, 'resumen')->widget(TinyMce::className(), [
                                    'options' => ['rows' => 8],
                                    'language' => 'es',
                                    'clientOptions' => [
                                        'plugins' => [
                                            'advlist autolink lists link charmap print preview anchor',
                                            'searchreplace visualblocks code fullscreen',
                                            'insertdatetime media table contextmenu paste',
                                            "textcolor colorpicker",
                                        ],
                                        'toolbar' => 'undo redo | 
                                                      styleselect  fontselect fontsizeselect forecolor backcolor | 
                                                      bold italic | 
                                                      alignleft aligncenter alignright alignjustify | 
                                                      bullist numlist outdent indent | 
                                                      link image',
                                    ],
                                ]); ?>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="container-fluid">

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
</div>
<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\Cliente */
/* @var $form yii\widgets\ActiveForm */
$descripcion = "Actualizar Cliente";
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
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?= $form->field($model, 'nombres')->textInput(['maxlength' => true]) ?>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?= $form->field($model, 'apellidos')->textInput(['maxlength' => true]) ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?= $form->field($model, 'dni')->textInput() ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?= $form->field($model, 'numero_celular')->textInput(['maxlength' => true]) ?>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?= $form->field($model, 'area')->textInput(['maxlength' => true]) ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?= $form->field($model, 'cargo')->textInput(['maxlength' => true]) ?>
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
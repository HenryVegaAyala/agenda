<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\Cliente */
/* @var $form yii\widgets\ActiveForm */
$descripcion = "Importar/Exportar Clientes";
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
                                <center>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <img src="<?php echo Yii::getAlias('@ExcelImport') ?>" alt="Excel Import"
                                             class="img-responsive">
                                        <?= Html::submitButton('<i class="fa fa-cloud-upload fa-lg"></i> ' . ' Importar',
                                            ['class' => 'btn btn-success']) ?>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <img src="<?php echo Yii::getAlias('@ExcelDownload') ?>" alt="Excel Download"
                                             class="img-responsive">
                                        <?= Html::submitButton('<i class="fa fa-cloud-download fa-lg"></i> ' . ' Exportar',
                                            ['class' => 'btn btn-success']) ?>
                                    </div>
                                </center>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ln_solid"></div>
            </div>
            <?php ActiveForm::end(); ?>
            <?php Pjax::end(); ?>
        </div>
    </div>
</div>
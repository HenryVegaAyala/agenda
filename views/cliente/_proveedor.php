<?php

use app\helpers\Utils;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Cliente */
/* @var $form yii\widgets\ActiveForm */
$descripcion = "Exportar Proveedores";
?>
<div class="clearfix"></div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_content">
                <?php $form = ActiveForm::begin(
                    [
                        'enableAjaxValidation' => false,
                        'id' => 'process_excel',
                        'enableClientValidation' => true,
                        'validateOnChange' => false,
                        'method' => 'post',
                        'options' => [
                            'class' => 'form-horizontal form-label-left',
                            'enctype' => "multipart/form-data",
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
                                    <!--<div class="col-md-6 col-sm-6 col-xs-6">-->
                                    <!--    <img src="-->
                                    <?php //echo Utils::url(). Yii::getAlias('@ExcelImport') ?><!--" alt="Excel Import"-->
                                    <!--         class="img-responsive">-->
                                    <!--    <div class="fileinput" data-provides="fileinput">-->
                                    <!--        <span class="btn btn-success btn-file">-->
                                    <!--                <i class="fa fa-cloud-upload fa-lg"></i> Importar-->
                                    <!--                <input type="hidden" name="Cliente[excel_import]" value="">-->
                                    <!--                <input type="file" id="Cliente[excel_import]"-->
                                    <!--                       onchange="this.form.submit()" name="Cliente[excel_import]"-->
                                    <!--                       class="form-control" multiple="" aria-invalid="false">-->
                                    <!--        </span>-->
                                    <!--    </div>-->
                                    <!--</div>-->
                                    <center>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <img src="<?php echo Utils::url() . Yii::getAlias('@ExcelDownload') ?>"
                                                 alt="Excel Download"
                                                 class="img-responsive">
                                            <?= Html::a('<i class="fa fa-cloud-download fa-lg"></i> ' . Yii::t('app',
                                                    'Exportar'),
                                                ['/cliente/execute'], ['class' => 'btn btn-success']) ?>
                                        </div>
                                    </center>
                                </center>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ln_solid"></div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
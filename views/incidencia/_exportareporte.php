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
                                    <center>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <img src="<?php echo Utils::url() . Yii::getAlias('@ExcelDownload') ?>"
                                                 alt="Excel Download"
                                                 class="img-responsive">
                                            <?= Html::a('<i class="fa fa-cloud-download fa-lg"></i> ' . Yii::t('app',
                                                    'Exportar'),
                                                ['/incidencia/executereporte'], ['class' => 'btn btn-success']) ?>
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
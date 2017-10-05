<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Cliente */

$descripcion = "Detalles del Cliente";
$this->title = 'Ticket - Detalle Cliente';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_content">
                    <div class="container-fluid">
                        <span class="section"><?php echo Html::encode($descripcion) ?></span>
                        <?= DetailView::widget([
                            'model' => $model,
                            'attributes' => [
                                'nombres',
                                'apellidos',
                                'dni',
                                'fecha_nacimiento',
                                'genero',
                                'email_personal:email',
                                'ubicacion',
                                'estado_civil',
                                'numero_celular',
                                'area',
                                'puesto',
                                'categoria',
                                'email_corp:email',
                                'numero_emergencia',
                                'fecha_ingreso',
                                'numero_oficina',
                                'anexo',
                            ],
                        ]) ?>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <center>
                                <div class="col-md-6 col-xs-12 col-md-offset-3">
                                    <?= Html::a('<i class="fa fa-floppy-o fa-lg"></i> ' . 'Actualizar',
                                        ['update', 'id' => $model->id],
                                        ['class' => 'btn btn-success']) ?>
                                    <?= Html::a('<i class="fa fa-trash-o fa-lg"></i> ' . 'Delete',
                                        ['delete', 'id' => $model->id], [
                                            'class' => 'btn btn-danger',
                                            'data' => [
                                                'confirm' => '¿Estas seguro de eliminar este cliente?',
                                                'method' => 'post',
                                            ],
                                        ]) ?>
                                </div>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

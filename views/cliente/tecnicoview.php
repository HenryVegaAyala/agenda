<?php

use app\helpers\Utils;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Cliente */

$descripcion = "Detalles del Técnico";
$this->title = 'Ticket - Detalle del Técnico';
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
                                [
                                    'attribute' => 'genero',
                                    'label' => 'Género',
                                    'value' => function ($data) {
                                        return Utils::generoGet($data->genero);
                                    },
                                ],
                                'email_personal:email',
                                'ubicacion',
                                [
                                    'attribute' => 'estado_civil',
                                    'label' => 'Estado Civil',
                                    'value' => function ($data) {
                                        return Utils::estadoCivilGet($data->estado_civil);
                                    },
                                ],
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
                                    <?= Html::a('<i class="fa fa-arrow-left fa-lg"></i> ' . 'Atras',
                                        ['listatecnico'],
                                        ['class' => 'btn btn-primary']) ?>
                                    <?= Html::a('<i class="fa fa-floppy-o fa-lg"></i> ' . 'Actualizar',
                                        ['tecnicoupdate', 'id' => $model->id],
                                        ['class' => 'btn btn-success']) ?>
                                    <?= Html::a('<i class="fa fa-trash-o fa-lg"></i> ' . 'Eliminar',
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

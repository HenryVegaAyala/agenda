<?php

/* @var $this yii\web\View */
/* @var $model app\models\Incidencia */

$this->title = 'Asignar Técnico: ' . $model->numero;
?>
<div class="right_col" role="main">
    <?= $this->render('_asignar', [
        'model' => $model,
        'cliente' => $cliente,
    ]) ?>
</div>

<?php

/* @var $this yii\web\View */
/* @var $model app\models\Incidencia */

$this->title = 'Actualizar Incidencia: ' . $model->numero;
?>
<div class="right_col" role="main">
    <?= $this->render('_update', [
        'model' => $model,
        'cliente' => $cliente,
    ]) ?>
</div>

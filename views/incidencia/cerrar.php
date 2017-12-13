<?php

/* @var $this yii\web\View */
/* @var $model app\models\Incidencia */

$this->title = 'Cerrar Incidencia: ' . $model->numero;
?>
<div class="right_col" role="main">
    <?= $this->render('_cerrar', [
        'model' => $model,
        'cliente' => $cliente,
    ]) ?>
</div>

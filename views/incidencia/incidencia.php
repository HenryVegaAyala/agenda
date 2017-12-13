<?php

/* @var $this yii\web\View */
/* @var $model app\models\Incidencia */

$this->title = 'Priorizar Incidencia: ' . $model->numero;
?>
<div class="right_col" role="main">
    <?= $this->render('_incidencia', [
        'model' => $model,
        'cliente' => $cliente,
    ]) ?>
</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Incidencia */

$this->title = 'Actualizar Incidencia: ' . $model->id;
?>
<div class="right_col" role="main">
    <?= $this->render('_update', [
        'model' => $model,
    ]) ?>
</div>

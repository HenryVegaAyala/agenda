<?php

/* @var $this yii\web\View */
/* @var $model app\models\Incidencia */

$this->title = 'Ticket - Incidencia';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="right_col" role="main">
    <?= $this->render('_form', ['model' => $model,]) ?>
</div>

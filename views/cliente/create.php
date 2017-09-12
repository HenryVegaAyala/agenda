<?php

/* @var $this yii\web\View */
/* @var $model app\models\Cliente */

$this->title = 'Ticket - Cliente';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="right_col" role="main">
    <?= $this->render('_form', ['model' => $model,]) ?>
</div>

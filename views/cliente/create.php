<?php

/* @var $this yii\web\View */
/* @var $model app\models\Cliente */

$type = Yii::$app->user->identity->type;
$this->title = ($type === 0) ? 'Sistema Ticket - Usuario Analista' : 'Sistema Ticket - Cliente';
?>
<div class="right_col" role="main">
    <?= $this->render('_form', ['model' => $model,]) ?>
</div>

<?php

/* @var $this yii\web\View */
/* @var $model app\models\Cliente */

$type = Yii::$app->user->identity->type;
$this->title = 'Sistema Ticket - Proveedor';
?>
<div class="right_col" role="main">
    <?= $this->render('_personal', ['model' => $model,]) ?>
</div>

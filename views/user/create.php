<?php


/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'SISAGE - Crear Nuevo Usuario';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="right_col" role="main">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>

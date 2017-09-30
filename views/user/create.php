<?php

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'Sistema de Ticket - Crear Nuevo Usuario';
$this->params['breadcrumbs'][] = $this->title;
?> <div class="right_col" role="main"> <?= $this->render('_form', [
        'model' => $model,
    ]) ?> </div>
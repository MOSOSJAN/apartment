<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\AuthAssignment */

$this->title = 'Create Admin';
$this->params['breadcrumbs'][] = ['label' => 'Admins', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-assignment-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

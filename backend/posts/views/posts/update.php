<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\posts\models\Posts */

$this->title =  $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="posts-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

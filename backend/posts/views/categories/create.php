<?php

use yii\helpers\Html;
use common\models\Func;

/* @var $this yii\web\View */
/* @var $model backend\posts\models\Categories */

$this->title = 'Create Categories';
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
//Func::d($cats);


?>
<div class="categories-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

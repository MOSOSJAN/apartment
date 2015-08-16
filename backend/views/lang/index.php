<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Langs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lang-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Lang', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'url:url',
            'local',
            'name',
            'default',
            // 'date_update',
            // 'date_create',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>

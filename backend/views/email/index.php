<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Emails';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="emails-index">


    <?= GridView::widget([
        'dataProvider' => $dataProvider,

        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            'email:email',
            'subject',
            //'body:ntext',
            // 'user_ip',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>

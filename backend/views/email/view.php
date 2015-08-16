<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Emails */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Emails', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="emails-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?=Html::a('Answer',['create','email' =>$model->email],[
            'class' => 'btn btn-success',
            'data' => [
                'method' => 'post',
            ]
        ])?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'email:email',
            'subject',
            'body:ntext',
            'user_ip',
            //'created_at',
            [
                'attribute' =>  'created_at',
                //'format' => 'row',
                'value' => date("d-m-Y h:i", $model->created_at),
            ],
           // 'created_at:datetime'
        ],
    ]) ?>

</div>

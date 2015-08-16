<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Event */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Events', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-view">


    <div class="box box-default">
        <div class="box-header with-border">
            <h1 class="box-title title"><?= Html::encode($this->title) ?></h1>
                <div class="box-tools pull-right">
                    <?= Html::a('<i class="fa fa-edit"></i> Edit', ['update', 'id' => $model->id], ['class' => 'btn btn-app']) ?>
                    <?= Html::a('<i class="fa fa-remove"></i> Delete', ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-app',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ]) ?>
                </div><!-- /.box-tools -->
        </div><!-- /.box-header -->
        <div class="box-body calendar-view">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'title',
                    'description:ntext',
                    'created_at',
                ],
            ]) ?>        </div><!-- /.box-body -->
    </div><!-- /.box -->


</div>

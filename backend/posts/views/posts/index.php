<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Func;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Posts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="posts-index">


    <p>
        <?= Html::a('Create Posts', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'img',
                'label' => 'Image',
                'format' => 'html',
                'value'=>function ($data) {
                    return Html::a(Html::img('@web/upload/posts/thumbs/'.$data->img,['width'=>80]),['update', 'id' => $data->id]);
                }

            ],
            [
                'attribute' => 'title',
                'format' => 'raw',
                'value'=>function ($data) {
                    return Html::a($data->title,['update', 'id' => $data->id]);
                }
            ],
            [
                'attribute' => 'description',
                'label' => 'description',
                'format' => 'html',
                'value' => function($data){
                    return Func::getExcerpt($data->description,0,500);
                }
            ],
            'created_at',
            // 'cat_id',
            // 'lang',
            // 'parrent_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>

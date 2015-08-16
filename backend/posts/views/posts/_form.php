<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Lang;
use dosamigos\tinymce\TinyMce;
use backend\posts\models\Categories;
use yii\helpers\Url;

use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model backend\posts\models\Posts */
/* @var $form yii\widgets\ActiveForm */
$langs = Lang::find()->all();


?>

<div class="posts-form">
    <?php if(!$model->isNewRecord){?>
        <ul class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true">
                Language <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                <?php foreach($langs as $one){?>
                    <li role="presentation"><?php echo  Html::a($one->name,['update','id'=> $model->parrent_id,'lang' => $one->url]);?></li>
                <?php }?>
            </ul>
        </ul>

    <?php }?>

    <?php $form = ActiveForm::begin([
        'options' => [
            'enctype' => 'multipart/form-data',
            'multiple' => true,
        ]
    ]); ?>

    <div class="row">
        <div class="col-lg-6">
            <div class="box box-success col-lg-12">
                <div class="box-body no-padding" style="display: block;">
                    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>
                </div>
            </div>

            <div class="box box-success col-lg-12">
                <div class="box-body no-padding" style="display: block;">
                    <label class="control-label">Categories</label>
                    <div class="box-body cat-box no-padding " style="display: block;">
                        <?php
                        $cats = new \backend\posts\models\CategoryTree();
                        $cats->outTree(0,0);
                        ?>
                    </div>
                </div>
            </div>
        </div>

        

        <div class="col-lg-6">
            <div class="box box-success col-lg-12">
                <div class="col-lg-12 img_div">
                    <?= $form->field($model, 'created_at')->textInput(['maxlength' => true]) ?>

                    <?php
                    echo '<label class="control-label">Add Attachments</label>';
                    if($model->isNewRecord){
                        echo FileInput::widget([
                            'model' => $model,
                            'name' => 'img',
                            'attribute' => 'img',
                        ]);
                    }else{
                        echo FileInput::widget([
                            'model' => $model,
                            'attribute' => 'img',
                            'options' => ['multiple' => true],
                            'pluginOptions' => [
                                'initialPreview'=>[
                                    Html::img("@web/upload/posts/thumbs/$model->img", ['class'=>'file-preview-image', 'alt'=>'The Moon', 'title'=>'The Moon']),
                                ],
                            ],
                        ]);
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>



    <div class="box box-success">

        <div class="box-body no-padding" style="display: block;">

                <div class="col-lg-12">
                    <?= $form->field($model, 'description')->widget(TinyMce::className(), [
                        'options' => ['rows' => 8],
                        'clientOptions' => [
                            'plugins' => [
                                "advlist autolink lists link charmap print preview anchor",
                                "searchreplace visualblocks code fullscreen",
                                "insertdatetime media table contextmenu paste"
                            ],
                            'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
                        ]
                    ]);?>
                </div>

        </div><!-- /.box-body -->
    </div>


    <div class="row">
        <div class="form-group col-lg-12">
            <?php
            echo '<label class="control-label">Add Gallery</label>';
            echo FileInput::widget([
                'model' => $model,
                'attribute' => 'images[]',
                'name' => 'images[]',
                'options'=>[
                    //'accept' => 'image/*',
                    'multiple'=>true
                ],
                'pluginOptions' => [
                ],
            ]);
            ?>
        </div>


        <?php
        $gallery = \common\models\Func::getGallery("posts/".$model->id.'/thumbs');

        if($gallery){
            //User::d($gallery);
            ?>

            <div class="form-group col-lg-12">
                <div class="box box-success collapsed-box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Show gallery</h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body row albom" style="display: none;" id="<?=$model->id?>">
                        <?php foreach($gallery as $one){ ?>
                            <div class="col-lg-2 gallery_item">
                                <a class="img_link"  href="<?=$one?>"><i class="fa fa-close"></i></a>
                                <?php  echo "<img class='file-preview-image' src='".Url::to('@web/upload/posts/'.$model->id.'/'.$one)."' >"; ?>
                            </div>


                        <?php }?>
                    </div><!-- /.box-body -->
                </div>
            </div>
        <?php }?>

        <div class="form-group col-lg-12">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

    </div>





    <?php ActiveForm::end(); ?>

</div>

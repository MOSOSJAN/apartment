<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Lang;
use dosamigos\tinymce\TinyMce;
use backend\posts\models\Categories;
use yii\helpers\Url;
use kartik\file\FileInput;

$lang = Lang::find()->all();

/* @var $this yii\web\View */
/* @var $model backend\posts\models\Categories */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="categories-form">
    <?php if(!$model->isNewRecord){?>
        <ul class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true">
                Language <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                <?php foreach($lang as $one){?>
                    <li role="presentation"><?php echo  Html::a($one->name,['update','id'=> $model->id,'lang' => $one->url]);?></li>
                <?php }?>
            </ul>
        </ul>

    <?php }?>



    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-lg-6">
            <div class="box box-success col-lg-12">
                <div class="box-body no-padding" style="display: block;">
                    <label class="control-label">Heading</label>
                    <div class="box-body cat-box no-padding " style="display: block;">
                        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
                        <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>
                        <?php  $model->title = 'new'; echo $form->field($model, 'paret_id')->dropDownList(ArrayHelper::map(Categories::find()->all(),'id','title'), ['prompt'=>'Choose...']);?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="box box-success col-lg-12">
                <div class="box-body" style="display: block;">
                    <div class="box-body cat-box no-padding " style="display: block;">
                        <?php
                        echo '<label class="control-label">Add Attachments</label>';
                        echo FileInput::widget([
                            'model' => $model,
                            'attribute' => 'img',
                            'options' => ['multiple' => true],
                            'pluginOptions' => [
                                'initialPreview'=>[
                                    Html::img("@web/upload/cats/thumbs/$model->img", ['class'=>'file-preview-image', 'alt'=>'The Moon', 'title'=>'The Moon']),
                                ],
                            ],
                        ]);
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="box box-success col-lg-12">
                <div class="box-body no-padding" style="display: block;">
                    <div class="box-body cat-box no-padding col-lg-12" style="display: block;">
                        <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
                    </div>
                </div>
            </div>
        </div>




        <div class="form-group col-lg-12">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

    </div>

    <?php ActiveForm::end(); ?>

</div>

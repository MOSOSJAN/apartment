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

//var_dump(ArrayHelper::map(Categories::find()->all(),'id','title'));
?>

<div class="categories-form">


    <?php $form = ActiveForm::begin([
        'action' => ['create'],
        'options' => [
            'enctype' => 'multipart/form-data',
            'multiple' => true,
        ]
    ]);?>

        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>
        <?php echo $form->field($model, 'paret_id')->dropDownList(ArrayHelper::map(Categories::find()->where(['lang' => 'am'])->groupBy('forlang_id')->all(),'id','title'), ['prompt'=>'Choose...']);?>

        <?php
        echo '<label class="control-label">Add Attachments</label>';
        echo FileInput::widget([
            'model' => $model,
            'name' => 'img',
            'attribute' => 'img',

        ]);
        ?>

        <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

        <div class="form-group col-lg-12">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

    </div>

    <?php ActiveForm::end(); ?>



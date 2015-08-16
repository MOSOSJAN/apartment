<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\User;
use backend\models\AuthItem;
use kartik\select2\Select2;


$users = User::find()->all();
$permissions = AuthItem::find()->where(['type' => 1])->all();

//\common\models\Func::d($users);
/* @var $this yii\web\View */
/* @var $model backend\models\AuthAssignment */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"></h3>
    </div><!-- /.box-header -->
    <div class="box-body">
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'user_id')->dropDownList(ArrayHelper::map($users,'id','name'),['prompt'=>'Select...']) ?>

        <?= $form->field($model, 'item_name')->dropDownList(ArrayHelper::map($permissions,'name','name'),['prompt'=>'Select...']) ?>
        <?= $form->field($model, 'created_at')->textInput() ?>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div><!-- /.box-body -->

</div><!-- /.box -->
<div class="auth-assignment-form">











</div>

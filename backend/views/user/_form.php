<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username') ?>
    <?= $form->field($model, 'email') ?>
    <?= $form->field($model, 'name') ?>
    <?= $form->field($model, 'lastename') ?>
    <?= $form->field($model, 'password')->passwordInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Create', ['class' =>  'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use dosamigos\tinymce\TinyMce;
?>

<?php $form = ActiveForm::begin([
    'options' => [
        'enctype' => 'multipart/form-data',
        'multiple' => true,
    ]
]); ?>
<!-- quick email widget -->
<div class="box box-info">
    <div class="box-header">
        <i class="fa fa-envelope"></i>
        <h3 class="box-title">Quick Email</h3>
        <!-- tools box -->
        <div class="pull-right box-tools">
            <button class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
        </div><!-- /. tools -->
    </div>
    <div class="box-body">
        <div class="form-group">
            <?= $form->field($model, 'subject')->textInput(['maxlength' => true]) ?>
            <input type="hidden" name="to" value="<?=$_GET['email']?>">
        </div>
        <div>
            <?= $form->field($model, 'body')->widget(TinyMce::className(), [
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
    </div>
    <div class="box-footer clearfix">
        <?= Html::submitButton('Send <i class="fa fa-arrow-circle-right"></i>', ['class' => 'pull-right btn btn-default']) ?>
    </div>
</div>

<?php ActiveForm::end();?>
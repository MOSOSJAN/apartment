<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
use common\models\Statistics;
use yii\bootstrap\Modal;
use dosamigos\tinymce\TinyMce;
use backend\models\Emails;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
$uniq = Statistics::find()->orderBy('id')->count();

$this->title = 'My Application';

$model = new Emails();
?>
<div class="site-index">
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>150</h3>
                    <p>New Orders</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div><!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>53<sup style="font-size: 20px">%</sup></h3>
                    <p>Bounce Rate</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div><!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>44</h3>
                    <p>User Registrations</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div><!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3><?=$uniq?></h3>
                    <p>Unique Visitors</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div><!-- ./col -->
    </div>

    <div class="row">


        <!-- Custom tabs (Charts with tabs)-->
        <div class="col-lg-7">

            <div class="nav-tabs-custom">
                <!-- Tabs within a box -->
                <ul class="nav nav-tabs pull-right">
                    <li class="active"><a href="#revenue-chart" data-toggle="tab">Area</a></li>
                    <li><a href="#sales-chart" data-toggle="tab">Donut</a></li>
                    <li class="pull-left header"><i class="fa fa-inbox"></i> Sales</li>
                </ul>
                <div class="tab-content no-padding">
                    <!-- Morris chart - Sales -->
                    <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;"></div>
                    <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;"></div>
                </div>
            </div><!-- /.nav-tabs-custom -->


            <div class="box box-solid bg-light-blue-gradient">
                <div class="box-header ui-sortable-handle" style="cursor: move;">
                    <!-- tools box -->
                    <div class="pull-right box-tools">
                        <button class="btn btn-primary btn-sm daterange pull-right" data-toggle="tooltip" title="Date range"><i class="fa fa-calendar"></i></button>
                        <button class="btn btn-primary btn-sm pull-right" data-widget="collapse" data-toggle="tooltip" title="Collapse" style="margin-right: 5px;"><i class="fa fa-minus"></i></button>
                    </div><!-- /. tools -->

                    <i class="fa fa-map-marker"></i>
                    <h3 class="box-title">
                        Visitors
                    </h3>
                </div>

                <div class="box-body">
                    <div id="world-map" style="height: 429px;"></div>
                </div>
            </div>

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
                <?php $form = ActiveForm::begin([
                    'action' => ['email/email'],
                    'options' => [
                        'enctype' => 'multipart/form-data',
                        'multiple' => true,
                    ]
                ]); ?>
                    <div class="box-body my-form">
                        <div class="form-group">
                            <?= $form->field($model, 'subject')->textInput(['maxlength' => true,'placeholder' => "Subject"])->label('') ?>
                            <?= $form->field($model, 'email')->textInput(['maxlength' => true,'placeholder' => "Email"])->label('') ?>
                        </div>
                        <div>
                            <?= $form->field($model, 'body')->widget(TinyMce::className(), [
                                'options' => ['rows' => 8,'placeholder' => "Text"],
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
                <?php ActiveForm::end();?>
            </div>

        </div>


        <div class="col-lg-5">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Browser Usage</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div id="donut-example"></div>
                        </div><!-- /.col -->
                        <div class="col-md-4">
                            <ul class="chart-legend clearfix">
                                <li><i class="fa fa-circle-o text-red"></i> Chrome</li>
                                <li><i class="fa fa-circle-o text-green"></i> IE</li>
                                <li><i class="fa fa-circle-o text-yellow"></i> FireFox</li>
                                <li><i class="fa fa-circle-o text-aqua"></i> Safari</li>
                                <li><i class="fa fa-circle-o text-light-blue"></i> Opera</li>
                            </ul>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.box-body -->

            </div>



            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Bar Chart</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body chart-responsive">
                    <div id="bar-example"></div>
                </div><!-- /.box-body -->
            </div>


            <div class="box box-solid bg-green-gradient">
                <div class="box-header ui-sortable-handle" style="cursor: move;">
                    <i class="fa fa-calendar"></i>
                    <h3 class="box-title">Calendar</h3>
                    <!-- tools box -->
                    <div class="pull-right box-tools">
                        <!-- button with a dropdown -->
                        <div class="btn-group">
                            <button class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i></button>
                            <ul class="dropdown-menu pull-right" role="menu">
                                <li><a href="#" class="add_new">Add new event</a></li>
                                <li><a href="#">Clear events</a></li>
                                <li class="divider"></li>
                                <li><a href="#">View calendar</a></li>
                            </ul>
                        </div>
                        <button class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div><!-- /. tools -->
                </div><!-- /.box-header -->

                <?php
                    Modal::begin([
                        'id' => 'modal',
                        'size' => 'modal-lg',
                    ]);

                    echo "<div id='modalContent'></div>";

                    Modal::end();
                ?>

                <?php
                Modal::begin([
                    'id' => 'modalView',
                    'size' => 'modal-lg',
                ]);

                echo "<div id='modalContent1'></div>";

                Modal::end();
                ?>
                <div class="box-body no-padding">
                     <?= \yii2fullcalendar\yii2fullcalendar::widget(array(
                        'events'=> $events,
                         'options' =>[
                             'lang' => 'en',
                         ]
                    ));?>
                </div><!-- /.box-body -->
                <div class="box-footer text-black">

                </div>
            </div>
        </div>

    </div>


</div>




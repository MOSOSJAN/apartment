<?php
use backend\posts\controllers\CategoriesController;

?>

<div class="row">
    <div class="col-lg-6">
        <div class="box box-primary col-lg-12">
            <h3 class="box-title col-lg-12">Create Category</h3>

                <?= $this->render('_create', [
                    'model' => $model,
                ]) ?>

        </div>
    </div>


    <div class="col-lg-6">
        <div class="box box-primary row">
            <h3 class="box-title col-lg-12">All Categories</h3>
            <ul class="todo-list ui-sortable col-lg-12">
                <?php CategoriesController::outTree(0,0); ?>
            </ul>
        </div>
    </div>
</div>


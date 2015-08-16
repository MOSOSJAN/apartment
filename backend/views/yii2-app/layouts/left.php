<?php
use yii\bootstrap\Nav;

?>
<aside class="main-sidebar">

    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?= @Yii::$app->user->identity->name ?> <?= @Yii::$app->user->identity->lastename ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <?=
        Nav::widget(
            [
                'encodeLabels' => false,
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    '<li class="header">Menu Yii2</li>',
                    ['label' => '<i class="fa fa-file-code-o"></i><span>Gii</span>', 'url' => ['/gii'],'visible' =>Yii::$app->user->can('sooperadmin')],
                    ['label' => '<i class="fa fa-dashboard"></i><span>Debug</span>', 'url' => ['/debug'],'visible' =>Yii::$app->user->can('sooperadmin')],
                    [
                        'label' => '<i class="glyphicon glyphicon-lock"></i><span>Sing in</span>', //for basic
                        'url' => ['/site/login'],
                        'visible' =>Yii::$app->user->isGuest
                    ],
                ],
            ]
        );
        ?>



<?php if(Yii::$app->user->can('create-post')){?>
        <ul class="sidebar-menu">
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-edit"></i> <span>Posts</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <?=
                    Nav::widget(
                        [
                            'encodeLabels' => false,
                            'options' => ['class' => ''],
                            'items' => [
                                ['label' => '<i class="fa fa-circle-o"></i> All Posts', 'url' => ['/posts/posts']],
                                ['label' => '<i class="fa fa-circle-o"></i> New Post', 'url' => ['/posts/posts/create']],
                                ['label' => '<i class="fa fa-circle-o"></i> Categories', 'url' => ['/posts/categories/categories']],
                            ],
                        ]
                    );
                    ?>
                </ul>
            </li>
        </ul>
<?php }?>

<?php if(Yii::$app->user->can('admin')){?>
        <ul class="sidebar-menu">
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-book"></i> <span>Settings</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <?=
                    Nav::widget(
                        [
                            'encodeLabels' => false,
                            'options' => ['class' => ''],
                            'items' => [
                                ['label' => '<i class="fa fa-circle-o"></i> Languages', 'url' => ['/lang/index']],
                            ],
                        ]
                    );
                    ?>
                </ul>
            </li>
        </ul>
<?php }?>



<?php if(Yii::$app->user->can('admin')){?>
    <ul class="sidebar-menu">
        <li class="treeview">
            <a href="#">
                <i class="fa fa-user"></i> <span>Admins</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <?=
                Nav::widget(
                    [
                        'encodeLabels' => false,
                        'options' => ['class' => ''],
                        'items' => [
                            ['label' => '<i class="fa fa-circle-o"></i> Permissions', 'url' => ['/admins/index']],
                            ['label' => '<i class="fa fa-circle-o"></i> All Users', 'url' => ['/user/index']],
                            ['label' => '<i class="fa fa-circle-o"></i> Create User', 'url' => ['/user/create']],
                        ],
                    ]
                );
                ?>
            </ul>
        </li>
    </ul>
<?php }?>


    </section>

</aside>

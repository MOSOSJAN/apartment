<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/style.css',
        'js/plugins/font-awesome/css/font-awesome.css',
        'js/plugins/select2/dist/css/select2.min.css',
    ];
    public $js = [
		'js/app.js',
        'js/controllers/HomeCtrl.js',
        'js/plugins/select2/dist/js/select2.full.min.js',
        'js/scripts/main.js',
    ];
    public $depends = [
		'frontend\assets\AngularAsset',
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}

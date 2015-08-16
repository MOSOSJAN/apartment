<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\assets;

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
        'js/morris/morris.css',
        'js/jvectormap/jquery-jvectormap-1.2.2.css',
    ];
    public $js = [
        'js/morris/morris.min.js',
        'js/main.js',
        'js/jvectormap/jquery-jvectormap-1.2.2.min.js',
        'js/jvectormap/jquery-jvectormap-world-mill-en.js',
        'http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}

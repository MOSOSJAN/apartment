<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => true,
            'class'=>'frontend\components\LangUrlManager',
            'rules'=>[
                /*'/' => 'site/index',
                '<controller:\w+>/<action:\w+>/'=>'<controller>/<action>',*/

                [
                    'pattern' => '<controller>/<action>/<id:\d+>/<s:[a-zA-Z0-9_-]{1,100}+>',
                    'route' => '<controller>/<action>',
                    'suffix' =>'',
                ],
                [
                    'pattern' => '<controller>/<action>/<id:\d+>',
                    'route' => '<controller>/<action>',
                    'suffix' =>'',
                ],

                [
                    'pattern' => '<controller>/<action>',
                    'route' => '<controller>/<action>',
                    'suffix' =>'',
                ],
                [
                    'pattern' => '/',
                    'route' => '/',
                    'suffix' =>'',
                ],
            ],

        ],
        'request' => [
            'cookieValidationKey' => 'sdi8s#fnj98jwiqiw;qfh!fjgh0d8f',
            'class' => 'frontend\components\LangRequest',
            'baseUrl' => '',
        ],
        'assetManager' => [
            'basePath' => '@webroot/assets',
            'baseUrl' => '@web/assets'
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'language'=>'ru-RU',
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@frontend/messages',
                    'sourceLanguage' => 'en',
                    'fileMap' => [
                        //'main' => 'main.php',
                    ],
                ],
            ],
        ],
    ],
    'params' => $params,
];

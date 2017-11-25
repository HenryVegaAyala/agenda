<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'assetsAutoCompress'],
    //'bootstrap' => ['log'],
    'sourceLanguage' => 'es',
    'language' => 'es',
    'timeZone' => 'America/Lima',
    'modules' => [
        'gridview' => [
            'class' => 'kartik\grid\Module',
        ],

        'dynamicrelations' => [
            'class' => '\synatree\dynamicrelations\Module',
        ],

        'datecontrol' => [
            'class' => 'kartik\datecontrol\Module',

            'displaySettings' => [
                'date' => 'd-m-Y',
                'time' => 'H:i:s A',
                'datetime' => 'd-m-Y H:i:s A',
            ],

            'saveSettings' => [
                'date' => 'd-m-Y',
                'time' => 'H:i:s',
                'datetime' => 'd-m-Y H:i:s A',
            ],

            'autoWidget' => true,

        ],
    ],
    'components' => [
        'assetManager' => [
            'linkAssets' => true,
            'appendTimestamp' => true,
            'converter' => [
                'class' => 'yii\web\AssetConverter',
                'commands' => [
                    'less' => ['css', 'lessc {from} {to} --no-color'],
                    'ts' => ['js', 'tsc --out {to} {from}'],
                ],
            ],
        ],
        'session' => [
            'class' => 'yii\web\DbSession',
            'sessionTable' => 'session',
        ],
        'assetsAutoCompress' =>
            [
                'class' => '\skeeks\yii2\assetsAuto\AssetsAutoCompressComponent',
                'enabled' => true,
                'readFileTimeout' => 3,
                'jsCompress' => true,
                'jsCompressFlaggedComments' => true,
                'cssCompress' => true,
                'cssFileCompile' => true,
                'cssFileRemouteCompile' => false,
                'cssFileCompress' => true,
                'cssFileBottom' => false,
                'cssFileBottomLoadOnJs' => false,
                'jsFileCompile' => true,
                'jsFileRemouteCompile' => false,
                'jsFileCompress' => true,
                'jsFileCompressFlaggedComments' => true,
                'htmlCompress' => true,
                'noIncludeJsFilesOnPjax' => true,
                'htmlCompressOptions' =>
                    [
                        'extra' => false,
                        'no-comments' => true,
                    ],
            ],
        'request' => [
            'baseUrl' => str_replace('/web', '', (new \yii\web\Request)->getBaseUrl()),
            'cookieValidationKey' => 'MfUsCsKe7ESAiH25TzeolSVxyAiIyCIV',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'defaultTimeZone' => 'UTC',
            'timeZone' => 'America/Lima',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => false,
            'enableSession' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'categories' => ['process'],
                    'logFile' => '@app/runtime/logs/process.log',
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),

        'urlManager' => [
            //'class' => 'yii\web\UrlManager',
            //'baseUrl' => '/',
            //'enablePrettyUrl' => true,
            //'showScriptName' => false,
            //'enableStrictParsing' => true,
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            'rules' => [

                /**Sesion**/
                '/login' => 'site/login',
                '/logout/<id:\d+>' => '/site/logout',

                /**home**/
                '/' => 'site/index',

                /**Cliente**/
                '/cliente-nuevo' => '/cliente/create',
                '/lista-cliente' => '/cliente/index',
                '/importar-cliente' => '/cliente/import',
                '/exportar-cliente' => '/cliente/export',
                '/actualizar-cliente/<id:\d+>' => '/cliente/update',
                '/ver-cliente/<id:\d+>' => '/cliente/view',
                '/eliminar-cliente/<id:\d+>' => '/cliente/delete',

                /**Usuario**/
                '/nuevo-usuario' => '/user/create',
                '/lista-usuario' => '/user/index',
                '/actualizar-usuario/<id:\d+>' => '/user/update',
                '/exportar-analistas' => '/user/export',
                '/inactivar/<id:\d+>' => '/user/status',
                '/eliminar-usuario/<id:\d+>' => '/user/delete',
                '/mi-cuenta/<id:\d+>' => '/user/change',

                /**Indicencia**/
                '/nueva-incidencia' => '/incidencia/create',
                '/lista-incidencia' => '/incidencia/index',
                '/actualizar-incidencia/<id:\d+>' => '/incidencia/update',
                '/eliminar-incidencia/<id:\d+>' => '/incidencia/delete',

                ///**Sesion**/
                //['pattern' => '/login', 'route' => '/site/login', 'suffix' => '.php'],
                //['pattern' => '/logout/<id:\d+>', 'route' => '/site/logout'],
                //
                ///**home**/
                //['pattern' => '/', 'route' => '/site/index', 'suffix' => ''],
                //
                ///**Usuario**/
                //['pattern' => '/nuevo-usuario', 'route' => '/user/create', 'suffix' => '.php'],
                //['pattern' => '/lista-usuario', 'route' => '/user/index', 'suffix' => '.php'],
                //['pattern' => '/actualizar-usuario/<id:\d+>', 'route' => '/user/update'],
                //['pattern' => '/exportar-analistas', 'route' => '/user/export'],
                //['pattern' => '/inactivar/<id:\d+>', 'route' => '/user/status'],
                //['pattern' => '/eliminar-usuario/<id:\d+>', 'route' => '/user/delete'],
                //['pattern' => '/actualizar/datos/<id:\d+>', 'route' => '/user/change'],
                //
                ///**Indicencia**/
                //['pattern' => '/nueva-incidencia', 'route' => '/incidencia/create', 'suffix' => '.php'],
                //['pattern' => '/lista-incidencia', 'route' => '/incidencia/index', 'suffix' => '.php'],
                //['pattern' => '/actualizar-incidencia/<id:\d+>', 'route' => '/incidencia/update'],
                //['pattern' => '/eliminar-incidencia/<id:\d+>', 'route' => '/incidencia/delete'],
                //
                ///**Cliente**/
                //['pattern' => '/nuevo-cliente', 'route' => '/cliente/create', 'suffix' => '.php'],
                //['pattern' => '/lista-cliente', 'route' => '/cliente/index', 'suffix' => '.php'],
                //['pattern' => '/importar-cliente', 'route' => '/cliente/import', 'suffix' => '.php'],
                //['pattern' => '/exportar-cliente', 'route' => '/cliente/export', 'suffix' => '.php'],
                //['pattern' => '/actualizar-cliente/<id:\d+>', 'route' => '/cliente/update'],
                //['pattern' => '/ver-cliente/<id:\d+>', 'route' => '/cliente/view'],
                //['pattern' => '/eliminar-cliente/<id:\d+>', 'route' => '/cliente/delete'],
            ],
        ],

    ],
    'as beforeRequest' => [
        'class' => 'yii\filters\AccessControl',
        'rules' => [
            [
                'allow' => true,
                'actions' => ['login', 'forgot'],
            ],
            [
                'allow' => true,
                'roles' => ['@'],
            ],
        ],
        'denyCallback' => function () {
            return Yii::$app->response->redirect(['site/login']);
        },
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'generators' => [
            'kartikgii-crud' => ['class' => 'warrence\kartikgii\crud\Generator'],
        ],
    ];
}

return $config;

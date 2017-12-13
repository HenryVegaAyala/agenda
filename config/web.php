<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log','assetsAutoCompress'],
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
            //'linkAssets' => true,
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
                '/lista-incidencia-priorizar' => '/incidencia/lista',
                '/lista-asignar-tecnico' => '/incidencia/tecnico',
                '/actualizar-incidencia/<id:\d+>' => '/incidencia/update',
                '/asignar-incidencia/<id:\d+>' => '/incidencia/asignar',
                '/eliminar-incidencia/<id:\d+>' => '/incidencia/delete',

                /**Proveedor**/
                '/nuevo-proveedor' => '/cliente/personal',
                '/actualizar-proveedor/<id:\d+>' => '/cliente/personalu',
                '/lista-proveedor' => '/cliente/index',
                '/ver-proveedor/<id:\d+>' => '/cliente/personalview',
                '/exportar-proveedor' => '/cliente/proveedor',

                /**tecnico**/
                '/nuevo-tecnico' => '/cliente/tecnico',
                '/actualizar-tecnico/<id:\d+>' => '/cliente/tecnicoupdate',
                '/lista-tecnico' => '/cliente/listatecnico',
                '/ver-tecnico/<id:\d+>' => '/cliente/tecnicoview',
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

<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
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
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            'rules' => [
                /**Sesion**/
                ['pattern' => '/login', 'route' => '/site/login', 'suffix' => '.php'],

                /**home**/
                ['pattern' => '/', 'route' => '/site/index', 'suffix' => ''],

                /**Usuario**/
                ['pattern' => '/nuevo-usuario', 'route' => '/user/create', 'suffix' => '.php'],
                ['pattern' => '/lista-usuario', 'route' => '/user/index', 'suffix' => '.php'],
                ['pattern' => '/actualizar-usuario/<id:\d+>', 'route' => '/user/update'],
                ['pattern' => '/eliminar-usuario/<id:\d+>', 'route' => '/user/delete'],
                ['pattern' => '/actualizar/datos/<id:\d+>', 'route' => '/user/change'],
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

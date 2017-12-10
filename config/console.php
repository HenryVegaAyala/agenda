<?php

$params = require(__DIR__ . '/params.php');
$db = require(__DIR__ . '/db.php');

$config = [
    'id' => 'basic-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log','assetsAutoCompress'],
    'controllerNamespace' => 'app\commands',
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
        'assetsAutoCompress' =>
            [
                'class'                         => '\skeeks\yii2\assetsAuto\AssetsAutoCompressComponent',
                'enabled'                       => true,
                'readFileTimeout'               => 3,
                'jsCompress'                    => true,
                'jsCompressFlaggedComments'     => true,
                'cssCompress'                   => true,
                'cssFileCompile'                => true,
                'cssFileRemouteCompile'         => false,
                'cssFileCompress'               => true,
                'cssFileBottom'                 => false,
                'cssFileBottomLoadOnJs'         => false,
                'jsFileCompile'                 => true,
                'jsFileRemouteCompile'          => false,
                'jsFileCompress'                => true,
                'jsFileCompressFlaggedComments' => true,
                'htmlCompress'                  => true,
                'noIncludeJsFilesOnPjax'        => true,
                'htmlCompressOptions'           =>
                    [
                        'extra' => false,
                        'no-comments' => true
                    ],
            ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'log' => [
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
        'db' => $db,
    ],
    'params' => $params,

    'controllerMap' => [
        'clean-vendors' => [
            'class' => 'mbrowniebytes\yii2cleanvendors\CleanVendorsController',
        ],
        'fixture' => [
            'class' => 'yii\faker\FixtureController',
        ],
        'migrate' => [
            'class' => yii\console\controllers\MigrateController::class,
            'templateFile' => '@jamband/schemadump/template.php',
        ],
        'schemadump' => [
            'class' => jamband\schemadump\SchemaDumpController::class,
            'db' => [
                'class' => yii\db\Connection::class,
                'dsn' => 'mysql:host=localhost;dbname=sis_agenda',
                'username' => 'root',
                'password' => '',
            ],
        ],
    ],

];

if (YII_ENV_DEV) {
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;

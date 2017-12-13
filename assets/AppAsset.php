<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

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
        'repository/bootstrap/dist/css/bootstrap.min.css',
        'repository/font-awesome/css/font-awesome.min.css',
        'css/custom.scss',
    ];
    public $js = [
        'js/agenda.min.js',
        'repository/bootstrap/dist/js/bootstrap.min.js',
        'js/custom.min.js',
        'vendor/tinymce/tinymce/tinymce.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}

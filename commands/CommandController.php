<?php

namespace app\commands;

use Yii;
use yii\console\Controller;

class CommandController extends Controller
{

    public static function actionIndex($message = 'hello world')
    {
        Yii::error("information");
        echo $message . "\n";
    }

}
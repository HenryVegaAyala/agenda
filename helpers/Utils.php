<?php

namespace app\helpers;


use Yii;
use yii\db\Expression;
use yii\db\Query;

class Utils
{
    /**
     * @return false|string
     */
    public static function zonaHoraria()
    {
        date_default_timezone_set('America/Lima');

        return date('Y-m-d h:i:s', time());
    }

    /**
     * @param $table
     * @return false|null|string
     */
    public static function idTable($table)
    {
        $query = new Query();
        $sentence = new Expression('IFNULL(MAX(id), 0) + 1');
        $query->select($sentence)->from($table);

        return $query->createCommand()->queryScalar();
    }

    public static function fileReporte()
    {
        $reporte = Yii::getAlias('@PathReporteDownload');
        if (!file_exists($reporte)) {
            mkdir($reporte, 0777, true);
        }
    }

    /**
     * @param $path
     * @param null $speed
     * @return bool
     */
    public static function Download($path, $speed = null)
    {
        if (is_file($path) === true) {
            $file = @fopen($path, 'rb');
            $speed = (isset($speed) === true) ? round($speed * 1024) : 524288;
            if (is_resource($file) === true) {
                set_time_limit(0);
                ignore_user_abort(false);
                while (ob_get_level() > 0) {
                    ob_end_clean();
                }
                header('Expires: 0');
                header('Pragma: public');
                header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
                header('Content-Type: application/octet-stream');
                header('Content-Length: ' . sprintf('%u', filesize($path)));
                header('Content-Disposition: attachment; filename="' . basename($path) . '"');
                header('Content-Transfer-Encoding: binary');
                while (feof($file) !== true) {
                    echo fread($file, $speed);
                    while (ob_get_level() > 0) {
                        ob_end_flush();
                    }
                    flush();
                    sleep(1);
                }
                fclose($file);
            }
            exit();
        }
        return false;
    }
}
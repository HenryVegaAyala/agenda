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

    /**
     * @param $dir
     * @param $file
     * @return bool
     */
    public static function downloadFile($dir, $file)
    {
        if (is_dir($dir)) {
            $path = $dir . '/' . $file;
            if (is_file($path)) {
                $size = filesize($path);
                header("Content-Type: application/force-download");
                header("Content-Disposition: attachment; filename=$file");
                header("Content-Transfer-Encoding: binary");
                header("Content-Length: " . $size);
                readfile($path);

                return true;
            }
        }

        return false;
    }

    public static function fileReporte()
    {
        $reporte = Yii::getAlias('@PathReporteDownload');
        if (!file_exists($reporte)) {
            mkdir($reporte, 0777, true);
        }
    }


    /**
     * @return array
     */
    public static function status()
    {
        return [
            '1' => 'Activo',
            '0' => 'Inactivo',
        ];
    }

    /**
     * @return array
     */
    public static function genero()
    {
        return [
            'M' => 'Masculino',
            'F' => 'Femenino',
        ];
    }

    /**
     * @return array
     */
    public static function rol()
    {
        return [
            'G' => 'Administrador',
            'S' => 'Secretaria',
        ];
    }

    /**
     * @param $value
     * @return string
     */
    public static function getRol($value)
    {
        if ($value === 'G') {
            return 'Administrador';
        } else {
            return 'Secretaria';
        }
    }

    /**
     * @param $status
     * @return string
     */
    public static function getStatus($status)
    {
        if ($status === 1) {
            return 'Activo';
        } else {
            return 'Inactivo';
        }
    }
}
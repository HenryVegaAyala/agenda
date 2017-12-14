<?php

namespace app\helpers;

use app\models\Cliente;
use app\models\Empresa;
use Yii;
use yii\db\Expression;
use yii\db\Query;
use yii\helpers\Url;

class Utils
{
    const  HTTPS = 'https://';
    const  HTTP = 'http://';

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
     * @throws \yii\db\Exception
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
        } else {
            return false;
        }

    }

    public static function fileReporte()
    {
        $reporte = Yii::getAlias('@PathReporteDownload');
        $imagen = Yii::getAlias('@PathImagenColaboradores');
        $excel = Yii::getAlias('@PathExcelImport');
        if (!file_exists($reporte)) {
            mkdir($reporte, 0777, true);
        }

        if (!file_exists($imagen)) {
            mkdir($imagen, 0777, true);
        }

        if (!file_exists($excel)) {
            mkdir($excel, 0777, true);
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
    public static function typeUser()
    {
        if (Yii::$app->user->identity->type === 0) {
            $data = [
                '2' => 'Analista',
            ];
        } else {
            $data = [
                '0' => 'Administrador',
                '2' => 'Analista',
            ];
        }

        return $data;
    }

    /**
     * @return array
     */
    public static function typeUserOption()
    {
        if (Yii::$app->user->identity->type === 0) {
            $data = [
                '2' => 'Analista',
            ];
        } else {
            $data = [
                '0' => 'Administrador',
                '1' => 'Colaborador',
                '2' => 'Analista',
            ];
        }

        return $data;
    }

    /**
     * @param $status
     * @return string
     */
    public static function getTypeUser($status)
    {
        $value = '';
        switch ($status) {
            case 0:
                $value = 'Administrador';
                break;
            case 1:
                $value = 'Colaborador';
                break;
            case 2:
                $value = 'Analista';
                break;
            default;
        }

        return $value;
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
     * @param $genero
     * @return string
     */
    public static function generoGet($genero)
    {
        return ($genero === 'M') ? 'Masculino' : 'Femenino';
    }

    /**
     * @param $genero
     * @return string
     */
    public static function generoSet($genero)
    {
        return (strtolower($genero) === 'masculino') ? 'M' : 'F';
    }

    /**
     * @return array
     */
    public static function estadoCivil()
    {
        return [
            'SO' => 'Soltero',
            'CA' => 'Casado',
            'CO' => 'Comprometido',
            'VI' => 'Viudo',
        ];
    }

    /**
     * @param $estado
     * @return string
     */
    public static function estadoCivilGet($estado)
    {
        switch ($estado) {
            case 'SO':
                $estado_civil = 'Soltero';
                break;
            case 'CA':
                $estado_civil = 'Casado';
                break;
            case 'CO':
                $estado_civil = 'Comprometido';
                break;
            case 'VI':
                $estado_civil = 'Viudo';
                break;
            default :
                $estado_civil = 'N.A.';
        }

        return $estado_civil;
    }

    /**
     * @param $date
     * @return false|string
     */
    public static function formatDate($date)
    {
        return date('Y-m-d', strtotime($date));
    }

    /**
     * @param $estado
     * @return string
     */
    public static function estadoCivilSet($estado)
    {
        switch (strtolower($estado)) {
            case 'soltero':
                $estado_civil = 'SO';
                break;
            case 'casado':
                $estado_civil = 'CA';
                break;
            case 'comprometido':
                $estado_civil = 'CO';
                break;
            case 'viudo':
                $estado_civil = 'VI';
                break;
            default :
                $estado_civil = 'SO';
        }

        return $estado_civil;
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

    /**
     * @param $idCliente
     * @return string
     * @throws \yii\base\InvalidParamException
     */
    public static function imagenCliente($idCliente): string
    {
        return Url::to(Yii::getAlias('@LogoDefault'), '');
    }

    /**
     * @param $id
     * @return Empresa
     */
    public static function empresaName($id)
    {
        $empresa = Empresa::find()->select('nombre')->where(['id' => $id])->one();

        return $empresa['nombre'];
    }

    public static function url(): string
    {
        if ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] === 443) {
            $protocol = self::HTTPS;
        } else {
            $protocol = self::HTTP;
        }

        return $protocol . $_SERVER['HTTP_HOST'] . '/';
    }

    /**
     * @return mixed
     */
    public static function getRealIpAddr()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {   //check ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {   //to check ip is pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        return $ip;
    }

    /**
     * @return false|null|string
     * @throws \yii\db\Exception
     */
    public static function numeroTicket()
    {
        $query = new Query();
        $sentence = new Expression('IFNULL(COUNT(numero), 0) + 1');
        $query->select($sentence)->from('incidencia');

        return $query->createCommand()->queryScalar();
    }
}

<?php

namespace app\helpers;


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

}
<?php

namespace app\helpers;

use Yii;

class Notificaciones
{
    const SUCCESS = 'success';

    /**
     * @param $estado
     * @param $usuario
     */
    public static function notificacionUsuario($estado, $usuario)
    {
        switch ($estado) {
            case 1:
                $title = 'Se registró un Usuario Nuevo';
                $message = 'Se ha registrado satisfactoriamente a ' . $usuario . ' como nuevo usuario.';
                $type = self::SUCCESS;
                break;
            case 2:
                $title = 'El Usuario fué Actualizado';
                $message = 'Se ha actualizado satisfactoriamente el usuario ' . $usuario . '.';
                $type = self::SUCCESS;
                break;
            case 3:
                $title = 'Se Eliminado un Usuario';
                $message = 'Se ha eliminado satisfactoriamente al usuario ' . $usuario . '.';
                $type = self::SUCCESS;
                break;
            case 4:
                $title = 'Se Actualizado el Perfil de ' . $usuario;
                $message = 'Se ha actualizado satisfactoriamente los datos del perfil.';
                $type = self::SUCCESS;
                break;
            default :
                break;
        }

        return Yii::$app->getSession()->setFlash(self::SUCCESS, [
            'type' => $type,
            'duration' => 6000,
            'icon' => 'fa fa-users',
            'message' => $message,
            'title' => $title,
            'positonY' => 'top',
            'positonX' => 'right',
        ]);
    }

    /**
     * @param $title
     * @param $message
     */
    public static function notificationUsuarioError($title, $message)
    {
        return Yii::$app->getSession()->setFlash(self::SUCCESS, [
            'type' => 'danger',
            'duration' => 6000,
            'icon' => 'fa fa-ban',
            'message' => $message,
            'title' => $title,
            'positonY' => 'top',
            'positonX' => 'right',
        ]);
    }

}
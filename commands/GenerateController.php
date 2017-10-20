<?php

namespace app\commands;

use app\helpers\Utils;
use app\models\Cliente;
use Faker\Factory;
use Yii;
use yii\console\Controller;

class GenerateController extends Controller
{
    public static function actionCliente($empresa)
    {
        Utils::fileReporte();
        $data = [];
        $faker = Factory::create('es_ES');
        for ($i = 0; $i < 100; $i++) {
            array_push($data, [
                $empresa,
                $faker->name,
                $faker->lastName . ' ' . $faker->lastName,
                $faker->dni,
                date('Y-m-d', strtotime(rand(1920, 1998) . '-' . rand(1, 12) . '-' . rand(1, 29))),
                $faker->randomElement(['M', 'F']),
                $faker->email,
                $faker->city,
                $faker->randomElement(['SO', 'CA', 'CO', 'VI']),
                $faker->phoneNumber,
                $faker->randomElement(['Administración', 'Sistemas', 'Logistica']),
                $faker->randomElement(['Asistente', 'Senior', 'Semi-Senior']),
                $faker->randomElement(['Planilla', 'Practicante', 'Gerente']),
                $faker->email,
                $faker->phoneNumber,
                date('Y-m-d', strtotime(rand(2000, 2017) . '-' . rand(1, 12) . '-' . rand(1, 29))),
                $faker->phoneNumber,
                $faker->postcode,
                true,

            ]);
        }
        Yii::$app->db->createCommand()->batchInsert(
            'cliente',
            [
                'empresa_id',
                'nombres',
                'apellidos',
                'dni',
                'fecha_nacimiento',
                'genero',
                'email_corp',
                'ubicacion',
                'estado_civil',
                'numero_celular',
                'area',
                'puesto',
                'categoria',
                'email_personal',
                'numero_emergencia',
                'fecha_ingreso',
                'numero_oficina',
                'anexo',
                'estado',

            ],
            $data
        )->execute();
    }

    public static function actionUsuario()
    {
        Utils::fileReporte();

        $data = [];
        $clientes = Cliente::find()->select([
            'id',
            'nombres',
            'apellidos',
            'dni',
            'email_corp',
            'empresa_id',
        ])->where('estado = :estado',
            [':estado' => 1])->all();

        foreach ($clientes as $cliente) {
            array_push($data, [
                $cliente['id'],
                $cliente['empresa_id'],
                $cliente['nombres'] . ' ' . $cliente['apellidos'],
                $cliente['email_corp'],
                (string)Yii::$app->getSecurity()->generatePasswordHash($cliente['dni']),
                1,
                1,
                1,
                3,
            ]);
        }

        Yii::$app->db->createCommand()->batchInsert(
            'usuario',
            [
                'cliente_id',
                'empresa_id',
                'nombres',
                'correo',
                'contrasena',
                'authKey',
                'accessToken',
                'estado',
                'type',
            ],
            $data
        )->execute();
    }

    public static function actionEmpresa()
    {
        Yii::$app->db->createCommand()->insert('empresa',
            ['nombre' => 'Vega', 'ruc' => '000000000000', 'estado' => 1]
        )->execute();

        Yii::$app->db->createCommand()->insert('empresa',
            ['nombre' => 'Mapfre', 'ruc' => '000000000000', 'estado' => 1]
        )->execute();

        Yii::$app->db->createCommand()->insert('empresa',
            ['nombre' => 'Habitat', 'ruc' => '000000000000', 'estado' => 1]
        )->execute();

        Yii::$app->db->createCommand()->insert('empresa',
            ['nombre' => 'Franquicia', 'ruc' => '000000000000', 'estado' => 1]
        )->execute();

        Yii::$app->db->createCommand()->insert('empresa',
            ['nombre' => 'Clínica Ricardo Palma', 'ruc' => '000000000000', 'estado' => 1]
        )->execute();
    }

    public static function actionPiloto()
    {
        /** Vega **/
        Yii::$app->db->createCommand()->insert(
            'usuario',
            [
                'nombres' => 'Analista de Requerimientos',
                'correo' => 'sadmin@vega.com',
                'cliente_id' => 0,
                'empresa_id' => 1,
                'contrasena' => (string)Yii::$app->getSecurity()->generatePasswordHash('000000'),
                'estado' => 1,
                'authKey' => 1,
                'accessToken' => 1,
                'type' => 0,
            ]
        )->execute();
        Yii::$app->db->createCommand()->insert(
            'usuario',
            [
                'nombres' => 'Coordinador',
                'correo' => 'admin@vega.com',
                'cliente_id' => 0,
                'empresa_id' => 1,
                'contrasena' => (string)Yii::$app->getSecurity()->generatePasswordHash('000000'),
                'estado' => 1,
                'authKey' => 1,
                'accessToken' => 1,
                'type' => 1,
            ]
        )->execute();
        /** Mapfre **/
        Yii::$app->db->createCommand()->insert(
            'usuario',
            [
                'nombres' => 'Analista de Requerimientos',
                'correo' => 'sadmin@mapfre.com',
                'cliente_id' => 0,
                'empresa_id' => 2,
                'contrasena' => (string)Yii::$app->getSecurity()->generatePasswordHash('000000'),
                'estado' => 1,
                'authKey' => 1,
                'accessToken' => 1,
                'type' => 0,
            ]
        )->execute();
        Yii::$app->db->createCommand()->insert(
            'usuario',
            [
                'nombres' => 'Coordinador',
                'correo' => 'admin@mapfre.com',
                'cliente_id' => 0,
                'empresa_id' => 2,
                'contrasena' => (string)Yii::$app->getSecurity()->generatePasswordHash('000000'),
                'estado' => 1,
                'authKey' => 1,
                'accessToken' => 1,
                'type' => 1,
            ]
        )->execute();
        /** Habitat **/
        Yii::$app->db->createCommand()->insert(
            'usuario',
            [
                'nombres' => 'Analista de Requerimientos',
                'correo' => 'sadmin@habitat.com',
                'cliente_id' => 0,
                'empresa_id' => 3,
                'contrasena' => (string)Yii::$app->getSecurity()->generatePasswordHash('000000'),
                'estado' => 1,
                'authKey' => 1,
                'accessToken' => 1,
                'type' => 0,
            ]
        )->execute();
        Yii::$app->db->createCommand()->insert(
            'usuario',
            [
                'nombres' => 'Coordinador',
                'correo' => 'admin@habitat.com',
                'cliente_id' => 0,
                'empresa_id' => 3,
                'contrasena' => (string)Yii::$app->getSecurity()->generatePasswordHash('000000'),
                'estado' => 1,
                'authKey' => 1,
                'accessToken' => 1,
                'type' => 1,
            ]
        )->execute();
        /** Franquicia **/
        Yii::$app->db->createCommand()->insert(
            'usuario',
            [
                'nombres' => 'Analista de Requerimientos',
                'correo' => 'sadmin@franquicia.com',
                'cliente_id' => 0,
                'empresa_id' => 4,
                'contrasena' => (string)Yii::$app->getSecurity()->generatePasswordHash('000000'),
                'estado' => 1,
                'authKey' => 1,
                'accessToken' => 1,
                'type' => 0,
            ]
        )->execute();
        Yii::$app->db->createCommand()->insert(
            'usuario',
            [
                'nombres' => 'Coordinador',
                'correo' => 'admin@franquicia.com',
                'cliente_id' => 0,
                'empresa_id' => 4,
                'contrasena' => (string)Yii::$app->getSecurity()->generatePasswordHash('000000'),
                'estado' => 1,
                'authKey' => 1,
                'accessToken' => 1,
                'type' => 1,
            ]
        )->execute();
        /** Clínica Ricardo Palma **/
        Yii::$app->db->createCommand()->insert(
            'usuario',
            [
                'nombres' => 'Analista de Requerimientos',
                'correo' => 'sadmin@clinicaricardopalma.com',
                'cliente_id' => 0,
                'empresa_id' => 5,
                'contrasena' => (string)Yii::$app->getSecurity()->generatePasswordHash('000000'),
                'estado' => 1,
                'authKey' => 1,
                'accessToken' => 1,
                'type' => 0,
            ]
        )->execute();
        Yii::$app->db->createCommand()->insert(
            'usuario',
            [
                'nombres' => 'Coordinador',
                'correo' => 'admin@clinicaricardopalma.com',
                'cliente_id' => 0,
                'empresa_id' => 5,
                'contrasena' => (string)Yii::$app->getSecurity()->generatePasswordHash('000000'),
                'estado' => 1,
                'authKey' => 1,
                'accessToken' => 1,
                'type' => 1,
            ]
        )->execute();
    }
}
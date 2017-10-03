<?php

namespace app\commands;

use Faker\Factory;
use Yii;
use yii\console\Controller;

class GenerateController extends Controller
{
    public static function actionCliente()
    {
        $data = [];
        $faker = Factory::create('es_ES');
        for ($i = 0; $i < 100; $i++) {
            array_push($data, [
                $faker->name,
                $faker->lastName . ' ' . $faker->lastName,
                $faker->dni,
                rand(1920, 1998) . '-' . rand(1, 12) . '-' . rand(1, 29),
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
                rand(2000, 2017) . '-' . rand(1, 12) . '-' . rand(1, 29),
                $faker->phoneNumber,
                $faker->postcode,
                true,

            ]);
        }
        Yii::$app->db->createCommand()->batchInsert(
            'cliente',
            [
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
}
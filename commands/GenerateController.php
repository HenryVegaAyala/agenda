<?php

namespace app\commands;

use app\helpers\Utils;
use app\models\Cliente;
use Faker\Factory;
use tebazil\runner\ConsoleCommandRunner;
use Yii;
use yii\console\Controller;

class GenerateController extends Controller
{
    public static function actionCliente()
    {
        Utils::fileReporte();
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
        ])->where('estado = :estado',
            [':estado' => 1])->all();

        foreach ($clientes as $cliente) {
            array_push($data, [
                $cliente['id'],
                $cliente['nombres'] . ' ' . $cliente['apellidos'],
                $cliente['email_corp'],
                Yii::$app->getSecurity()->generatePasswordHash($cliente['dni']),
                1,
                1,
                1,
            ]);
        }

        Yii::$app->db->createCommand()->batchInsert(
            'usuario',
            [
                'cliente_id',
                'nombres',
                'correo',
                'contrasena',
                'authKey',
                'accessToken',
                'estado',

            ],
            $data
        )->execute();
    }

    public static function actionPiloto()
    {
        Utils::fileReporte();

        echo "Creando Usuario." . "\n";

        Yii::$app->db->createCommand()->insert(
            'cliente',
            [
                'nombres' => 'Henry Pablo',
                'apellidos' => 'Vega Ayala',
                'dni' => '000000',
                'genero' => 'M',
                'email_corp' => 'admin@gmail.com',
                'ubicacion' => 'Villa El Salvador',
                'estado_civil' => 'S',
                'numero_celular' => '955201758',
                'area' => 'Sistemas',
                'puesto' => 'Analista',
                'categoria' => 'Planilla',
                'estado' => 1,
            ]
        )->execute();

        $runner = new ConsoleCommandRunner();
        $runner->run('generate/usuario');
        $runner->getExitCode();

        echo "Generado Exitosamente";
    }

}
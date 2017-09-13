<?php

use yii\db\Migration;

class m170913_030220_insert_table_user extends Migration
{
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->insert('usuario', [
            'nombre' => 'Henry',
            'apellido' => 'Vega',
            'telefono' => '955201758',
            'dni' => '48429679',
            'correo' => 'admin@gmail.com',
            'privilegio' => 'G',
            'contrasena' => '$2y$13$89WFxqYZtVeZIMctCcD.xubjAELmCkGq0W.SXd.g6GwgVeEedjn.i',
            'authKey' => '810dfbbebb17302018ae903e9cb7a483',
            'accessToken' => '810dfbbebb17302018ae903e9cb7a483',
            'estado' => '1',
            'genero' => 'M',
            'fecha_inicio' => '1993-11-21',
            'fecha_cumpleanos' => '2017-07-01',
        ]);
    }

    public function down()
    {
        $this->delete('usuario', ['id' => 1]);
    }
}

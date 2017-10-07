<?php

use yii\db\Schema;

class m171007_220101_Cliente extends \yii\db\Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        
        $this->createTable('cliente', [
            'id' => $this->primaryKey(),
            'nombres' => $this->string(150)->notNull(),
            'apellidos' => $this->string(150)->notNull(),
            'dni' => $this->string(15)->notNull(),
            'fecha_nacimiento' => $this->date(),
            'genero' => $this->char(1),
            'email_personal' => $this->string(150),
            'ubicacion' => $this->string(250),
            'estado_civil' => $this->char(2),
            'numero_celular' => $this->string(15),
            'area' => $this->string(150),
            'puesto' => $this->string(45),
            'categoria' => $this->string(45),
            'email_corp' => $this->string(150)->notNull(),
            'numero_emergencia' => $this->string(45),
            'fecha_ingreso' => $this->date(),
            'numero_oficina' => $this->string(20),
            'anexo' => $this->string(20),
            'estado' => $this->smallInteger(1),
            'fecha_digitada' => $this->datetime(),
            'fecha_modificada' => $this->datetime(),
            'fecha_eliminada' => $this->datetime(),
            'usuario_digitado' => $this->string(50),
            'usuario_modificado' => $this->string(50),
            'usuario_eliminado' => $this->string(50),
            'ip' => $this->string(30),
            'host' => $this->string(150),
            ], $tableOptions);
                
    }

    public function safeDown()
    {
        $this->dropTable('cliente');
    }
}

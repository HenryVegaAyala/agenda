<?php

use yii\db\Schema;

class m170913_030101_Cliente extends \yii\db\Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        
        $this->createTable('cliente', [
            'id' => $this->primaryKey(),
            'nombres' => $this->string(150)->notNull(),
            'apellidos' => $this->string(150)->notNull(),
            'email' => $this->string(150)->notNull(),
            'dni' => $this->integer(8)->notNull(),
            'numero_celular' => $this->string(150)->notNull(),
            'area' => $this->string(150)->notNull(),
            'cargo' => $this->string(150)->notNull(),
            'fecha_digitada' => $this->datetime(),
            'fecha_modificada' => $this->datetime(),
            'fecha_eliminada' => $this->datetime(),
            'usuario_digitado' => $this->string(50),
            'usuario_modificado' => $this->string(50),
            'usuario_eliminado' => $this->string(50),
            'estado' => $this->smallInteger(1),
            'ip' => $this->string(30),
            'host' => $this->string(150),
            ], $tableOptions);
                
    }

    public function down()
    {
        $this->dropTable('cliente');
    }
}

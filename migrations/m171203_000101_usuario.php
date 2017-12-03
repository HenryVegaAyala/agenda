<?php

use yii\db\Schema;

class m171203_000101_usuario extends \yii\db\Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        
        $this->createTable('usuario', [
            'id' => $this->primaryKey(),
            'cliente_id' => $this->integer(11)->notNull(),
            'empresa_id' => $this->integer(11)->notNull(),
            'nombres' => $this->string(80),
            'correo' => $this->string(40),
            'contrasena' => $this->string(150),
            'authKey' => $this->string(150),
            'accessToken' => $this->string(150),
            'estado' => $this->smallInteger(1),
            'fecha_digitada' => $this->datetime(),
            'fecha_modificada' => $this->datetime(),
            'fecha_eliminada' => $this->datetime(),
            'usuario_digitado' => $this->string(50),
            'usuario_modificado' => $this->string(50),
            'usuario_eliminado' => $this->string(50),
            'ip' => $this->string(30),
            'host' => $this->string(150),
            'type' => $this->integer(11),
            ], $tableOptions);
                
    }

    public function down()
    {
        $this->dropTable('usuario');
    }
}

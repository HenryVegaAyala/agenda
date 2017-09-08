<?php

use yii\db\Schema;

class m170908_030101_Ruta extends \yii\db\Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        
        $this->createTable('ruta', [
            'id' => $this->primaryKey(),
            'rol_usuario' => $this->string(30),
            'nombre_url' => $this->string(150),
            'url' => $this->string(150),
            'fecha_digitada' => $this->datetime(),
            'fecha_modificada' => $this->datetime(),
            'fecha_eliminada' => $this->datetime(),
            'usuario_digitado' => $this->string(50),
            'usuario_modificado' => $this->string(50),
            'usuario_eliminado' => $this->string(50),
            'ip' => $this->string(30),
            'host' => $this->string(40),
            'estado' => $this->smallInteger(1),
            ], $tableOptions);
                
    }

    public function down()
    {
        $this->dropTable('ruta');
    }
}

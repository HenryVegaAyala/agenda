<?php

use yii\db\Schema;

class m171203_000101_empresa extends \yii\db\Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        
        $this->createTable('empresa', [
            'id' => $this->primaryKey(),
            'nombre' => $this->string(45),
            'ruc' => $this->string(45),
            'estado' => $this->smallInteger(1),
            ], $tableOptions);
                
    }

    public function down()
    {
        $this->dropTable('empresa');
    }
}

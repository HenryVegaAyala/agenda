<?php

use yii\db\Schema;

class m170913_030101_Incidencia extends \yii\db\Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        
        $this->createTable('incidencia', [
            'id' => $this->primaryKey(),
            'usuario_id' => $this->integer(11)->notNull(),
            'empresa' => $this->string(150)->notNull(),
            'cliente' => $this->string(150)->notNull(),
            'contacto' => $this->string(150)->notNull(),
            'notas' => $this->string(150)->notNull(),
            'resumen' => $this->string(150)->notNull(),
            'servico' => $this->string(150)->notNull(),
            'ci' => $this->string(150)->notNull(),
            'fecha_deseada' => $this->string(150)->notNull(),
            'impacto' => $this->string(150)->notNull(),
            'urgencia' => $this->string(150)->notNull(),
            'prioridad' => $this->string(150)->notNull(),
            'tipo_incidencia' => $this->string(150)->notNull(),
            'fuente_reportada' => $this->string(150)->notNull(),
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
        $this->dropTable('incidencia');
    }
}

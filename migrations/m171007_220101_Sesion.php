<?php

use yii\db\Schema;

class m171007_220101_Sesion extends \yii\db\Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        
        $this->createTable('session', [
            'id' => $this->char(40)->notNull(),
            'expire' => $this->integer(11),
            'data' => $this->binary(),
            'PRIMARY KEY ([[id]])',
            ], $tableOptions);
                
    }

    public function safeDown()
    {
        $this->dropTable('session');
    }
}

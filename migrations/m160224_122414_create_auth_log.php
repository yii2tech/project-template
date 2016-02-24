<?php

use yii\db\Migration;

class m160224_122414_create_auth_log extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $columns = [
            'id' => $this->primaryKey(),
            'date' => $this->integer(),
            'cookieBased' => $this->boolean(),
            'duration' => $this->integer(),
            'error' => $this->string(),
            'ip' => $this->string(),
            'host' => $this->string(),
            'url' => $this->string(),
            'userAgent' => $this->string(),
        ];

        $table = 'UserAuthLog';
        $this->createTable($table, array_merge($columns, ['userId' => $this->integer()]), $tableOptions);
        $this->addForeignKey("fk_{$table}_userId", $table, 'userId', 'User', 'id', 'CASCADE', 'CASCADE');

        $table = 'AdminAuthLog';
        $this->createTable($table, array_merge($columns, ['adminId' => $this->integer()]), $tableOptions);
        $this->addForeignKey("fk_{$table}_adminId", $table, 'adminId', 'Admin', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable('AdminAuthLog');
        $this->dropTable('UserAuthLog');
    }
}

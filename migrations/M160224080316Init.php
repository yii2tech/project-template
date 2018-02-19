<?php

namespace app\migrations;

use Yii;
use yii\db\Migration;

class M160224080316Init extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $table = 'Admin';
        $this->createTable($table, [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'email' => $this->string()->notNull()->unique(),
            'authKey' => $this->string(32)->notNull(),
            'passwordHash' => $this->string()->notNull(),
            'passwordResetToken' => $this->string()->unique(),
            'statusId' => $this->smallInteger()->notNull()->defaultValue(10),
            'createdAt' => $this->integer()->notNull(),
            'updatedAt' => $this->integer()->notNull(),
        ], $tableOptions);
        $this->createIndex("idx_{$table}_statusId", $table, 'statusId');
        $this->insert($table, [
            'username' => 'admin',
            'email' => 'admin@myproject.com',
            'passwordHash' => Yii::$app->security->generatePasswordHash('admin'),
            'authKey' => Yii::$app->security->generateRandomString(),
            'createdAt' => time(),
            'updatedAt' => time(),
        ]);

        $table = 'User';
        $this->createTable($table, [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'email' => $this->string()->notNull()->unique(),
            'authKey' => $this->string(32)->notNull(),
            'passwordHash' => $this->string()->notNull(),
            'passwordResetToken' => $this->string()->unique(),
            'statusId' => $this->smallInteger()->notNull()->defaultValue(10),
            'createdAt' => $this->integer()->notNull(),
            'updatedAt' => $this->integer()->notNull(),
        ], $tableOptions);
        $this->createIndex("idx_{$table}_statusId", $table, 'statusId');
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('User');
        $this->dropTable('Admin');
    }
}
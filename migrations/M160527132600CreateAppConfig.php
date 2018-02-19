<?php

namespace app\migrations;

use yii\db\Migration;

class M160527132600CreateAppConfig extends Migration
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

        $this->createTable('AppConfig', [
            'id' => $this->string(),
            'value' => $this->text(),
            'PRIMARY KEY(' . $this->db->quoteColumnName('id') . ')',
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('AppConfig');
    }
}
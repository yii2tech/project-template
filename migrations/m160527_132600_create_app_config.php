<?php

use yii\db\Migration;

class m160527_132600_create_app_config extends Migration
{
    /**
     * @inheritdoc
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
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('AppConfig');
    }
}
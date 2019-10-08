<?php

use yii\db\Migration;

class m191008_111736_03_create_table_questions extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%questions}}', [
            'id' => $this->primaryKey(),
            'quest' => $this->string()->notNull(),
            'id_test' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex('id_test', '{{%questions}}', 'id_test');
        $this->addForeignKey('questions_ibfk_1', '{{%questions}}', 'id_test', '{{%test}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable('{{%questions}}');
    }
}

<?php

use yii\db\Migration;

class m191008_111736_04_create_table_answers extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%answers}}', [
            'id' => $this->primaryKey(),
            'answer' => $this->string()->notNull(),
            'id_quest' => $this->integer()->notNull(),
            'check_true' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex('id_quest', '{{%answers}}', 'id_quest');
        $this->addForeignKey('answers_ibfk_1', '{{%answers}}', 'id_quest', '{{%questions}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable('{{%answers}}');
    }
}

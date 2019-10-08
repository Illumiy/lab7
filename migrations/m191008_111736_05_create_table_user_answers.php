<?php

use yii\db\Migration;

class m191008_111736_05_create_table_user_answers extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user_answers}}', [
            'id' => $this->primaryKey(),
            'id_user' => $this->integer()->notNull(),
            'id_quest' => $this->integer()->notNull(),
            'id_answer' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex('id_quest', '{{%user_answers}}', 'id_quest');
        $this->createIndex('id_user', '{{%user_answers}}', 'id_user');
        $this->createIndex('id_answer', '{{%user_answers}}', 'id_answer');
        $this->addForeignKey('user_answers_ibfk_1', '{{%user_answers}}', 'id_answer', '{{%answers}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('user_answers_ibfk_2', '{{%user_answers}}', 'id_quest', '{{%questions}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('user_answers_ibfk_3', '{{%user_answers}}', 'id_user', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable('{{%user_answers}}');
    }
}

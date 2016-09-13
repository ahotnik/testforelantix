<?php

use yii\db\Migration;
use yii\db\pgsql\Schema;

class m160913_125730_add_user_table extends Migration
{
    public function up()
    {
        $this->createTable('users.user', [
            'id' => Schema::TYPE_PK,
            'username' => Schema::TYPE_STRING . '(63) NOT NULL',
            'email' => Schema::TYPE_STRING . '(255) NOT NULL',
            'password' => Schema::TYPE_STRING . '(255) NOT NULL',
            'created_at' => Schema::TYPE_TIMESTAMP . ' without time zone NOT NULL DEFAULT now()']);
    }

    public function down()
    {
        $this->dropTable('users.user');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}

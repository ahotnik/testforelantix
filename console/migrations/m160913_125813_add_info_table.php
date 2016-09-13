<?php

use yii\db\Migration;
use yii\db\pgsql\Schema;

class m160913_125813_add_info_table extends Migration
{
    public function up()
    {
        $this->createTable('users.info',[
            'user_id' => Schema::TYPE_PK,
            'age' => Schema::TYPE_INTEGER.' NOT NULL',
            'address' => Schema::TYPE_STRING . '(100) NOT NULL',
            'city' => Schema::TYPE_STRING . '(100) NOT NULL',
            'country' => Schema::TYPE_STRING . '(100) NOT NULL',
            'phone_number' => Schema::TYPE_STRING . '(100) NOT NULL',
        ]);
        $this->addForeignKey('users_user_id_fk', 'users.info', 'user_id', 'users.user', 'id', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable('users.info');
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

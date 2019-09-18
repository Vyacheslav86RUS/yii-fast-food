<?php

use yii\db\Migration;

/**
 * Class m190918_113117_change_users_field_requirements
 */
class m190918_113117_change_users_field_requirements extends Migration
{
    private $tableName = '{{%users}}';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn($this->tableName, 'username', $this->string());
        $this->alterColumn($this->tableName, 'password_hash', $this->string());
        $this->alterColumn($this->tableName, 'email', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn($this->tableName, 'username', $this->string()->notNull());
        $this->alterColumn($this->tableName, 'password_hash', $this->string()->notNull());
        $this->alterColumn($this->tableName, 'email', $this->string()->notNull());
    }
}

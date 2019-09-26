<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%food_value}}`.
 */
class m190926_081032_create_food_value_table extends Migration
{
    private $tableName = '{{%food_value}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'value' => $this->float()->notNull(),
            'price_id' => $this->integer()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable($this->tableName);
    }
}

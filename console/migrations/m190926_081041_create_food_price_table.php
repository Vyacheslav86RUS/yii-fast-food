<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%food_price}}`.
 */
class m190926_081041_create_food_price_table extends Migration
{
    private $tableName = '{{%food_price}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'price' => $this->float()->notNull(),
            'value_id' => $this->integer()->notNull()
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

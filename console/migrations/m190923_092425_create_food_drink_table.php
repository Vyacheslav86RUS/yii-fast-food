<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%food_drink}}`.
 */
class m190923_092425_create_food_drink_table extends Migration
{
    private $tableName = '{{%food_drink}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'meta_json' => 'JSON NOT NULL',
            'category_id' => $this->integer()->notNull(),
            'img_id' => $this->integer()->notNull(),
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

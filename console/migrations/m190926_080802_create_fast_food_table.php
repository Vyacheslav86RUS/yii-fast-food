<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%fast_food}}`.
 */
class m190926_080802_create_fast_food_table extends Migration
{
    private $tableName = '{{%fast_food}}';

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

<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%food_sauce}}`.
 */
class m190923_092635_create_food_sauce_table extends Migration
{
    private $tableName = '{{%food_sauce}}';

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

<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%food_img}}`.
 */
class m190926_085630_create_food_img_table extends Migration
{
    private $tableName = '{{%food_img}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'path' => $this->string(255)->notNull()
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

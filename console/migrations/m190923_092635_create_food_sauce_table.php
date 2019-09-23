<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%food_sauce}}`.
 */
class m190923_092635_create_food_sauce_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%food_sauce}}', [
            'id' => $this->primaryKey(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%food_sauce}}');
    }
}

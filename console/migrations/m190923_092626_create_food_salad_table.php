<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%food_salad}}`.
 */
class m190923_092626_create_food_salad_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%food_salad}}', [
            'id' => $this->primaryKey(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%food_salad}}');
    }
}

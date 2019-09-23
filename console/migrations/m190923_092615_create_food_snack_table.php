<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%food_snack}}`.
 */
class m190923_092615_create_food_snack_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%food_snack}}', [
            'id' => $this->primaryKey(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%food_snack}}');
    }
}

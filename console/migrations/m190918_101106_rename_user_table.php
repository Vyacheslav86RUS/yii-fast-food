<?php

use yii\db\Migration;

/**
 * Class m190918_101106_rename_user_table
 */
class m190918_101106_rename_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameTable('{{%user}}', '{{%users}}');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->renameTable('{{%users}}', '{{%user}}');
    }
}

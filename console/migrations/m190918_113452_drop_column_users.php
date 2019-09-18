<?php

use yii\db\Migration;

/**
 * Class m190918_113452_drop_column_users
 */
class m190918_113452_drop_column_users extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('{{%users}}', 'verification_token');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('{{%users}}', 'verification_token', $this->string()->defaultValue(null));
    }

}

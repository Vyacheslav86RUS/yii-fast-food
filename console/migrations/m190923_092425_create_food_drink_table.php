<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%food_drink}}`.
 */
class m190923_092425_create_food_drink_table extends Migration
{
    private $tableName = '{{%food_drink}}';
    private $refTableParams = [
        'category_id' => [
            'table' => '{{%food_categories}}',
            'column' => 'id'
        ],
        'img_id' => [
            'table' => '{{%food_img}}',
            'column' => 'id'
        ],
    ];

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $categoryName = 'category_id';
        $imgName = 'img_id';

        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'meta_json' => 'JSON NOT NULL',
            $categoryName => $this->integer()->notNull(),
            $imgName => $this->integer()->notNull()
        ]);

        $this->createIndex(
            '{{%idx-' . mb_substr($this->tableName, 3, -2) . '-category',
            $this->tableName,
            'category_id',
            true
        );

        $this->addForeignKey(
            '{{%fk-' . mb_substr($this->tableName, 3, -2) . '-' . $categoryName,
            $this->tableName,
            $categoryName,
            $this->refTableParams[$categoryName]['table'],
            $this->refTableParams[$categoryName]['column'],
            'CASCADE'
        );

        $this->createIndex(
            '{{%idx-' . mb_substr($this->tableName, 3, -2) . '-' . $imgName,
            $this->tableName,
            'img_id',
            true
        );

        $this->addForeignKey(
            '{{%fk-' . mb_substr($this->tableName, 3, -2) . '-category_id',
            $this->tableName,
            $imgName,
            $this->refTableParams[$imgName]['table'],
            $this->refTableParams[$imgName]['column'],
            'CASCADE'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable($this->tableName);
    }
}

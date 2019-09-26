<?php

use yii\db\Migration;

/**
 * Class m190926_090643_add_index_foreignKey_items_food_table
 */
class m190926_090643_add_index_foreignKey_items_food_table extends Migration
{
    private $tablesName = [
        '{{%food_drink}}',
        '{{%food_snack}}',
        '{{%food_salad}}',
        '{{%food_sauce}}',
        '{{%fast_food}}'
    ];

    private $refTableParams = [
        'category_id' => [
            'table' => '{{%food_categories}}',
            'column' => 'id'
        ],
        'img_id' => [
            'table' => '{{%food_img}}',
            'column' => 'id'
        ],
        'value_id' => [
            'table' => '{{%food_value}}',
            'column' => 'id'
        ]
    ];

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        foreach ($this->tablesName as $tableKey => $tableName) {

            foreach ($this->refTableParams as $key => $value) {

                $this->createIndex(
                    '{{%idx-' . mb_substr($tableName, 3, -2) . '-' . str_replace('_id', '', $key) . '}}',
                    $tableName,
                    $key,
                    true
                );

                $this->addForeignKey(
                    '{{%fk-' . mb_substr($tableName, 3, -2) . '-' . $key . '}}',
                    $tableName,
                    $key,
                    $value['table'],
                    $value['column'],
                    'CASCADE'
                );
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        foreach ($this->tablesName as $tableKey => $tableName) {

            foreach ($this->refTableParams as $key => $value) {

                $this->dropIndex(
                    '{{%idx-' . mb_substr($tableName, 3, -2) . '-' . str_replace('_id', '', $key) .'}}',
                    $tableName
                );

                $this->dropForeignKey(
                    '{{%fk-' . mb_substr($tableName, 3, -2) . '-' . $key . '}}',
                    $tableName
                );
            }
        }
    }

}

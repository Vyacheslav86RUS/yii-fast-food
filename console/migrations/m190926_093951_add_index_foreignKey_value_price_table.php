<?php

use yii\db\Migration;

/**
 * Class m190926_093951_add_index_foreignKey_value_price_table
 */
class m190926_093951_add_index_foreignKey_value_price_table extends Migration
{

    private $tablesName = [
        '{{%food_price}}',
        '{{%food_value}}'
    ];

    private $refTableParams = [
        [
            'value_id' => [
                'table' => '{{%food_value}}',
                'column' => 'id'
            ],
        ],
        [
            'price_id' => [
                'table' => '{{%food_price}}',
                'column' => 'id'
            ],
        ]
    ];

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        foreach ($this->tablesName as $tableKey => $tableName) {

            foreach ($this->refTableParams[$tableKey] as $key => $value) {

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

            foreach ($this->refTableParams[$tableKey] as $key => $value) {

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

<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'bootstrap' => [
        'common\bootstrap\SetUp'
    ],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
            'cachePath' => '@common/runtime/cache',
        ],
        'queue' => [
            'class' => \yii\queue\file\Queue::class,
            'path' => '@console/runtime/queue',
            'as log' => \yii\queue\LogBehavior::class,
        ],
    ],
];

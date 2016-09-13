<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
//    $config = [
//        'id' => 'app',
//        'language' => 'ru-RU',
//    ],
];

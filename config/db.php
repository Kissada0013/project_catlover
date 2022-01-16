<?php

return [
//    'class' => 'yii\db\Connection',
//    'dsn' => 'mysql:host=localhost;dbname=projectcat',
//    'username' => 'root',
//    'password' => '',
//    'charset' => 'utf8',
    'class' => 'yii\db\Connection',
    'dsn' => env('DB_DSN'),
    'username' => env('DB_USERNAME'),
    'password' => env('DB_PASSWORD'),
    'charset' => 'utf8',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];


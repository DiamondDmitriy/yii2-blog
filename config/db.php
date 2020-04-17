<?php

$host = '127.0.0.1:3306';
$db_name = 'diary_bd';

return [
    'class' => 'yii\db\Connection',
    'dsn' => "mysql:host=$host;dbname=$db_name",
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];

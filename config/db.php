<?php

/* 
 * 19.11.2020
 * File: db.php
 * Encoding: UTF-8
 * Project: RMS spetial for Quality Motors team
 * 
 * Author: Gafuroff Alexandr 
 * E-mail: gafuroff.al@yandex.ru
 */

// VDS production domain
// VDS production domain
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=rms',
    'username' => 'rms_main',
    'password' => 'pNKFeJ4R',
    'charset' => 'utf8',

    // Schema cache options (for production environment)
    'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
/*
// Beget production domain
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=webmasgt_rms',
    'username' => 'webmasgt_rms',
    'password' => '81JJ&7ps',
    'charset' => 'utf8',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
*/
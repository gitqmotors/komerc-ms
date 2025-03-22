<?php

require __DIR__.'/environment_mode.php';

switch ($currentHost) {  
    
    case $hosts['prod']:
        $db = require __DIR__ . '/db.php';
        $params = require __DIR__ . '/params.php';  
        break;

    case $hosts['prod2']:
        $db = require __DIR__ . '/db.php';
        $params = require __DIR__ . '/params.php';
        break;
    
    case $hosts['staging']:
        $db = require __DIR__ . '/db_staging.php';
        $params = require __DIR__ . '/params_staging.php';
        break;    
    
    case $hosts['dev']:
        $db = require __DIR__ . '/db_dev.php';
        $params = require __DIR__ . '/params_dev.php';
        break;    
}

$config = [
    'id' => 'basic-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'app\commands',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        '@tests' => '@app/tests',
    ],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
    ],
    'params' => $params,
    /*
    'controllerMap' => [
        'fixture' => [ // Fixture generation command line.
            'class' => 'yii\faker\FixtureController',
        ],
    ],
    */
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

define('YII_CONFIG', $config);

<?php

require __DIR__.'/environment_mode.php';

switch ($currentHost) {  
    
    case $hosts['prod']:
        die('You are not allowed to run this application on production server in test mode.'); 
        break;

    case $hosts['prod2']:
        die('You are not allowed to run this application on production server in test mode.');
        break;
    
    case $hosts['staging']:
        $db = require __DIR__ . '/db_test_staging.php';
        $params = require __DIR__ . '/params_test_staging.php';
        break;    
    
    case $hosts['dev']:
        $db = require __DIR__ . '/db_test_dev.php';
        $params = require __DIR__ . '/params_test_dev.php';
        break;    
}

/**
 * Application configuration shared by all test types
 */
$config = [
    'id' => 'basic-tests',
    'basePath' => dirname(__DIR__),
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'language' => 'en-US',
    'components' => [
        'db' => $db,
        'mailer' => [
            'useFileTransport' => true,
        ],
        'assetManager' => [
            'basePath' => __DIR__ . '/../public_html/assets',
        ],
        'urlManager' => [
            'showScriptName' => true,
        ],
        'user' => [
            'identityClass' => 'app\models\User',
        ],
        'request' => [
            'cookieValidationKey' => 'test',
            'enableCsrfValidation' => false,
            // but if you absolutely need it set cookie domain to localhost
            /*
            'csrfCookie' => [
                'domain' => 'localhost',
            ],
            */
        ],
    ],
    'params' => $params,
];

define('YII_CONFIG', $config);
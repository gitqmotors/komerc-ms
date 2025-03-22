<?php

require __DIR__.'/environment_mode.php';

switch ($currentHost) {

    case $hosts['prod']:
        $db = require __DIR__ . '/db.php';
        $params = require __DIR__ . '/params.php';
        $mailerTestMode = false; // Если true работает в тестовом режиме
        break;

    case $hosts['prod2']:
        $db = require __DIR__ . '/db.php';
        $params = require __DIR__ . '/params.php';
        $mailerTestMode = true; // Если true работает в тестовом режиме
        break;

    case $hosts['staging']:
        $db = require __DIR__ . '/db_staging.php';
        $params = require __DIR__ . '/params_staging.php';
        $mailerTestMode = false; // Если true работает в тестовом режиме
        break;

    case $hosts['dev']:
        $db = require __DIR__ . '/db_dev.php';
        $params = require __DIR__ . '/params.php';
        $mailerTestMode = true; // Если true работает в тестовом режиме
        break;
    default:
    $db = require __DIR__ . '/db_dev2.php';
    $params = require __DIR__ . '/params.php';
    $mailerTestMode = true; // Если true работает в тестовом режиме
    break;
}

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'language' => 'ru-RU',
    'modules' => [
        'ajax' => [
            'class' => 'app\modules\ajax\Module',
        ],
    ],
    'bootstrap' => [
        'log',
        'app\components\DynamicRoute'
    ],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'XNzcL5PHeR1Yey0aywK3P51_GBabuAIV',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => $mailerTestMode,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.yandex.ru',
                'username' => 'formi@migauto.ru',
                'password' => 'OLDAVy5l91',
                'port' => '465',
                'encryption' => 'SSL',
            ],
        ],
        'lastmodified' => [
            'class' => 'app\components\LastModified\LastModifiedComponent',
        ],
        'seo' => [
           'class' => 'app\components\SeoComponent\SeoComponent',
        ],
        'assetManager' => [
            // Для корректной работы с прокси-сервером DDoS Guard
            'appendTimestamp' => true,
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'js' => [],
                ],
                'yii\bootstrap\BootstrapPluginAsset' => [
                    'js' => [],
                ],
                'yii\bootstrap\BootstrapAsset' => [
                    'css' => [],
                ],
            ],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            'suffix' => '/',
            'normalizer' => [
                'class' => 'yii\web\UrlNormalizer',
            ],
            'rules' => [
                '<action:(pricelist|company|contacts|agreement)>' => 'site/<action>',
                'services' => 'service/index',
                'auto' => 'brands/index',
                'spec/<action:([\w\-]+)>' => 'campaigns/item',
                'spec' => 'campaigns/index',
                'gallery/page/<page:\d+>' => 'gallery/index',
                'gallery/<action:([\w\-]+)>' => 'gallery/item',
                'news/page/<page:\d+>' => 'news/index',
                'news/<action:([\w\-]+)>' => 'news/item',
                'vacancy/page/<page:\d+>' => 'vacancy/index',
                'vacancy/<action:([\w\-]+)>' => 'vacancy/item',
                'reviews/page/<page:\d+>' => 'feedbacks/index',
                'reviews/<action:([\w\-]+)>' => 'feedbacks/item',
                '<action:(reviews)>' => 'feedbacks/index',
                'api/brands' => 'brandsapi/json-response',
                'api/brands/model' => 'brandmodel/json-response',
                'api/question_answer' => 'questionanswer/json-response',
            ],
        ],
        'recaptcha' => [
            'class' => 'ReCaptcha\ReCaptcha',
            'secret' => '6Lf2o8gaAAAAAGoP6t2otAI6LtIFS5jiHF30Y5kE',
            'siteKey' => '6Lf2o8gaAAAAAGtekQA746KjIlthBV8WST1Kp-r3',
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
        //'allowedIPs' => ['*'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['components']['cache'] = [
        'class' => 'yii\caching\ArrayCache',
    ];
    $config['components']['urlManager']['cache'] = false;
}

Yii::$classMap['Sitemap'] = '@app/generators/Sitemap.php';
Yii::$classMap['SitemapIndex'] = '@app/generators/SitemapIndex.php';


//$host = $_SERVER['HTTP_HOST'];
/*$host = "servic-mercedes-benz.r-ms.loc";
$subdomain1 = "servic-";
$subdomain2 = "remont-";
if(strpos($host, $subdomain1) !== false || strpos($host, $subdomain2) !== false){
    $config['urlManager']['rules'] = [

        'http://servic-mercedes-benz.r-ms.loc/' => 'brands/item-subdomain',
        'http://servic-mercedes-benz.r-ms.loc/<action:([\w\-]+)>' => 'brands/item-subdomain',

    ];
} else{
    error_log("no no hello");
}*/
define('YII_CONFIG', $config);

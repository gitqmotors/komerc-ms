<?php

defined('YII_ENVIRONMENT') or define('YII_ENVIRONMET', 'web');

require __DIR__ . '/../config/environment_mode.php';

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

$host = $_SERVER['HTTP_HOST'];
$subdomain1 = "servis-";
$subdomain2 = "remont-";
if(strpos($host, $subdomain1) !== false || strpos($host, $subdomain2) !== false){
    require __DIR__ . '/../config/web-subdomains.php';
} else{
    require __DIR__ . '/../config/web.php';
}
//require __DIR__ . '/../config/web.php';

//require __DIR__ . '/../recaptcha/recaptcha.php';
(new yii\web\Application(YII_CONFIG))->run();

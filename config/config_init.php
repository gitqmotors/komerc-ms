<?php

/* 
 * 19.11.2020
 * File: config_init.php
 * Encoding: UTF-8
 * Project: RMS spetial for Quality Motors team
 * 
 * Author: Gafuroff Alexandr 
 * E-mail: gafuroff.al@yandex.ru
 */

// Имена хостов для определенной версии проекта
$hosts = array(
    'dev' => 'r-ms-new.localhost',
    //'staging' => 'rms.tw1.ru',
    'staging' => '',
    'prod' => 'r-ms.ru',
    'prod2' => '',
);

// Подключение имени хоста для dev версии проекта
if (file_exists(__DIR__.'/dev_domain.php')) {
    $hosts['dev'] = require_once __DIR__.'/dev_domain.php';
}

// Сработает в случае запуска консольного приложения
if (! isset($_SERVER['HTTP_HOST'])) {
    if(file_exists(__DIR__.'/db_dev.php')) {
        $currentHost = $hosts['dev'];
    } elseif(file_exists(__DIR__.'/db_staging.php')) {
        $currentHost = $hosts['staging'];
    } else {
        $currentHost = $hosts['prod'];
    }
} else {
    $currentHost = $_SERVER['HTTP_HOST'];
}

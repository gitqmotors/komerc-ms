<?php

/* 
 * 19.11.2020
 * File: environment_mode.php
 * Encoding: UTF-8
 * Project: RMS spetial for Quality Motors team
 * 
 * Author: Gafuroff Alexandr 
 * E-mail: gafuroff.al@yandex.ru
 */

require_once __DIR__.'/config_init.php';

switch ($currentHost) {
    
    case $hosts['prod']:
        defined('YII_DEBUG') or define('YII_DEBUG', false);
        defined('YII_ENV') or define('YII_ENV', 'prod');
        break;

    case $hosts['prod2']:
        error_reporting(E_ALL|E_STRICT);
        ini_set('display_errors', 'On');
        defined('YII_DEBUG') or define('YII_DEBUG', false);
        defined('YII_ENV') or define('YII_ENV', 'prod');
        break;
    
    case $hosts['staging']:
        if(YII_ENVIRONMENT == 'test') {   
            error_reporting(E_ALL|E_STRICT);
            ini_set('display_errors', 'On');
            restore_error_handler();
            defined('YII_DEBUG') or define('YII_DEBUG', true);
            defined('YII_ENV') or define('YII_ENV', 'test');
        } else {
            defined('YII_DEBUG') or define('YII_DEBUG', false);
            defined('YII_ENV') or define('YII_ENV', 'prod');
        }        
        break;
   
    case $hosts['dev']:      
        error_reporting(E_ALL|E_STRICT);
        ini_set('display_errors', 'On');
        restore_error_handler();
        defined('YII_DEBUG') or define('YII_DEBUG', true);
        defined('YII_ENV') or define('YII_ENV', 'dev');                
        break;

    default:
        error_reporting(E_ALL|E_STRICT);
        ini_set('display_errors', 'On');
        restore_error_handler();
        defined('YII_DEBUG') or define('YII_DEBUG', true);
        defined('YII_ENV') or define('YII_ENV', 'dev');
        break;
}


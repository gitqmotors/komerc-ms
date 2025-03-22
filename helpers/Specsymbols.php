<?php

/*
 * 2021 Mar 6
 * File: Specsymbols.php
 * Encoding: UTF-8
 * Project: RMS special for Quality Motors team
 * 
 * Author: Gafuroff Alexandr 
 * E-mail: gafuroff.al@yandex.ru
 */

namespace app\helpers;

/**
 * Description of Specsymbols
 *
 * @author Александр
 */
class Specsymbols {
    
    static $lib = [
        '{star}' => '⭐',
        '{check}' => '✅',
        '{rocket}' => '🚀',
        '{aclock}' => '⏰',
        '{phone)' => '☎'
    ];
    
    static function getShortcodes() 
    {
        return array_keys(self::$lib);
    }
    
    static function getSpecSymbols()
    {
        return array_values(self::$lib);
    }
    
    static function replace($string) {
        return str_replace(self::getShortcodes(), self::getSpecSymbols(), $string);
    }
    
}

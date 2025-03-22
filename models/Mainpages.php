<?php

/*
 * 26.11.2020
 * File: SiteController.php
 * Encoding: UTF-8
 * Project: RMS special for Quality Motors team
 * 
 * Author: Gafuroff Alexandr 
 * E-mail: gafuroff.al@yandex.ru
 */

namespace app\models;

use app\models\AppActiveRecord;

/**
 * Description of Mainpages
 *
 * @author Александр
 */
class Mainpages extends AppActiveRecord {
    
    public static function tableName() {
        return 'main_pages';
    }
    
    /**
     * Петод формирует и предоставляет title текущей страницы
     * @param string $string Строка, участвующая в формировании
     * @param boolean $noReplace Отменяет замену и отдает строку целиком
     * @return string Description
     */
    public function getTitle($string = null, $noReplace = null) {
        if(is_null($string)) {
            return $this->title;
        }
        if(!is_null($noReplace)) {
            return $string;
        }
        return str_replace('{{INSERT}}', $string, $this->title);
    }
    
    /**
     * Петод формирует и предоставляет description текущей страницы
     * @param string $string Строка, участвующая в формировании
     * @param boolean $noReplace Отменяет замену и отдает строку целиком
     * @return string Description
     */
    public function getDescription($string = null, $noReplace = null) {
        if(is_null($string)) {
            return $this->description;
        }
        if(!is_null($noReplace)) {
            return $string;
        }
        return str_replace('{{INSERT}}', $string, $this->description);
    }
    
    /**
     * Петод формирует и предоставляет keywords текущей страницы
     * @param string $string Строка, участвующая в формировании
     * @param boolean $noReplace Отменяет замену и отдает строку целиком
     * @return string Description
     */
    public function getKeywords($string = null, $noReplace = null) {
        if(is_null($string)) {
            if(is_null($this->keywords)) {
                return null;
            }
            return $this->keywords;
        }
        $string = str_replace([' - ',' — ','. ',' в '], ', ', $string);
        if(!is_null($noReplace)) {
            return $string;
        }
        return str_replace('{{INSERT}}', mb_strtolower($string), $this->keywords);
    }
    
}

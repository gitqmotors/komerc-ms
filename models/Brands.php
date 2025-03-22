<?php

/*
 * 24.11.2020
 * File: Brands.php
 * Encoding: UTF-8
 * Project: RMS special for Quality Motors team
 * 
 * Author: Gafuroff Alexandr 
 * E-mail: gafuroff.al@yandex.ru
 */

namespace app\models;

class Brands extends AppActiveRecord
{
    public static function tableName()
    {
        return 'brands';
    }

    public function isVAG(): bool
    {
        $vagGroup = [
            'volkswagen',
            'audi',
            'skoda',
            'porsche',
            'seat',
            'bentley'
        ];

        $brand = strtolower($this->url);

        return in_array($brand, $vagGroup);
    }

    public function getNameRus(): string
    {
        return trim($this->rus_name, '( )');
    }
}

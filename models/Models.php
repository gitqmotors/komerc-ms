<?php

/*
 * 27.11.2020
 * File: Models.php
 * Encoding: UTF-8
 * Project: RMS special for Quality Motors team
 * 
 * Author: Gafuroff Alexandr 
 * E-mail: gafuroff.al@yandex.ru
 */

namespace app\models;

use yii\db\ActiveRecord;

class Models extends ActiveRecord
{
    public static function tableName()
    {
        return 'models';
    }

    public function getBrand()
    {
        return $this->hasOne(Brands::class, ['id' => 'brand_id']);
    }

    public function getNameRus(): string
    {
        $brand = $this->getBrand()->cache()->one();

        $brandNameRus = trim($brand->rus_name, '( )');

        $modelNameRus = str_replace($brandNameRus, '', $this->rus_name);
        $modelNameRus = trim($modelNameRus, '( )');

        return $modelNameRus;
    }

    public function getBrandAndModelNameRus(): string
    {
        return trim($this->rus_name, '( )');
    }
}

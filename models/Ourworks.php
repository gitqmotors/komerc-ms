<?php

/*
 * 2021 Jan 31
 * File: Ourworks.php
 * Encoding: UTF-8
 * Project: RMS special for Quality Motors team
 * 
 * Author: Gafuroff Alexandr 
 * E-mail: gafuroff.al@yandex.ru
 */

namespace app\models;

use yii\db\ActiveRecord;

/**
 * Description of Ourworks
 *
 * @author Александр
 */
class Ourworks extends ActiveRecord
{
    public static function tableName(): string 
    {
        return 'our_works_slider';
    }
}

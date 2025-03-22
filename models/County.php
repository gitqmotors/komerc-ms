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

use app\models\AppActiveRecord;

/**
 * Description of County
 *
 * @author nelset.com
 */
class County extends AppActiveRecord
{

    public static function tableName()
    {
        return 'seo_county';
    }

}

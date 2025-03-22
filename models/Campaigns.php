<?php

/*
 * 01.12.2020
 * File: Campaigns.php
 * Encoding: UTF-8
 * Project: RMS special for Quality Motors team
 * 
 * Author: Gafuroff Alexandr 
 * E-mail: gafuroff.al@yandex.ru
 */

namespace app\models;

use app\models\AppActiveRecord;

/**
 * Description of Campaigns
 *
 * @author Александр
 */
class Campaigns extends AppActiveRecord
{
    
    public static function tableName()
    {
        return 'campaigns';
    }
    
}

<?php

/*
 * 02.12.2020
 * File: Portfolios.php
 * Encoding: UTF-8
 * Project: RMS special for Quality Motors team
 * 
 * Author: Gafuroff Alexandr 
 * E-mail: gafuroff.al@yandex.ru
 */

namespace app\models;

use app\models\AppActiveRecord;

/**
 * Description of Protfolios
 *
 * @author Александр
 */
class Portfolios extends AppActiveRecord 
{
    
    public static function tableName() 
    {
        return 'portfolio';
    }
    
}

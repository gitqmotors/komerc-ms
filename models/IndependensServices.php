<?php

/*
 * 27.11.2020
 * File: IndependensServices.php
 * Encoding: UTF-8
 * Project: RMS special for Quality Motors team
 * 
 * Author: Gafuroff Alexandr 
 * E-mail: gafuroff.al@yandex.ru
 */

namespace app\models;

use app\models\AppActiveRecord;
use app\traits\DSGServiceDetection;
use app\traits\HiddenServices;
use app\traits\ServiceCleanNaming;

/**
 * Description of IndependensServices
 *
 * @author Александр
 */
class IndependensServices extends AppActiveRecord 
{    
    use ServiceCleanNaming;
    use DSGServiceDetection;
    use HiddenServices;
    
    public static function tableName() {
        return 'indep_services';
    }
      
}
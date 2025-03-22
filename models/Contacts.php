<?php

/*
 * 03.12.2020
 * File: Contacts.php
 * Encoding: UTF-8
 * Project: RMS special for Quality Motors team
 * 
 * Author: Gafuroff Alexandr 
 * E-mail: gafuroff.al@yandex.ru
 */

namespace app\models;

use app\models\AppActiveRecord;

/**
 * Description of Contacts
 *
 * @author Александр
 */
class Contacts extends AppActiveRecord
{
    private $linkPhone;
    
    public static function tableName()
    {
        return 'contacts';
    }
    
    public function getLinkPhone() 
    {
        if(is_null($this->linkPhone)) {
            $this->linkPhone = str_replace(['(',')','-',' '], '', $this->phone);
        }
        return $this->linkPhone;
    }
}

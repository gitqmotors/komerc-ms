<?php

/*
 * 2021 Feb 15
 * File: ServiceCleanNaming.php
 * Encoding: UTF-8
 * Project: RMS special for Quality Motors team
 * 
 * Author: Gafuroff Alexandr 
 * E-mail: gafuroff.al@yandex.ru
 */

namespace app\traits;

/**
 *
 * @author Александр
 */
trait ServiceCleanNaming {
    
    protected $cleanName;
    protected $cleanFrom = [
        ' (ТО)',
        ' (подвески)',
        ' автомобиля'
    ];    
    
    public function getCleanName()            
    {
        if(is_null($this->cleanName)) {
            $this->cleanName = str_replace($this->cleanFrom, '', $this->name);
            $this->cleanName = preg_replace("/авто$/iu", '', $this->cleanName);
        }
        return $this->cleanName;
    }
    
}

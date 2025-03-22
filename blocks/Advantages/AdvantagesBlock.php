<?php

/*
 * 02.12.2020
 * File: AdvantagesBlock.php
 * Encoding: UTF-8
 * Project: RMS special for Quality Motors team
 * 
 * Author: Gafuroff Alexandr 
 * E-mail: gafuroff.al@yandex.ru
 */

namespace app\blocks\Advantages;

use app\blocks\Block;
use app\models\Brands;
use app\models\Models;

class AdvantagesBlock extends Block
{
    /**
     * @var Brands|null
     */
    public $brand;
    /**
     * @var Models|null
     */
    public $model;
    
    public function run() {

        $brand = $this->brand ? $this->brand->name : '';
        $brandRus = $this->brand ? $this->brand->getNameRus() : '';
        $model = $this->model ? $this->model->name : '';
        $modelRus = $this->model ? $this->model->getNameRus() : '';
        return $this->render(compact('brand', 'brandRus', 'model', 'modelRus'));
    }
    
}

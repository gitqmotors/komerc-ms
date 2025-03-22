<?php

/*
 * 2021 Jan 31
 * File: UnderpriceBlock.php
 * Encoding: UTF-8
 * Project: RMS special for Quality Motors team
 * 
 * Author: Gafuroff Alexandr 
 * E-mail: gafuroff.al@yandex.ru
 */

namespace app\blocks\Underprice;

use app\blocks\Block;
use app\models\Brands;
use app\models\Models;

class UnderpriceBlock extends Block
{
    /**
     * @var Brands|null
     */
    public $brand;
    /**
     * @var Models|null
     */
    public $model;
    public $detailing;
    
    public function run()
    {
        return $this->render([
            'brand' => $this->brand ? $this->brand->name : '',
            'brandRus' => $this->brand ? $this->brand->getNameRus() : '',
            'model' => $this->model ? $this->model->name : '',
            'modelRus' => $this->model ? $this->model->getNameRus() : '',
            'detailing' => $this->detailing,
        ]);
    }
}

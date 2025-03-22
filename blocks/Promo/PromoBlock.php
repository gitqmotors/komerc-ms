<?php

/*
 * 24.11.2020
 * File: PromoBlock.php
 * Encoding: UTF-8
 * Project: RMS special for Quality Motors team
 * 
 * Author: Gafuroff Alexandr 
 * E-mail: gafuroff.al@yandex.ru
 */

namespace app\blocks\Promo;

use Yii;
use app\blocks\Block;

class PromoBlock extends Block
{
    public $h1;
    public $brandName;
    public $brandNameRus;
    public $modelName;
    public $modelNameRus;
    public $detailing;
    public $groupId;
    public $dist;

    public function init()
    {
        parent::init();

        if ($this->h1 === null) {
            $this->h1 = Yii::$app->controller->currentPage->header;
        }

        if (!(empty($this->brandName) && empty($this->modelName))) {
            $this->h1 .= ' в Москве';
        }

        if ($this->brandName !== null) {
            $this->brandName = ' ' . $this->brandName;
        }
        if ($this->brandNameRus !== null) {
            $this->brandNameRus = ' ' . $this->brandNameRus;
        }
        if ($this->modelName !== null) {
            $this->modelName = ' ' . $this->modelName;
        }
        if ($this->modelNameRus !== null) {
            $this->modelNameRus = ' ' . $this->modelNameRus;
        }
    }

    public function run()
    {
        return $this->render([
            'h1' => $this->h1,
            'brandName' => $this->brandName,
            'brandNameRus' => $this->brandNameRus,
            'modelName' => $this->modelName,
            'modelNameRus' => $this->modelNameRus,
            'detailing' => $this->detailing,
            'groupId' => $this->groupId,
        ]);
    }
}

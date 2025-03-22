<?php

/*
 * 02.12.2020
 * File: PortfolioBlock.php
 * Encoding: UTF-8
 * Project: RMS special for Quality Motors team
 * 
 * Author: Gafuroff Alexandr 
 * E-mail: gafuroff.al@yandex.ru
 */

namespace app\blocks\Portfolio;

use app\blocks\Block;
use app\models\Portfolios;

/**
 * Description of PorfolioBlock
 *
 * @author Александр
 */
class PortfolioBlock extends Block
{
    public $gallery;
    
    public function init() 
    {
        parent::init();
        /*if(is_null($this->portfolios)) {
            $this->portfolios = Portfolios::find()->select(['url','name','image'])->all();
        }*/
    }
    
    public function run() 
    {
        $items = '';
        foreach($this->gallery as $item) {
            $items .= $this->getItem($item);
        }
        return $this->render(compact('items'));
    }
    
}

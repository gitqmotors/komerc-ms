<?php

/*
 * 24.11.2020
 * File: BrandsliderBlock.php
 * Encoding: UTF-8
 * Project: RMS special for Quality Motors team
 * 
 * Author: Gafuroff Alexandr 
 * E-mail: gafuroff.al@yandex.ru
 */

namespace app\blocks\Brandslider;

use Yii;
use app\blocks\Block;
use app\models\Brands;

/**
 * Description of BrandsliderBlock
 *
 * @author Александр
 */
class BrandsliderBlock extends Block
{
   /**
    * @var app\models\Brands
    */
    public $brands;
    
    public function init() 
    {
        parent::init();
        if(isset(Yii::$app->controller->brands) AND !is_null(Yii::$app->controller->brands) AND is_null($this->brands)) {
            $this->brands = Yii::$app->controller->brands;
        }
        if(is_null($this->brands)) {
            $this->brands = Brands::find()->orderBy('order')->all();
        }
    }
    
    public function run() 
    {
        $itemsSlider = '';
        $itemsPanel = '';
        foreach($this->brands as $brand) 
        {
            $itemsSlider .= $this->getItem($brand, [], 'item_slider');
            $itemsPanel .= $this->getItem($brand, [], 'item_panels');
        }
        return $this->render(compact('itemsSlider', 'itemsPanel'));
    }
    
}

<?php

/*
 * 2021 Jan 31
 * File: OurworksBlock.php
 * Encoding: UTF-8
 * Project: RMS special for Quality Motors team
 * 
 * Author: Gafuroff Alexandr 
 * E-mail: gafuroff.al@yandex.ru
 */

namespace app\blocks\Ourworks;

use Yii;
use app\blocks\Block;
use app\models\Ourworks;

/**
 * Description of OurworksBlock
 *
 * @author Александр
 */
class OurworksBlock extends Block
{
    public function run() 
    {        
        $ourWorks = Ourworks::find()->where(['url_page' => Yii::$app->request->url])->one();
        if($ourWorks) {
            $itemsSlider = '';
            foreach(explode('|', $ourWorks->images) as $image) 
            {
                $itemsSlider .= $this->getItem($image, [], 'item_slider');
            }
            return $this->render(compact('itemsSlider'));
        }
        return '';
    }
}

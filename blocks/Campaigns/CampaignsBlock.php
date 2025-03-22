<?php

/*
 * 01.12.2020
 * File: CampaignsBlock.php
 * Encoding: UTF-8
 * Project: RMS special for Quality Motors team
 * 
 * Author: Gafuroff Alexandr 
 * E-mail: gafuroff.al@yandex.ru
 */

namespace app\blocks\Campaigns;

use app\blocks\Block;
use app\models\Brands;
use app\models\Campaigns;
use app\models\Models;

class CampaignsBlock extends Block
{
    /**
     * @var Brands|null
     */
    public $brand;
    /**
     * @var Models|null
     */
    public $model;
    public $campaigns;
    public $mt_0;
    public $h1;
    
    public function init() 
    {
        parent::init();
        if(is_null($this->campaigns)) {
            $this->campaigns = Campaigns::find()->cache()->where(['status' => 1])->orderBy('order')->all();
        }
    }
    
    public function run() 
    {
        $items = '';
        $mt_0 = $this->mt_0 ?? null;
        $h1 = $this->h1 ?? null;
        foreach($this->campaigns as $campaign) {            
            $items .= $this->getItem( $this->insertBrandModelName($campaign) );
        }
        return $this->render(compact('items', 'mt_0', 'h1'));
    }

    protected function insertBrandModelName($item)
    {
        if ($this->brand !== null) {
            $item->name = str_replace('BRAND_RUS', $this->brand->getNameRus(), $item->name);
            $item->name = str_replace('BRAND', $this->brand->name, $item->name);
            $item->anons = str_replace('BRAND_RUS', $this->brand->getNameRus(), $item->anons);
            $item->anons = str_replace('BRAND', $this->brand->name, $item->anons);
        }
        if ($this->model !== null) {
            $item->name = str_replace('MODEL_RUS', $this->model->getNameRus(), $item->name);
            $item->name = str_replace('MODEL', $this->model->name, $item->name);
            $item->anons = str_replace('MODEL_RUS', $this->model->getNameRus(), $item->anons);
            $item->anons = str_replace('MODEL', $this->model->name, $item->anons);
        }

        $item->name = str_replace(['BRAND_RUS', 'BRAND', 'MODEL_RUS', 'MODEL'], '', $item->name);
        $item->anons = str_replace(['BRAND_RUS', 'BRAND', 'MODEL_RUS', 'MODEL'], '', $item->anons);

        return $item;
    }
}

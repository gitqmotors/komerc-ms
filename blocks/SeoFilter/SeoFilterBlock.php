<?php

/*
 * 16.12.2020
 * File: SeoFilterBlock.php
 * Encoding: UTF-8
 * Project: RMS special for Quality Motors team
 * 
 * Author: Gafuroff Alexandr 
 * E-mail: gafuroff.al@yandex.ru
 */

namespace app\blocks\SeoFilter;

use app\blocks\Block;
use app\models\County;
use app\models\District;
use app\models\Metro;

/**
 * Description of RepareCarBlock
 *
 * @author nelset
 */
class SeoFilterBlock extends Block
{
    public $brand;
    public $model;
    public $subdomain;
    public $county;
    public $district;
    public $metroes;
   
    public function run()
    {

        if(is_null($this->county)) {
            $this->county = County::find()->all();
        }
        if(is_null($this->district)) {
            $this->district = District::find()->all();
        }
        if(is_null($this->metroes)) {
            $this->metroes = Metro::find()->all();
        }

        if ($this->subdomain == true){
            $url = "";
            $imageSrc = strtolower($this->brand->url);
        } else {
            $url = '/' .$this->brand->url;
            $imageSrc = strtolower($url);
        }
        $header = $this->brand->header;
        $hide_url_price_list = 0;
        if(!is_null($this->model)) {
            if ($this->subdomain == true){
                $url .= '/' . $this->model->url;
                $imageSrc = strtolower($this->brand->url.'/' . $this->model->url);
            } else {
                $url .= '/' . $this->model->url;
                $imageSrc = strtolower($url);
            }
            $header = $this->model->header;
            $hide_url_price_list = $this->model->hide_url_price_list;
        }

        $itemsCounty = '';
        $itemsMetro = '';
        $itemsDistrict = '';


        foreach($this->county as $count)
        {
            $itemsCounty .= $this->getItem($count, [], 'item_county');
        }

        foreach($this->district as $dist)
        {
            $itemsDistrict .= $this->getItem($dist, [], 'item_district');
        }

        foreach($this->metroes as $metro)
        {
            $itemsMetro .= $this->getItem($metro, [], 'item_metro');
        }

        return $this->render(compact('url', 'itemsCounty','itemsDistrict','itemsMetro', 'header', 'hide_url_price_list'));

    }    
}

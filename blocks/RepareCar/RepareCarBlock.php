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

namespace app\blocks\RepareCar;

use app\blocks\Block;
use app\models\Brands;
use app\models\Models;

class RepareCarBlock extends Block
{
    /**
     * @var Brands
     */
    public $brand;
    /**
     * @var Models|null
     */
    public $model;
    /**
     * @var bool
     */
    public $subdomain = false;
    /**
     * @var string|null
     */
    public $h2;

    public function run()
    {
        $url = '/' . $this->brand->url;
        $imageSrc = strtolower($url);

        if ($this->subdomain) {
            $url = '';
            $imageSrc = strtolower($this->brand->url);
        }

        $header = $this->brand->header;
        $hide_url_price_list = 0;

        if ($this->model !== null) {
            $url .= '/' . $this->model->url;
            $imageSrc = strtolower($url);

            if ($this->subdomain) {
                $imageSrc = strtolower($this->brand->url . '/' . $this->model->url);
            }

            $header = $this->model->header;
            $hide_url_price_list = $this->model->hide_url_price_list;
        }
        if (!empty($this->h2)) {
            $header = $this->h2;
        }

        return $this->render(compact('url', 'imageSrc', 'header', 'hide_url_price_list'));
    }
}

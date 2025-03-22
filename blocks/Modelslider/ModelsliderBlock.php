<?php

/*
 * 30.01.2021
 * File: ModelsliderBlock.php
 * Encoding: UTF-8
 * Project: RMS special for Quality Motors team
 * 
 * Author: Gafuroff Alexandr 
 * E-mail: gafuroff.al@yandex.ru
 */

namespace app\blocks\Modelslider;

use app\blocks\Block;
use app\models\Brands;
use app\models\Models;

class ModelsliderBlock extends Block
{
    /**
     * @var Brands
     */
    public $brand;
    /**
     * @var Models[]
     */
    public $models;
    /**
     * @var bool
     */
    public $subdomain;
    /**
     * @var string|null
     */
    public $h2;

    public function init()
    {
        parent::init();

        $this->models = Models::find()
            ->cache()
            ->where(['brand_id' => $this->brand->id])
            ->andWhere(['status' => 1])
            ->orderBy('order')
            ->all()
        ;
    }

    public function run()
    {
        $itemsSlider = '';
        $itemsPanel = '';
        $header = '';

        foreach ($this->models as $model) {
            $carImageUrl = mb_strtolower($this->brand->url . '/' . $model->url);

            if ($this->subdomain === false) {
                $model->url = $this->brand->url . '/' . $model->url;
            }

            $itemsSlider .= $this->getItem(
                $model,
                [
                    'imageUrl' => "/uploads/images/cars/$carImageUrl/small.png",
                ],
                'item_slider'
            );
            $itemsPanel .= $this->getItem(
                $model,
                [
                    'imageUrl' => "/uploads/images/cars/$carImageUrl/small.png",
                ],
                'item_panels'
            );
        }
        if (!empty($this->h2)) {
            $header = $this->h2;
        }

        return $this->render(compact('itemsSlider', 'itemsPanel', 'header'));
    }
}

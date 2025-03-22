<?php

/*
 * 02.12.2020
 * File: PricelistBlock.php
 * Encoding: UTF-8
 * Project: RMS special for Quality Motors team
 *
 * Author: Gafuroff Alexandr
 * E-mail: gafuroff.al@yandex.ru
 */

namespace app\blocks\Pricelist;

use app\blocks\Block;
use app\models\CommonServices;
use app\models\IndependensServices;
use app\models\Pricelist;

/**
 * Description of PricelistBlock
 *
 * @author Александр
 */
class PricelistBlock extends Block
{
    /**
     * @var Pricelist[]
     */
    protected $pricelist;
    protected $groupId;
    protected $priceId;

    public $brand;
    public $model;
    public $service;
    public $subdomain;
    public $h1;
    public $hprice;

    protected $header = 'Прайс-лист';
    protected $headerPostfix = ' цена:';

    public function init()
    {
        parent::init();
        $priceListQuery = Pricelist::find()->where(['hidden' => 0])->with(['indepservice', 'commonservice']);
        if($this->brand !== null) {
            $this->header = $this->brand->header . $this->headerPostfix;
        }
        if(!is_null($this->model)) {
            $this->header = $this->model->header . $this->headerPostfix;
        }
        if(!is_null($this->service)) {
            $header = $this->service->header;
            if (!is_null($this->brand)) {
                $header = preg_replace('/' . preg_quote($this->brand->name) . '/', '', $this->service->header, 1);
            }
            if (!is_null($this->model)) {
                $header = preg_replace('/' . preg_quote($this->model->name) . '/', '', $this->service->header, 1);
            }
            $this->header = $header . $this->headerPostfix;
            $this->groupId = $this->service->price_group_id;
            $this->priceId = $this->service->price_id;
        }
        if(!is_null($this->groupId)) {
            $priceListQuery->where(['OR', ['id' => $this->groupId], ['parent_id' => $this->groupId]]);
        }
        $this->pricelist = $priceListQuery->all();
        // Фильтруются услуги по ремонту трансмиссий DSG, если это не группа VAG
        $this->pricelist = array_filter($this->pricelist, function (Pricelist $item) {
            if ($this->brand !== null && !$this->brand->isVAG()) {
                if ($item->commonservice !== null && $item->commonservice->isDSG()) {
                    return false;
                }
                if ($item->indepservice !== null && $item->indepservice->isDSG()) {
                    return false;
                }
            }

            return true;
        });

        $this->preparePriceData();
    }

    protected function preparePriceData() {
        $pricelist = [];
        foreach($this->pricelist as $price) {

//            if($price->hidden === 0){
//                continue;
//            }
            $price->href = null;
            /**
             * @var CommonServices|null $priceCommonService
             * @var IndependensServices|null $priceIndepService
             */
            $priceCommonService = $price->commonservice;
            $priceIndepService = $price->indepservice;

            if ($this->brand !== null) {
                if ($this->model !== null) {
                    if ($this->subdomain === true AND $priceCommonService) {
                        $price->href = '/' . $this->model->url . '/' . $priceCommonService->url . '/';
                    } elseif ($priceCommonService) {
                        $price->href = '/' . $this->brand->url . '/' . $this->model->url . '/' . $priceCommonService->url . '/';

                        if ($priceCommonService->isHiddenService() && $this->model->hide_url_price_list) {
                            $price->href = null;
                        }
                    }
                    if (str_contains($price->href ?? '', 'promyvka_drosselnoi_zaslonki/')) {
                        $price->href = null;
                    }
                } elseif ($this->subdomain === true AND $priceCommonService) {
                    $price->href = '/' . $priceCommonService->url . '/';
                } elseif ($priceCommonService) {
                    $price->href = '/' . $this->brand->url . '/' . $priceCommonService->url . '/';
                }
                if (str_contains($price->href ?? '', 'zamena_zadnih_tormoznyh_kolodok_barabany_594')) {
                    $price->href = null;
                }
            } elseif ($priceIndepService) {
                $price->href = '/' . $priceIndepService->url . '/';
            }
            if($price->parent_id === null) {
                $pricelist[$price->id] = $price;
            }
        }
        foreach($this->pricelist as $price) {
            $first = false;
            if(!is_null($price->parent_id)) {
                if(!is_null($this->priceId) && $this->priceId == $price->id) {
                    $first = true;
                }
                if(isset($pricelist[$price->parent_id]))
                    $pricelist[$price->parent_id]->insertChild($price, $first);
            }
        }
        $this->pricelist = $pricelist;
    }

    protected function getPriceGroup($group, $items, $iter)
    {
        ob_start();
        include __DIR__ . '/views/group.php';
        return ob_get_clean();
    }

    protected function generatePriceItems($priceChildren)
    {
        $items = '';
        foreach($priceChildren as $item) {
            $items .= $this->getItem($item);
        }
        return $items;
    }

    protected function generatePriceGroups()
    {
        $groups = '';
        $iter = 0;
        foreach($this->pricelist as $group) {
            $iter++;
            $items = $this->generatePriceItems($group->children);
            $groups .= $this->getPriceGroup($group, $items, $iter);
        }
        return $groups;
    }

    public function run()
    {

        if(!empty($this->hprice)){
            $this->header = $this->hprice;
        }
        return $this->render([
            'header' => $this->header,
            'groups' => $this->generatePriceGroups(),
            'h1' => $this->h1 ?? null,
        ]);
    }
}

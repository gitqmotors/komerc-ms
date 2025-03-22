<?php

/*
 * 03.12.2020
 * File: item.php
 * Encoding: UTF-8
 * Project: RMS special for Quality Motors team
 * 
 * Author: Gafuroff Alexandr 
 * E-mail: gafuroff.al@yandex.ru
 */

use app\blocks\Promo\PromoBlock;
use app\blocks\RepareCar\RepareCarBlock;
use app\blocks\SeoFilter\SeoFilterBlock;
use app\blocks\Modelslider\ModelsliderBlock;
use app\blocks\Campaigns\CampaignsBlock;
use app\blocks\Pricelist\PricelistBlock;
use app\blocks\Underprice\UnderpriceBlock;
use app\blocks\Advantages\AdvantagesBlock;
use app\blocks\SeoText\SeoTextBlock;
use app\blocks\Contacts\ContactsBlockDist;
use app\helpers\Specsymbols;
use app\helpers\Subdomains;
use yii\widgets\Breadcrumbs;

// Генерация метатегов
$this->title = $core->getTitle($brand->title, true);
$this->registerMetaTag(['name' => 'description', 'content' => Specsymbols::replace($core->getDescription($brand->description, true))]);
$this->registerMetaTag(['name' => 'keywords', 'content' => $core->getKeywords($brand->keywords, true)]);


if (Subdomains::getStatus() == false) {
    // Хлебные крошки
    $this->params['breadcrumbs'][] = ['label' => $core['name'], 'url' => '/' . $core['url'] . '/'];
    $this->params['breadcrumbs'][] = $brand->name;

    // Canonical
    $this->params['canonical'] = $brand->url;
} 


?>
<!-- Первый блок начало -->
<?= PromoBlock::block([
    'h1' => $brand->header,
    'brandName' => $brand->name,
    'dist' =>  "1"
]); ?>
<!-- Конец Первый блок -->

<div class="breadcrumbs">
    <div class="container container2">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
    </div>
</div>

<!-- Блок РЕМОНТ АВТО начало -->
<?= RepareCarBlock::block([
    'brand' => $brand,
    'h2' => $h2,
    'subdomain' => Subdomains::getStatus()
]); ?>
<!-- Конец Блока РЕМОНТ АВТО -->


<!-- Блок Акции начало -->
<?= CampaignsBlock::block([
    'brand' => $brand
]); ?>
<!-- Конец Блока Акции -->

<!-- Начало БЛОКА ПРАЙС-ЛИСТ -->
<?= PricelistBlock::block([
    'brand' => $brand,
    'subdomain' => Subdomains::getStatus(),
    'hprice' => $hprice
]); ?>
<!--Конец БЛОКА ПРАЙС-ЛИСТ-->

<!-- Начало подпрайсовый блок -->
<?= UnderpriceBlock::block([
    'brand' => $brand
]); ?>
<!-- Конец подпрайсовый блок -->

<!-- БЛОК ПРЕИМУЩЕСТВА начало -->
<?/*= AdvantagesBlock::block([
    'brand' => $brand
]); */?>
<!-- конец БЛОКА ПРЕИМУЩЕСТВА -->

<!-- Начало Блок СЕО текста -->
<?/*= SeoTextBlock::block([
    'header' => $brand->header,
    'text' => $brand->text
]); */?>
<!-- Конец Блок СЕО текста -->

<!-- БЛОК КАРТА начало -->
 <?= ContactsBlockDist::block([
     'filter' => $dist
 ]); ?>
<!-- Конец БЛОКА КАРТА -->
<?php

/*
 * 03.12.2020
 * File: index.php
 * Encoding: UTF-8
 * Project: RMS special for Quality Motors team
 * 
 * Author: Gafuroff Alexandr 
 * E-mail: gafuroff.al@yandex.ru
 */

use app\blocks\Brandslider\BrandsliderBlock;
use app\blocks\Promo\PromoBlock;
use app\blocks\RepareCar\RepareCarBlock;
use app\blocks\SeoFilter\SeoFilterBlock;
use app\blocks\Modelslider\ModelsliderBlock;
use app\blocks\Campaigns\CampaignsBlock;
use app\blocks\Pricelist\PricelistBlock;
use app\blocks\Underprice\UnderpriceBlock;
use app\blocks\Advantages\AdvantagesBlock;
use app\blocks\SeoText\SeoTextBlock;
use app\blocks\Contacts\ContactsBlock;
use app\helpers\Specsymbols;
use app\helpers\Subdomains;
use yii\widgets\Breadcrumbs;
// Получаем данные для главных страниц разделов (и приравненых к таковым)
$currentPage = Yii::$app->controller->currentPage;

// Генерация метатегов
if(isset($brand)) {
    $brandRuName = trim($brand->rus_name, '( )');
    $this->title = 'Ремонт ' . $brandRuName . ' в Москве - автосервис '
        . $brand->name . ' Раннинг Моторс';
    $this->registerMetaTag(['name' => 'description', 'content' => "Ремонт " . $brand->name . ' ' . '(' . $brandRuName . ')' .
        " цена в Москве. ⭐ Специализированный автосервис " . $brand->name . '. ✅ Гарантия на ремонт ' . $brandRuName . ' 2 года. ✅ Дешевле диллера до 60%']);
    $this->registerMetaTag(['name' => 'keywords', 'content' => $currentPage->getKeywords()]);
    $this->registerMetaTag(['property' => 'og:title', 'content' => 'Ремонт ' . $brandRuName . ' в Москве - автосервис '
        . $brand->name . ' Раннинг Моторс']);
    $this->registerMetaTag(['property' => 'og:description', 'content' => "Ремонт " . $brand->name . ' ' . '(' . $brandRuName . ')' .
        " цена в Москве. ⭐ Специализированный автосервис " . $brand->name . '. ✅ Гарантия на ремонт ' . $brandRuName . ' 2 года. ✅ Дешевле диллера до 60%']);
}
else {
    $this->title = $currentPage->getTitle();
    $this->registerMetaTag(['name' => 'description', 'content' => $currentPage->getDescription()]);
    $this->registerMetaTag(['name' => 'keywords', 'content' => $currentPage->getKeywords()]);
}
if (!Subdomains::getStatus()) {
    // Хлебные крошки
    $this->params['breadcrumbs'][] = $currentPage->name;
}
// Canonical
$this->params['canonical'] = $currentPage->url;

?>
<!-- Первый блок начало -->
<?= PromoBlock::block([
    'h1' => $currentPage->header
]); ?>
<!-- Конец Первый блок -->

<div class="breadcrumbs">
    <div class="container container2">
        <?= Breadcrumbs::widget([
            'links' => $this->params['breadcrumbs'] ?? [],
        ]) ?>
    </div>
</div>

<!-- Блок со слайдером марок авто начало -->
<?= BrandsliderBlock::block(); ?>
<!-- Конец Блок со слайдером марок авто -->

<!-- БЛОК КАРТА начало -->
<?= ContactsBlock::block(); ?>
<!-- Конец БЛОКА КАРТА -->
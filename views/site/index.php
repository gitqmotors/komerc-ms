<?php

/*
 * 24.11.2020
 * File: block.php
 * Encoding: UTF-8
 * Project: RMS special for Quality Motors team
 * 
 * Author: Gafuroff Alexandr 
 * E-mail: gafuroff.al@yandex.ru
 */

/* @var $this yii\web\View */

use app\blocks\Promo\PromoBlock;
use app\blocks\Brandslider\BrandsliderBlock;
use app\blocks\Services\ServicesBlock;
use app\blocks\Campaigns\CampaignsBlock;
use app\blocks\Ourworks\OurworksBlock;
use app\blocks\Pricelist\PricelistBlock;
use app\blocks\Underprice\UnderpriceBlock;
use app\blocks\Advantages\AdvantagesBlock;
use app\blocks\Contacts\ContactsBlock;
use app\helpers\Specsymbols;

// Получаем данные для главных страниц разделов (и приравненых к таковым)
$currentPage = Yii::$app->controller->currentPage;

// Генерация метатегов
$this->title = $currentPage->getTitle();
$this->registerMetaTag(['name' => 'description', 'content' => Specsymbols::replace($currentPage->getDescription())]);
$this->registerMetaTag(['name' => 'keywords', 'content' => $currentPage->getKeywords()]);

// Хлебные крошки
$this->params['breadcrumbs'][] = $currentPage->name;

?>

<!-- Первый блок начало -->
<?= PromoBlock::block(); ?>
<!-- Конец Первый блок -->

<!-- Блок со слайдером марок авто начало -->
<?= BrandsliderBlock::block(); ?>
<!-- Конец Блок со слайдером марок авто -->

<!-- Блок Цены начало -->
<?= ServicesBlock::block(); ?>
<!-- Конец Блок Цены -->

<!-- Блок Акции начало -->
<?= CampaignsBlock::block(); ?>
<!-- Конец Блока Акции -->

<!-- Блок Наши работы начало -->
<?= OurworksBlock::block(); ?>
<!-- Конец Блока Наши работы -->

<!-- Начало БЛОКА ПРАЙС-ЛИСТ -->
<?php
$cacheKey = md5(PricelistBlock::class . __FILE__);

if ($this->beginCache($cacheKey, ['duration' => -1])) {
    echo PricelistBlock::block();

    $this->endCache();
}
?>
<!--Конец БЛОКА ПРАЙС-ЛИСТ-->

<!-- Начало подпрайсовый блок -->
<?= UnderpriceBlock::block(); ?>
<!-- Конец подпрайсовый блок -->

<!-- БЛОК ПРЕИМУЩЕСТВА начало -->
<?= AdvantagesBlock::block(); ?>
<!-- конец БЛОКА ПРЕИМУЩЕСТВА -->

<!-- БЛОК КАРТА начало -->
<?= ContactsBlock::block(); ?>
<!-- Конец БЛОКА КАРТА -->
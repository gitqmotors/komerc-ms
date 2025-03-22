<?php

/*
 * 03.12.2020
 * File: service.php
 * Encoding: UTF-8
 * Project: RMS special for Quality Motors team
 * 
 * Author: Gafuroff Alexandr 
 * E-mail: gafuroff.al@yandex.ru
 */

use app\blocks\Campaigns\CampaignsBlock;
use app\blocks\Promo\PromoBlock;
use app\blocks\Ourworks\OurworksBlock;
use app\blocks\Pricelist\PricelistBlock;
use app\blocks\Underprice\UnderpriceBlock;
use app\blocks\Advantages\AdvantagesBlock;
use app\blocks\SeoText\SeoTextBlock;
use app\blocks\Contacts\ContactsBlock;
use yii\widgets\Breadcrumbs;
use app\helpers\Subdomains;

/**
 * @var \app\models\Brands $brand
 * @var \app\models\CommonServices $service
 * @var \app\models\Mainpages $core
 */

$checkmark = "\u{2714}\u{FE0F}";

// Нужно для передачи в главный шаблон в блок footer-copyright
$this->params['brandName'] = $brand->name;
$this->params['brandNameRus'] = $brand->getNameRus();

// Генерация метатегов
$this->title = "$service->name $brand->name ({$brand->getNameRus()}) цена в Москве | Автосервис {$brand->getNameRus()} Раннинг Моторс";
$this->registerMetaTag(['name' => 'title', 'content' => $this->title]);
$this->registerMetaTag(['name' => 'keywords', 'content' => $core->getKeywords($service->keywords, true)]);
$this->registerMetaTag(['property' => 'og:title', 'content' => $this->title]);

if($service->id == 1 or $service->parent_id == 1) {
    $description = $service->name . " $brand->name ({$brand->getNameRus()}) цена в Москве. ⭐ Специализированный сервис $brand->name. $checkmark Дешевле дилера до 55%. $checkmark Запчасти в наличии.";
    $this->registerMetaTag(['name' => 'description', 'content' => $description]);
    $this->registerMetaTag(['property' => 'og:description', 'content' => $description]);
}

if($service->id == 2 or $service->parent_id == 2) {
    $description = $service->name . " $brand->name ({$brand->getNameRus()}) цена в Москве. ⭐ Специализированный сервис $brand->name. $checkmark Диагностика ходовой в подарок. $checkmark Гарантия на ремонт до 2 лет.";
    $this->registerMetaTag(['name' => 'description', 'content' => $description]);
    $this->registerMetaTag(['property' => 'og:description', 'content' => $description]);
}

if($service->id == 3 or $service->parent_id == 3) {
    $description = $service->name . " $brand->name ({$brand->getNameRus()}) цена в Москве. ⭐ Специализированный сервис $brand->name. $checkmark Гарантия до 2 лет. $checkmark Опытные мотористы.";
    $this->registerMetaTag(['name' => 'description', 'content' => $description]);
    $this->registerMetaTag(['property' => 'og:description', 'content' => $description]);
}

if($service->id == 4 or $service->parent_id == 4) {
    $description = $service->name . " $brand->name ({$brand->getNameRus()}) цена в Москве. ⭐ Специализированный сервис $brand->name. $checkmark Пожизненная гарантия. $checkmark Минимальные сроки ремонта.";
    $this->registerMetaTag(['name' => 'description', 'content' => $description]);
    $this->registerMetaTag(['property' => 'og:description', 'content' => $description]);
}

if($service->id == 5 or $service->parent_id == 5) {
    $description = $service->name . " $brand->name ({$brand->getNameRus()}) цена в Москве. ⭐ Специализированный сервис $brand->name. $checkmark Озвучим стоимость до начала работ. $checkmark Пожизненная гарантия.";
    $this->registerMetaTag(['name' => 'description', 'content' => $description]);
    $this->registerMetaTag(['property' => 'og:description', 'content' => $description]);
}

if($service->id == 6 or $service->parent_id == 6) {
    $description = $service->name . " $brand->name ({$brand->getNameRus()}) цена в Москве. ⭐ Специализированный сервис $brand->name. $checkmark Любая сложность. $checkmark Ремонт в 3 раза дешевле, чем покупка новой детали.";
    $this->registerMetaTag(['name' => 'description', 'content' => $description]);
    $this->registerMetaTag(['property' => 'og:description', 'content' => $description]);
}

if($service->id == 7 or $service->parent_id == 7) {
    $description = $service->name . " $brand->name ({$brand->getNameRus()}) цена в Москве. ⭐ Специализированный сервис $brand->name. $checkmark Материалы премиум класса. $checkmark Комплексный уход за авто.";
    $this->registerMetaTag(['name' => 'description', 'content' => $description]);
    $this->registerMetaTag(['property' => 'og:description', 'content' => $description]);
}

if($service->id == 9 or $service->parent_id == 9) {
    $description = $service->name . " $brand->name ({$brand->getNameRus()}) цена в Москве. ⭐ Специализированный сервис $brand->name. $checkmark Дилерское оборудование. $checkmark Опытные диагносты.";
    $this->registerMetaTag(['name' => 'description', 'content' => $description]);
    $this->registerMetaTag(['property' => 'og:description', 'content' => $description]);
}

if($service->id == 10 or $service->parent_id == 10) {
    $description = $service->name . " $brand->name ({$brand->getNameRus()}) цена в Москве. ⭐ Специализированный сервис $brand->name. $checkmark Гарантия на ремонт до 2 лет. $checkmark Бесплатный эвакуатор.";
    $this->registerMetaTag(['name' => 'description', 'content' => $description]);
    $this->registerMetaTag(['property' => 'og:description', 'content' => $description]);
}

if($service->id == 11 or $service->parent_id == 11) {
    $description = $service->name . " $brand->name ({$brand->getNameRus()}) цена в Москве. ⭐ Специализированный сервис $brand->name. $checkmark Диагностика рулевого управления в подарок. $checkmark Дешевле дилера до 55%.";
    $this->registerMetaTag(['name' => 'description', 'content' => $description]);
    $this->registerMetaTag(['property' => 'og:description', 'content' => $description]);
}

if($service->id == 12 or $service->parent_id == 12) {
    $description = $service->name . " $brand->name ({$brand->getNameRus()}) цена в Москве. ⭐ Специализированный сервис $brand->name. $checkmark Диагностика тормозной системы в подарок. $checkmark Дешевле дилера до 55%.";
    $this->registerMetaTag(['name' => 'description', 'content' => $description]);
    $this->registerMetaTag(['property' => 'og:description', 'content' => $description]);
}

if($service->id == 13 or $service->parent_id == 13) {
    $description = $service->name . " $brand->name ({$brand->getNameRus()}) цена в Москве. ⭐ Специализированный сервис $brand->name. $checkmark Качественная диагностика. $checkmark Озвучиваем стоимость до начала работ.";
    $this->registerMetaTag(['name' => 'description', 'content' => $description]);
    $this->registerMetaTag(['property' => 'og:description', 'content' => $description]);
}

if($service->id == 14 or $service->parent_id == 14) {
    $description = $service->name . " $brand->name ({$brand->getNameRus()}) цена в Москве. ⭐ Специализированный сервис $brand->name. $checkmark Запчасти в наличии. $checkmark Гарантия на ремонт 2 года.";
    $this->registerMetaTag(['name' => 'description', 'content' => $description]);
    $this->registerMetaTag(['property' => 'og:description', 'content' => $description]);
}

if($service->id == 15 or $service->parent_id == 15) {
    $description = $service->name . " $brand->name ({$brand->getNameRus()}) цена в Москве. ⭐ Специализированный сервис $brand->name. $checkmark Гарантия на все виды работ. $checkmark Опытные мотористы.";
    $this->registerMetaTag(['name' => 'description', 'content' => $description]);
    $this->registerMetaTag(['property' => 'og:description', 'content' => $description]);
}

if($service->id == 17 or $service->parent_id == 17) {
    $description = $service->name . " $brand->name ({$brand->getNameRus()}) цена в Москве. ⭐ Специализированный сервис $brand->name. $checkmark Диагностика, заправка, ремонт кондиционера. $checkmark Фиксированные цены.";
    $this->registerMetaTag(['name' => 'description', 'content' => $description]);
    $this->registerMetaTag(['property' => 'og:description', 'content' => $description]);
}

if($service->id == 128 or $service->parent_id == 128) {
    $description = $service->name . " $brand->name ({$brand->getNameRus()}) цена в Москве. ⭐ Специализированный сервис $brand->name. $checkmark Помощь в подборе шин. $checkmark Фиксированная стоимость.";
    $this->registerMetaTag(['name' => 'description', 'content' => $description]);
    $this->registerMetaTag(['property' => 'og:description', 'content' => $description]);
}

if($service->id == 197 or $service->parent_id == 197) {
    $description = $service->name . " $brand->name ({$brand->getNameRus()}) цена в Москве. ⭐ Специализированный сервис $brand->name. $checkmark Дилерское оборудование. $checkmark Опытные электрики-диагносты.";
    $this->registerMetaTag(['name' => 'description', 'content' => $description]);
    $this->registerMetaTag(['property' => 'og:description', 'content' => $description]);
}




if (!Subdomains::getStatus()) {
    // Хлебные крошки
//    $this->params['breadcrumbs'][] = ['label' => $core['name'], 'url' => '/' . $core['url'] . '/'];
    $this->params['breadcrumbs'][] = ['label' => 'Автосервис ' . $brand->name, 'url' => '/' . $brand->url . '/'];
    $this->params['breadcrumbs'][] = $service->name;
    // Canonical
    $this->params['canonical'] = $brand->url . '/' . $service->url;
} else {
    // Хлебные крошки
    $this->params['breadcrumbs'][] = $service->name;
    // Canonical
    $this->params['canonical'] = $service->url;
}


// Инициализировать параметр "детейлинг"
if ($service->type == 'detailing') {
    $this->params['detailing'] = true;
}
?>
<!-- Первый блок начало -->
<?= PromoBlock::block([
    'h1' => $service->name . ' ' . $brand->name . ' ' . $brand->rus_name ,
    'brandName' => $brand->name,
    'brandNameRus' => $brand->getNameRus(),
    'detailing' => ($service->type == 'detailing'),
    'groupId' => $service->price_group_id,
]); ?>
<!-- Конец Первый блок -->

<div class="breadcrumbs">
    <div class="container container2">
        <?= Breadcrumbs::widget([
            'links' => $this->params['breadcrumbs'] ?? [],
        ]) ?>
    </div>
</div>

<!-- Блок Наши работы начало -->
<?= OurworksBlock::block(); ?>
<!-- Конец Блока Наши работы -->

<!-- Блок Акции начало -->
<?= CampaignsBlock::block(['brand' => $brand]); ?>
<!-- Конец Блока Акции -->

<!-- Начало БЛОКА ПРАЙС-ЛИСТ -->
<?php if ($service->type != 'zapchasty'): ?>
    <?= PricelistBlock::block([
        'brand' => $brand,
        'service' => $service,
        'subdomain' => Subdomains::getStatus(),
    ]); ?>
    <!--Конец БЛОКА ПРАЙС-ЛИСТ-->

    <!-- Начало подпрайсовый блок -->
    <?= UnderpriceBlock::block([
        'brand' => $brand,
        'detailing' => ($service->type == 'detailing'),
    ]); ?>
<?php endif; ?>
<!-- Конец подпрайсовый блок -->

<!-- Начало Блок СЕО текста -->
<?= SeoTextBlock::block([
    'header' => $service->header,
    'text' => $service->text,
    'brand' => $brand,
    'service' => $service
]); ?>
<!-- Конец Блок СЕО текста -->

<!-- БЛОК ПРЕИМУЩЕСТВА начало -->
<?php if ($service->type != 'zapchasty' && $service->type != 'detailing'): ?>
    <noindex>
    <?= AdvantagesBlock::block([
        'brand' => $brand
    ]); ?>
    </noindex>
<?php endif; ?>
<!-- конец БЛОКА ПРЕИМУЩЕСТВА -->

<!-- БЛОК КАРТА начало -->
<?= ContactsBlock::block([
    'detailing' => ($service->type == 'detailing'),
    'h2' => "Сеть специализированных автосервисов $brand->name ({$brand->getNameRus()}) Раннинг Моторс",
]); ?>
<!-- Конец БЛОКА КАРТА -->

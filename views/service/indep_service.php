<?php

/*
 * 03.12.2020
 * File: indep_service.php
 * Encoding: UTF-8
 * Project: RMS special for Quality Motors team
 * 
 * Author: Gafuroff Alexandr 
 * E-mail: gafuroff.al@yandex.ru
 */

use app\blocks\Promo\PromoBlock;
use app\blocks\Ourworks\OurworksBlock;
use app\blocks\Pricelist\PricelistBlock;
use app\blocks\Underprice\UnderpriceBlock;
use app\blocks\Advantages\AdvantagesBlock;
use app\blocks\SeoText\SeoTextBlock;
use app\blocks\Contacts\ContactsBlock;
use app\helpers\Specsymbols;
use yii\widgets\Breadcrumbs;

/**
 * @var \app\models\IndependensServices $service
 * @var \app\models\Mainpages $core
 */

$checkmark = "\u{2714}\u{FE0F}";
// Генерация метатегов
//$this->title = $core->getTitle($service->title, true);
$this->title = $service->name . ' в Москве - Раннинг Моторс';
//$this->registerMetaTag(['name' => 'description', 'content' => $core->getDescription(Specsymbols::replace($service->description), true)]);
$this->registerMetaTag(['name' => 'keywords', 'content' => $core->getKeywords($service->keywords, true)]);
$this->registerMetaTag(['property' => 'og:title', 'content' => $this->title]);
if($service->id == 1 or $service->parent_id == 1) {
    $description = $service->name . " цена. ⭐ Сеть специализированных автосервисов в Москве. $checkmark Запчасти в наличии. $checkmark Дешевле дилера до 55%.";
    $this->registerMetaTag(['name' => 'description', 'content' => $description]);
    $this->registerMetatag(['property' => 'og:description', 'content' => $description]);
}
if($service->id == 9 or $service->parent_id == 9) {
    $description = $service->name . " цена. ⭐ Сеть специализированных автосервисов в Москве. $checkmark Диагностика по 43 пунктам в подарок. $checkmark Дилерское оборудование.";
    $this->registerMetaTag(['name' => 'description', 'content' => $description]);
    $this->registerMetaTag(['property' => 'og:description', 'content' => $description]);
}
if($service->id == 10 or $service->parent_id == 10 or $service->id == 3 or $service->parent_id ==3
or $service->id == 603 or $service->parent_id == 603) {
    $description = $service->name . " цена. ⭐ Сеть специализированных автосервисов в Москве. $checkmark Гарантия на ремонт 2 года. $checkmark Бесплатный эвакуатор при ремонте.";
    $this->registerMetaTag(['name' => 'description', 'content' => $description]);
    $this->registerMetaTag(['property' => 'og:description', 'content' => $description]);
}
if($service->id == 2 or $service->parent_id == 2 or $service->id == 11 or $service->parent_id == 11 or
    $service->id == 12 or $service->parent_id == 12) {
    $description = $service->name . " цена. ⭐ Сеть специализированных автосервисов в Москве. $checkmark Гарантия на ремонт 2 года. $checkmark Диагностика по 43 пунктам в подарок.";
    $this->registerMetaTag(['name' => 'description', 'content' => $description]);
    $this->registerMetaTag(['property' => 'og:description', 'content' => $description]);
}
if($service->id == 17 or $service->parent_id == 17 or $service->id == 197 or $service->parent_id == 197) {
    $description = $service->name . " цена. ⭐ Сеть специализированных автосервисов в Москве. $checkmark Дилерское оборудование. $checkmark Опытные электрики.";
    $this->registerMetaTag(['name' => 'description', 'content' => $description]);
    $this->registerMetaTag(['property' => 'og:description', 'content' => $description]);
}
if($service->id == 13 or $service->parent_id == 13 or $service->id == 14 or $service->parent_id == 14
or $service->id == 15 or $service->parent_id == 15 or $service->id == 6 or $service->parent_id == 6) {
    $description = $service->name . " цена. ⭐ Сеть специализированных автосервисов в Москве. $checkmark Гарантия на ремонт 2 года. $checkmark Стоимость до начала работ.";
    $this->registerMetaTag(['name' => 'description', 'content' => $description]);
    $this->registerMetaTag(['property' => 'og:description', 'content' => $description]);
}
if($service->id == 4 or $service->parent_id == 4 or $service->id == 5 or $service->parent_id == 5) {
    $description = $service->name . " цена. ⭐ Сеть специализированных автосервисов в Москве. $checkmark Пожизненная гарантия на кузовной ремонт. $checkmark Соблюдение сроков.";
    $this->registerMetaTag(['name' => 'description', 'content' => $description]);
    $this->registerMetaTag(['property' => 'og:description', 'content' => $description]);
}
if($service->id == 128 or $service->parent_id == 128) {
    $description = $service->name . " цена. ⭐ Сеть автосервисов в Москве. $checkmark Шиномонтаж любого радиуса колеса. $checkmark Делаем качественно.";
    $this->registerMetaTag(['name' => 'description', 'content' => $description]);
    $this->registerMetaTag(['property' => 'og:description', 'content' => $description]);
}
if($service->id == 7 or $service->parent_id == 7) {
    $description = $service->name . " цена. ⭐ Сеть детейлинг студий в Москве. $checkmark Вернем вид нового авто. $checkmark Материалы премиум класса.";
    $this->registerMetaTag(['name' => 'description', 'content' => $description]);
    $this->registerMetaTag(['property' => 'og:description', 'content' => $description]);
}
// Хлебные крошки
//$this->params['breadcrumbs'][] = ['label' => $core['name'], 'url' => '/' . $core['url'] . '/'];
$this->params['breadcrumbs'][] = $service->name;

// Canonical
$this->params['canonical'] = $service->url;

// Инициализировать параметр "детейлинг"
if ($service->type == 'detailing') {
    $this->params['detailing'] = true;
}
?>
<!-- Первый блок начало -->
<?= PromoBlock::block([
    'h1' => $service->header,
    'detailing' => ($service->type == 'detailing'),
    'groupId' => $service->price_group_id,
]); ?>
<!-- Конец Первый блок -->

<div class="breadcrumbs">
    <div class="container container2">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
    </div>
</div>

<!-- Блок Наши работы начало -->
<?= OurworksBlock::block(); ?>
<!-- Конец Блока Наши работы -->

<!-- Начало БЛОКА ПРАЙС-ЛИСТ -->
<?= PricelistBlock::block([
    'service' => $service
]); ?>
<!--Конец БЛОКА ПРАЙС-ЛИСТ-->

<!-- Начало подпрайсовый блок -->
<?= UnderpriceBlock::block(['detailing' => ($service->type == 'detailing')]); ?>
<!-- Конец подпрайсовый блок -->

<?php if ($service->type != 'detailing') : ?>
<!-- БЛОК ПРЕИМУЩЕСТВА начало -->
<noindex>
<?= AdvantagesBlock::block(); ?>
</noindex>
<!-- конец БЛОКА ПРЕИМУЩЕСТВА -->
<?php endif; ?>

<!-- Начало Блок СЕО текста -->
<?= SeoTextBlock::block([
    'header' => $service->header,
    'text' => $service->text
]); ?>
<!-- Конец Блок СЕО текста -->

<!-- БЛОК КАРТА начало -->
<?= ContactsBlock::block(['detailing' => ($service->type == 'detailing')]); ?>
<!-- Конец БЛОКА КАРТА -->
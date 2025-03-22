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
use app\blocks\Contacts\ContactsBlock;
use app\helpers\Specsymbols;
use app\helpers\Subdomains;
use yii\widgets\Breadcrumbs;

/**
 * @var \app\models\Brands $brand
 * @var \app\models\Models[] $models
 * @var \app\models\Mainpages $core
 */

$checkmark = "\u{2714}\u{FE0F}";

// Нужно для передачи в главный шаблон в блок footer-copyright
$this->params['brandName'] = $brand->name;
$this->params['brandNameRus'] = $brand->getNameRus();

// Генерация метатегов
$this->title = "Ремонт $brand->name ({$brand->getNameRus()}) в Москве | Цены в автосервисе {$brand->getNameRus()} Раннинг Моторс";
$description = "Ремонт $brand->name ({$brand->getNameRus()}) цена в Москве. ⭐ Специализированный автосервис $brand->name. $checkmark Гарантия на ремонт {$brand->getNameRus()} 2 года. $checkmark Дешевле диллера до 60%";
$this->registerMetaTag(['name' => 'description', 'content' => $description]);
$this->registerMetaTag(['name' => 'keywords', 'content' => $core->getKeywords($brand->keywords, true)]);
$this->registerMetaTag(['property' => 'og:title', 'content' => $this->title]);
$this->registerMetaTag(['property' => 'og:description', 'content' => $description]);
?>



<?php
if (!Subdomains::getStatus()) {
    // Хлебные крошки
//    $this->params['breadcrumbs'][] = ['label' => $core['name'], 'url' => '/' . $core['url'] . '/'];
    $this->params['breadcrumbs'][] = 'Автосервис ' . $brand->name;

    // Canonical
    $this->params['canonical'] = $brand->url;
} 


?>
<!-- Первый блок начало -->
<?= PromoBlock::block([
    'h1' => $brand->header,
    'brandName' => $brand->name,
    'brandNameRus' => $brand->getNameRus(),
]); ?>
<!-- Конец Первый блок -->

<div class="breadcrumbs">
    <div class="container container2">
        <?= Breadcrumbs::widget([
            'links' => $this->params['breadcrumbs'] ?? [],
        ]) ?>
    </div>
</div>

<!-- Блок РЕМОНТ АВТО начало -->
<?= RepareCarBlock::block([
    'brand' => $brand,
    'subdomain' => Subdomains::getStatus(),
    'h2' => "Ремон и сервис $brand->name ({$brand->getNameRus()})",
]); ?>
<!-- Конец Блока РЕМОНТ АВТО -->

<!-- Блок со слайдером моделей авто начало -->
<?php
$cacheKey = md5(ModelsliderBlock::class . __FILE__ . $brand->name);

if ($this->beginCache($cacheKey, ['duration' => -1])) {
    echo ModelsliderBlock::block([
         'brand' => $brand,
         'subdomain' => Subdomains::getStatus(),
         'h2' => 'Выбрать модель авто',
     ]);

    $this->endCache();
}
?>
<!-- Конец Блок со слайдером моделей авто -->

<!-- Блок Акции начало -->
<?= CampaignsBlock::block([
    'brand' => $brand
]); ?>
<!-- Конец Блока Акции -->

<!-- Начало БЛОКА ПРАЙС-ЛИСТ -->
<?= PricelistBlock::block([
    'brand' => $brand,
    'subdomain' => Subdomains::getStatus()

]); ?>
<!--Конец БЛОКА ПРАЙС-ЛИСТ-->

<!-- Блок СЕО Фильтр начало -->

<?php
if($brand->seo_filter === 1){
    echo SeoFilterBlock::block([
        'brand' => $brand,
        'subdomain' => Subdomains::getStatus()
    ]);
}
?>
<!-- Конец Блока СЕО Фильтр АВТО -->

<!-- Начало подпрайсовый блок -->
<?= UnderpriceBlock::block([
    'brand' => $brand
]); ?>
<!-- Конец подпрайсовый блок -->

<!-- БЛОК ПРЕИМУЩЕСТВА начало -->
<?= AdvantagesBlock::block([
    'brand' => $brand
]); ?>
<!-- конец БЛОКА ПРЕИМУЩЕСТВА -->

<!-- Начало Блок СЕО текста -->
<?= SeoTextBlock::block([
    'header' => $brand->header,
    'text' => $brand->text
]); ?>
<!-- Конец Блок СЕО текста -->

<!-- БЛОК КАРТА начало -->
<?= ContactsBlock::block([
    'h2' => "Сеть специализированных автосервисов $brand->name ({$brand->getNameRus()}) Раннинг Моторс",
]); ?>
<!-- Конец БЛОКА КАРТА -->
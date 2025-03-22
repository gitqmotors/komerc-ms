<?php

/*
 * 2021 Jan 30
 * File: index.php
 * Encoding: UTF-8
 * Project: RMS special for Quality Motors team
 *
 * Author: Gafuroff Alexandr
 * E-mail: gafuroff.al@yandex.ru
 */

use app\blocks\Modelslider\ModelsliderBlock;
use app\blocks\Promo\PromoBlock;
use app\blocks\RepareCar\RepareCarBlock;
use app\blocks\Campaigns\CampaignsBlock;
use app\blocks\Pricelist\PricelistBlock;
use app\blocks\Underprice\UnderpriceBlock;
use app\blocks\Advantages\AdvantagesBlock;
use app\blocks\SeoText\SeoTextBlock;
use app\blocks\Contacts\ContactsBlock;
use app\blocks\Contacts\ContactsBlockAlternative;
use app\helpers\Specsymbols;
use yii\widgets\Breadcrumbs;
use app\helpers\Subdomains;

/**
 * @var \app\models\Brands $brand
 * @var \app\models\Models $model
 * @var bool $comTransport
 * @var \app\models\Question[] $question
 */

$checkmark = "\u{2714}\u{FE0F}";

// Нужно для передачи в главный шаблон в блок footer-copyright
$this->params['brandName'] = $brand->name;
$this->params['brandNameRus'] = $brand->getNameRus();
$this->params['modelName'] = $model->name;
$this->params['modelNameRus'] = $model->getNameRus();


// Генерация метатегов
$this->title = "Ремонт $brand->name $model->name ({$model->getBrandAndModelNameRus()}) в Москве | Цены в автосервисе {$brand->getNameRus()} Раннинг Моторс";
$description = "Ремонт $brand->name $model->name ({$model->getBrandAndModelNameRus()}) цена в Москве. ⭐ Специализированный автосервис $brand->name. $checkmark Гарантия на ремонт {$model->getBrandAndModelNameRus()} 2 года. $checkmark Дешевле диллера до 60%";
$this->registerMetaTag(['name' => 'description', 'content' => $description]);
$this->registerMetaTag(['name' => 'keywords', 'content' => $model->keywords]);
$this->registerMetaTag(['property' => 'og:title', 'content' => $this->title]);
$this->registerMetaTag(['property' => 'og:description', 'content' => $description]);




if (!Subdomains::getStatus()) {
    // Хлебные крошки
    $this->params['breadcrumbs'][] = ['label' => 'Автосервис ' . $brand->name, 'url' => '/' . $brand->url . '/'];
    $this->params['breadcrumbs'][] = 'Ремонт ' . $model->name;
    // Canonical
    $this->params['canonical'] = $brand->url . '/' . $model->url;
} else {
    // Хлебные крошки
    $this->params['breadcrumbs'][] = 'Ремонт ' . $model->name;
    // Canonical
    $this->params['canonical'] = $model->url;
}


?>
<!-- Первый блок начало -->
<?= PromoBlock::block([
    'h1' => "Ремонт $brand->name $model->name ({$model->getBrandAndModelNameRus()})",
    'brandName' => $brand->name,
    'brandNameRus' => $brand->getNameRus(),
    'modelName' => $model->name,
    'modelNameRus' => $model->getNameRus(),
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
    'model' => $model,
    'subdomain' => Subdomains::getStatus(),
    'h2' => "Ремон и сервис $brand->name $model->name ({$model->getBrandAndModelNameRus()})",
]); ?>
<!-- Конец Блока РЕМОНТ АВТО -->

<!-- Блок Акции начало -->
<?= CampaignsBlock::block([
    'brand' => $brand,
    'model' => $model
]); ?>
<!-- Конец Блока Акции -->

<!-- Начало БЛОКА ПРАЙС-ЛИСТ -->
<?= PricelistBlock::block([
    'brand' => $brand,
    'model' => $model,
    'subdomain' => Subdomains::getStatus()
]); ?>
<!--Конец БЛОКА ПРАЙС-ЛИСТ-->

<!-- Начало подпрайсовый блок -->
<?= UnderpriceBlock::block([
    'brand' => $brand,
    'model' => $model
]); ?>
<!-- Конец подпрайсовый блок -->

<!-- БЛОК ПРЕИМУЩЕСТВА начало -->
<?= AdvantagesBlock::block([
    'brand' => $brand,
    'model' => $model
]); ?>
<!-- конец БЛОКА ПРЕИМУЩЕСТВА -->
<?php if(!empty($question)){ ?>
<div class="block_question">
    <div class="container">
        <h2 style="text-align: center;">Вопросы и ответы по ремонту, обслуживанию и неисправностям <?= $brand->name ?> <?= $model->name ?> <?= $model->rus_name ?></h2>
        <div class="accordion_custom" itemscope itemtype="http://schema.org/FAQPage">
            <?php $active = false; ?>
            <?php foreach ($question as $item) { ?>
            <div class="accordion__item <?php if($active == false){echo "active_accordion_item";} ?>" itemprop="mainEntity" itemscope itemtype="http://schema.org/Question">
                <div class="accordion__item__btn <?php if($active == false){echo "accordion_active";$active = true;} ?>">
                    <h2 itemprop="name"><?= $item['question'];?></h2>
                    <svg width="15" height="24" viewBox="0 0 15 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0_1515_11547)"><path d="M1.95652 -9.53674e-07L15 12L1.95652 24L0.130435 22.29L11.3152 12L0.130435 1.71L1.95652 -9.53674e-07Z" fill="white"></path></g><defs><clipPath id="clip0_1515_11547"><rect width="15" height="24" fill="white" transform="translate(15 24) rotate(180)"></rect></clipPath></defs></svg>
                </div>
                <div class="accordion__item__content" style="display: none;" itemscope itemprop="acceptedAnswer" itemtype="http://schema.org/Answer">
                    <p itemprop="text"><?= $item['answer'];?></p>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
<?php } ?>

<!-- Начало Блок СЕО текста -->
<?= SeoTextBlock::block([
    'header' => $model->header,
    'text' => $model->text,
]); ?>
<!-- Конец Блок СЕО текста -->

<!-- Блок со слайдером моделей авто начало -->
<?php
$cacheKey = md5(ModelsliderBlock::class . __FILE__ . $brand->name . $model->name);

if ($this->beginCache($cacheKey, ['duration' => -1])) {
    echo ModelsliderBlock::block([
         'brand' => $brand,
         'subdomain' => Subdomains::getStatus(),
         'h2' => 'Выбрать другую модель авто',
     ]);

    $this->endCache();
}
?>
<!-- Конец Блок со слайдером моделей авто -->

<!-- БЛОК КАРТА начало -->
<?php if($comTransport):?>
    <?= ContactsBlockAlternative::block(); ?>
<?php else:?>
    <?= ContactsBlock::block([
       'h2' => "Сеть специализированных автосервисов $brand->name ({$brand->getNameRus()}) Раннинг Моторс",
   ]); ?>
<?php endif;?>
<!-- Конец БЛОКА КАРТА -->

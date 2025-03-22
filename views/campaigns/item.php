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
use app\blocks\Campaigns\CampaignsBlock;
use app\blocks\SeoText\SeoTextBlock;
use app\blocks\Contacts\ContactsBlock;
use yii\widgets\Breadcrumbs;

// Генерация метатегов
$this->title = $core->getTitle($campaign->title, true);
$this->registerMetaTag(['name' => 'description', 'content' => $core->getDescription($campaign->description, true)]);
$this->registerMetaTag(['name' => 'keywords', 'content' => $core->getKeywords($campaign->keywords, true)]);

// Хлебные крошки
$this->params['breadcrumbs'][] = ['label' => $core['name'], 'url' => '/' . $core['url'] . '/'];
$this->params['breadcrumbs'][] = $campaign->name;

// Canonical
$this->params['canonical'] = $core['url'] . '/' . $campaign->url;

?>
<!-- Первый блок начало -->
<?= PromoBlock::block([
    'h1' => $campaign->header
]); ?>
<!-- Конец Первый блок -->

<div class="breadcrumbs">
    <div class="container container2">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
    </div>
</div>

<!-- Начало Блок СЕО текста -->
<?= SeoTextBlock::block([
    'header' => $campaign->header,
    'text' => $campaign->text
]); ?>
<!-- Конец Блок СЕО текста -->

<!-- Блок Акции начало -->
<?= CampaignsBlock::block(); ?>
<!-- Конец Блока Акции -->

<!-- БЛОК КАРТА начало -->
<?= ContactsBlock::block(); ?>
<!-- Конец БЛОКА КАРТА -->
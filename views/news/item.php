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
use app\blocks\SeoText\SeoTextBlock;
use app\blocks\Contacts\ContactsBlock;
use yii\widgets\Breadcrumbs;

// Генерация метатегов
$this->title = $core->getTitle($news->title, true);
$this->registerMetaTag(['name' => 'description', 'content' => $core->getDescription($news->description, true)]);
$this->registerMetaTag(['name' => 'keywords', 'content' => $core->getKeywords($news->keywords, true)]);

// Хлебные крошки
$this->params['breadcrumbs'][] = ['label' => $core['name'], 'url' => '/' . $core['url'] . '/'];
$this->params['breadcrumbs'][] = $news->header;

// Canonical
$this->params['canonical'] = $core['url'] . '/' . $news->url;

?>
<!-- Первый блок начало -->
<?= PromoBlock::block([
    'h1' => $news->header
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
<?php if($news->text): ?>
    <?= SeoTextBlock::block([
        'header' => $news->header,
        'text' => $news->text
    ]); ?>
<?php endif; ?>
<!-- Конец Блок СЕО текста -->

<!-- БЛОК КАРТА начало -->
<?= ContactsBlock::block(); ?>
<!-- Конец БЛОКА КАРТА -->
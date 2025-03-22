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

use app\blocks\Campaigns\CampaignsBlock;
use app\blocks\SeoText\SeoTextBlock;
use app\blocks\Contacts\ContactsBlock;
use yii\widgets\Breadcrumbs;

// Получаем данные для главных страниц разделов (и приравненых к таковым)
$currentPage = Yii::$app->controller->currentPage;

// Генерация метатегов
$this->title = $currentPage->title;
$this->registerMetaTag(['name' => 'description', 'content' => $currentPage->description]);
$this->registerMetaTag(['name' => 'keywords', 'content' => $currentPage->keywords]);

// Хлебные крошки
$this->params['breadcrumbs'][] = $currentPage->name;

// Canonical
$this->params['canonical'] = $currentPage->url;

?>

<div class="breadcrumbs mt-90">
    <div class="container container2">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
    </div>
</div>

<!-- Блок Акции начало -->
<?= CampaignsBlock::block(['mt_0' => true, 'h1' => true]); ?>
<!-- Конец Блока Акции -->

<!-- Начало Блок СЕО текста -->
<?= SeoTextBlock::block([
    'header' => $currentPage->header,
    'text' => $currentPage->text
]); ?>
<!-- Конец Блок СЕО текста -->

<!-- БЛОК КАРТА начало -->
<?= ContactsBlock::block(); ?>
<!-- Конец БЛОКА КАРТА -->
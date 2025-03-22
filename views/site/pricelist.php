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

use app\blocks\Pricelist\PricelistBlock;
use app\blocks\Contacts\ContactsBlock;
use app\helpers\Specsymbols;
use yii\widgets\Breadcrumbs;
use app\blocks\Underprice\UnderpriceBlock;

// Получаем данные для главных страниц разделов (и приравненых к таковым)
$currentPage = Yii::$app->controller->currentPage;

// Генерация метатегов
$this->title = $currentPage->getTitle();
$this->registerMetaTag(['name' => 'description', 'content' => Specsymbols::replace($currentPage->getDescription())]);
$this->registerMetaTag(['name' => 'keywords', 'content' => $currentPage->getKeywords()]);

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

<!-- Начало БЛОКА ПРАЙС-ЛИСТ -->
<?= PricelistBlock::block(['h1' => true]); ?>
<!--Конец БЛОКА ПРАЙС-ЛИСТ-->

<!-- Начало подпрайсовый блок -->
<?= UnderpriceBlock::block(); ?>
<!-- Конец подпрайсовый блок -->

<!-- БЛОК КАРТА начало -->
<?= ContactsBlock::block(); ?>
<!-- Конец БЛОКА КАРТА -->
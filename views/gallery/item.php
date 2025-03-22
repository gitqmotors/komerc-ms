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
use app\blocks\Portfolio\PortfolioBlock;
use app\blocks\SeoText\SeoTextBlock;
use app\blocks\Contacts\ContactsBlock;
use yii\widgets\Breadcrumbs;

// Генерация метатегов
$this->title = $core->getTitle($portfolio->title, true);
$this->registerMetaTag(['name' => 'description', 'content' => $core->getDescription($portfolio->description, true)]);
$this->registerMetaTag(['name' => 'keywords', 'content' => $core->getKeywords($portfolio->keywords, true)]);

// Хлебные крошки
$this->params['breadcrumbs'][] = ['label' => $core['name'], 'url' => '/' . $core['url'] . '/'];
$this->params['breadcrumbs'][] = $portfolio->name;

// Canonical
$this->params['canonical'] = $core['url'] . '/' . $portfolio->url;

?>
<!-- Первый блок начало -->
<?= PromoBlock::block([
    'h1' => $portfolio->name
]); ?>
<!-- Конец Первый блок -->

<div class="breadcrumbs">
    <div class="container container2">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
    </div>
</div>

<?php if(!empty($gallery)): ?>
    <?= PortfolioBlock::block(compact('gallery')); ?>
<?php endif; ?>

<!-- Начало Блок СЕО текста -->
<?php if($portfolio->text): ?>
    <?= SeoTextBlock::block([
        'header' => $portfolio->name,
        'text' => $portfolio->text
    ]); ?>
<?php endif; ?>
<!-- Конец Блок СЕО текста -->

<!-- БЛОК КАРТА начало -->
<?= ContactsBlock::block(); ?>
<!-- Конец БЛОКА КАРТА -->
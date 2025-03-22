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

use app\blocks\SeoText\SeoTextBlock;
use app\blocks\Contacts\ContactsBlock;
use yii\widgets\ListView;
use yii\widgets\Breadcrumbs;
use yii\helpers\Html;

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

<div class="rabotiblock block">
    <div class="container container2">
        
            <?= Html::tag('h1', $currentPage->header, ['class' => 'zag']); ?>
            <?= ListView::widget([
                'dataProvider' => $dataProvider,
                'itemView' => function ($model, $key, $index, $widget) {
                    return $this->render('_item', ['model' => $model]);
                },
                'options' => [
                    'id' => 'list-view',
                    'tag' => 'div',
                    'class' => 'row',
                ],
                'layout' => "{items}\n{pager}",
                'itemOptions' => [
                    'tag' => 'div',
                    'class' => 'col-xl-3 col-lg-4 col-sm-6',
                ],
                'pager' => [
                    //'firstPageLabel' => 'Первая',
                    //'lastPageLabel' => 'Последняя',                    
                    //'nextPageLabel' => '<ion-icon name="chevron-forward-outline"></ion-icon>',
                    //'prevPageLabel' => '<ion-icon name="chevron-back-outline"></ion-icon>',        
                    'maxButtonCount' => 20,
                    'options' => [
                        'class' => 'pagination col-xs-12 col-md-6',
                        'style' => 'margin-bottom: 30px;'
                    ]            
                ],
            ]); ?>
            
    </div>
</div>

<!-- Начало Блок СЕО текста -->
<?= SeoTextBlock::block([
    'header' => $currentPage->header,
    'text' => $currentPage->text
]); ?>
<!-- Конец Блок СЕО текста -->

<!-- БЛОК КАРТА начало -->
<?= ContactsBlock::block(); ?>
<!-- Конец БЛОКА КАРТА -->
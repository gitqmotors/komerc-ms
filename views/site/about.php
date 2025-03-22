<?php

/* @var $this yii\web\View */

use app\blocks\Advantages\AdvantagesBlock;
use app\blocks\Contacts\ContactsBlock;
use app\helpers\Specsymbols;
use app\blocks\SeoText\SeoTextBlock;
use yii\widgets\Breadcrumbs;

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

<!-- Начало Блок СЕО текста -->
<?= SeoTextBlock::block([
    'header' => $currentPage->header,
    'text' => $currentPage->text
]); ?>
<!-- Конец Блок СЕО текста -->

<!-- БЛОК ПРЕИМУЩЕСТВА начало -->
<?= AdvantagesBlock::block(); ?>
<!-- конец БЛОКА ПРЕИМУЩЕСТВА -->

<!-- БЛОК КАРТА начало -->
<?= ContactsBlock::block(); ?>
<!-- Конец БЛОКА КАРТА -->
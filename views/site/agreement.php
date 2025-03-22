<?php

/* @var $this yii\web\View */

use app\blocks\Promo\PromoBlock;
use app\blocks\Contacts\ContactsBlock;
use app\helpers\Specsymbols;
use yii\widgets\Breadcrumbs;
use yii\helpers\Html;

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

<!-- Первый блок начало -->
<?= PromoBlock::block(); ?>
<!-- Конец Первый блок -->

<div class="breadcrumbs">
    <div class="container container2">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
    </div>
</div>

<div class="seoblock d-none d-md-block">
    <div class="container container2">
        <div class="seoblock-wrap">
            <?= Html::tag('h2', $currentPage->header); ?>
            <noindex>
            <?= $currentPage->text; ?>
            </noindex>
        </div>
    </div>
</div>

<!-- БЛОК КАРТА начало -->
<?= ContactsBlock::block(); ?>
<!-- Конец БЛОКА КАРТА -->

<?php


use app\blocks\Promo\PromoBlock;
use app\blocks\SeoText\SeoTextBlock;
use app\blocks\Contacts\ContactsBlock;
use yii\widgets\Breadcrumbs;

// Хлебные крошки
$this->params['breadcrumbs'][] = ['label' => $core['name'], 'url' => '/' . $core['url'] . '/'];
$this->params['breadcrumbs'][] = $vacancy->title;

// Генерация метатегов
$this->title = $vacancy->title . " - вакансия от прямого работодателя Раннинг Моторс";
$this->registerMetaTag(['name' => 'description', 'content' => "В сети автосервисов Раннинг Моторс открыта вакансия - " . $vacancy->title]);

// Canonical
$this->params['canonical'] = $core['url'] . '/' . $vacancy->url;

?>

<div class="container container2 vacancy-block">
    <h1 class="zag">Требуется <?= $vacancy->title; ?></h1>
    <div class="vacancy_id_content">
        <?= $vacancy->description; ?>
    </div>
    <br>
    <br>
    <p>По вопросам трудоустройства просьба обращаться по телефону: +7(985) 514-66-60 Екатерина</p>
    <div class="vacancy__item__line"></div>
    <div class="vacancy__item__button">
        <a href="#" class="mbtn mbtng modal-form-open" data-name="Откликнуться на вакансию <?= $vacancy->title; ?>" data-type="vacancy" tabindex="0">Откликнуться на вакансию</a>
        <br>
        <br>
        <a class="vacancy__item_more" href="/vacancy">К списку всех вакансии</a>
    </div>
</div>


<!-- БЛОК КАРТА начало -->
<?= ContactsBlock::block(); ?>
<!-- Конец БЛОКА КАРТА -->

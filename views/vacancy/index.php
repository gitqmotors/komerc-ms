<?php

use app\blocks\Promo\PromoBlock;
use app\blocks\Contacts\ContactsBlock;
use yii\widgets\ListView;
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

<div class="container container2">
    <div id="vacancy">
        <h2>Вакансии «r-ms»</h2>

        <?php foreach ($vacancy as $item) : ?>

            <div class="vacancy__item">
                <a class="vacancy__item_a" href="/vacancy/<?= $item['url']; ?>"><?= $item['title']; ?></a>
                <?= $item['mini_description']; ?>
                <br>
                <a class="vacancy__item_more" href="/vacancy/<?= $item['url']; ?>">Подробнее</a>
                <br>
                <br>
                <a href="#" class="mbtn mbtng modal-form-open" data-name="Откликнуться на вакансию <?= $item['title']; ?>" data-type="vacancy" tabindex="0">Откликнуться на вакансию</a>
                <div class="vacancy__item__line"></div>
            </div>

        <?php endforeach; ?>

    </div>
</div>


<!-- БЛОК КАРТА начало -->
<?= ContactsBlock::block(); ?>
<!-- Конец БЛОКА КАРТА -->

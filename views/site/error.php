<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
use app\blocks\Contacts\ContactsBlock;

$this->title = $name;
?>
<div class="seoblock d-none d-md-block" style="margin-top: 100px;">
    <div class="container container2">
        <div class="seoblock-wrap">

            <h1><?= Html::encode($this->title) ?></h1>

            <div class="alert alert-danger">
                <?= nl2br(Html::encode($message)) ?>
            </div>

            <p>
                Вышеупомянутая ошибка произошла во время обработки вашего запроса веб-сервером.
            </p>
            <p>
                Свяжитесь с нами, если считаете, что это ошибка сервера. Спасибо.
            </p>

        </div>
    </div>
</div>
<script>
    document.addEventListener('yacounter38431175inited', function () {
        ym(38431175, 'reachGoal', '404error', {
            'NotFoundURL': {
                [document.location.href]: {
                    'Referrer': document.referrer
                }
            }
        });
    });
</script>

<!-- БЛОК КАРТА начало -->
<?= ContactsBlock::block(); ?>
<!-- Конец БЛОКА КАРТА -->

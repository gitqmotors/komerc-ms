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

/**
 * @var bool $detailing
 * @var string $h1
 * @var string $brandName
 * @var string $brandNameRus
 * @var string $modelName
 * @var string $modelNameRus
 */

?>
<div class="block1">
    <div class="block1-wraper">
        <div class="container ">
            <h1><?= $h1; ?></h1>
            <div class="block1-btnwrap">
                <div class="mbtn mbtn2 modal-form-open" data-name="Бесплатная диагностика" data-type="diagnostic">Диагностика</div>
                <!--Определяем если стр Детейлинга-->
                <?php if (isset($groupId) && $groupId == 7): ?>
                    <div class="mbtn mbtnot modal-form-open" data-name="Запись на детейлинг" data-type="repaire">Запись на детейлинг</div>
                <?php else: ?>
                    <div class="mbtn mbtnot modal-form-open" data-name="Запись на ремонт / ТО" data-type="repaire">Запись на ремонт / ТО</div>
                <?php endif; ?>

                <div class="mbtn mbtn2 mbtn2r modal-form-open" data-name="Получить консультацию" data-type="consultation">Получить консультацию</div>
            </div>
        </div>
        <div class="block1-utpwrap">
            <div class="container">
                <div class="row">
                    <?php if ($detailing): ?>
                        <div class="col-lg-4">
                            <div class="utp">2 студии детейлинга в Москве</div>
                        </div>
                        <div class="col-lg-4">
                            <div class="utp utp2">Большой спектр оказываемых услуг</div>
                        </div>
                        <div class="col-lg-4">
                            <div class="utp utp3">Вернем вид нового автомобиля</div>
                        </div>
                        <?php else: ?>
                        <div class="col-lg-4">
                            <div class="utp">Гарантия на ремонт<?= $brandName; ?><?= $modelName ?> 2 года</div>
                        </div>
                        <div class="col-lg-4">
                            <div class="utp utp2">Специализированный сервис <?= $brandName; ?></div>
                        </div>
                        <div class="col-lg-4">
                            <div class="utp utp3">Запчасти на складе в наличии</div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
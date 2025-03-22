<?php

/*
 * 2021 Jan 31
 * File: block.php
 * Encoding: UTF-8
 * Project: RMS special for Quality Motors team
 * 
 * Author: Gafuroff Alexandr 
 * E-mail: gafuroff.al@yandex.ru
 */

use yii\helpers\Url;

/**
 * @var bool $detailing
 * @var string $brandRus
 * @var string $modelRus
 */
?>
<div class="block5">
    <div class="container ">
        <div class="underprice">
            <div class="important">
                <strong class="priv_act_nvv">
                    <span class="zvezda_diagnostika">🔥</span>
                    <span style="font-size: 130%;">ДИАГНОСТИКА <?= $brandRus; ?> <?= $modelRus; ?> по 43 параметрам в подарок</span>
                </strong>.<br>
                <span class="galka_diagnostika">⛔</span>
                <i style="font-weight: lighter; margin-top: 5px;">Предложение действительно при ремонте в нашем техцентре</i>
                <a class="mbtn" target="_blank" href="<?= Url::to(['/spec/diagnostika_hodovoi_besplatno']) ?>">Подробнее</a>
            </div>
        </div>
        <div class="block1-btnwrap block1-btnwrap-underprice">
            <div class="mbtn mbtnot modal-form-open" data-name="Получить консультацию" data-type="diagnostic">Диагностика</div>
            <div class="mbtn mbtnot modal-form-open" data-name="Получить консультацию" data-type="consultation">Получить консультацию</div>
            <?php if ($detailing): ?>
                <div class="mbtn mbtnot modal-form-open" data-name="Записаться на детейлинг" data-type="detaling">Записаться на детейлинг</div>
            <?php else: ?>
                <div class="mbtn mbtnot modal-form-open" data-name="Заявка на эвакуатор" data-type="evacuator">Заявка на эвакуатор</div>
            <?php endif; ?>
        </div>
    </div>
</div>
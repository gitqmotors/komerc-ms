<?php

/*
 * 01.12.2020
 * File: item.php
 * Encoding: UTF-8
 * Project: RMS special for Quality Motors team
 * 
 * Author: Gafuroff Alexandr 
 * E-mail: gafuroff.al@yandex.ru
 */

?>
<div class="akciiblock-slider-s">
    <div class="akciiblock-slider-s-card">
        <div class="akciiblock-slider-s-card-zag"><?= $item->name; ?></div>
        <div class="akciiblock-slider-s-card-text"><?= $item->anons; ?></div>
        <div class="dual">
            <div class="dual-l">
                <div class="cena"><?= is_null($item->new_price) ? '' : $item->new_price . ' руб'; ?></div>
            </div>
            <div class="dual-r">
                <a href="#" class="mbtn mbtng modal-form-open" data-name="Запись на ремонт / ТО" data-type="repaire">Записаться</a>
            </div>
        </div>
    </div>
</div>
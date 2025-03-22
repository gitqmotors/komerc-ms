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

/** $mdSize integer */
/** $lgSize integer */

?>

    <div class="cartablock-card">
        <div class="cartablock-card-zag <?= $item->service_identifier; ?>"><?= $item->name; ?></div>
        <div class="cartablock-card-addr"><?= $item->address; ?></div>
        <div class="cartablock-card-tel"><a href="tel:<?= $item->getLinkPhone(); ?>"><?= $item->phone; ?></a></div>
        <div class="cartablock-card-vrrab">Ежедневно: 08:00 - 22:00</div>
        <div class="cartablock-card-zopen modal-form-open" data-name="Оставить заявку" data-type="zayavka" data-service="<?= $item->service_identifier; ?>">Оставить заявку</div>
        <div class="cartablock-card-btnwrap mobile-touch-path" data-touch="<?= $item->yandexnavi_path; ?>">
            <div class="cartablock-card-btnwrap-btn">Построить маршрут</div>
            <p class="cartablock-card-btnwrap-abs">
                <a href="<?= $item->yandex_map_path; ?>" target="_blank" rel="external">Веб-версия Яндекс Карт</a>
                <a href="<?= $item->google_map_path; ?>" target="_blank" rel="external">Google Maps</a>
            </p>
        </div>
    </div>

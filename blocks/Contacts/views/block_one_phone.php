<?php

/*
 * 02.12.2020
 * File: block.php
 * Encoding: UTF-8
 * Project: RMS special for Quality Motors team
 *
 * Author: Gafuroff Alexandr
 * E-mail: gafuroff.al@yandex.ru
 */

/** $detailing boolean */
/** $mdSize integer */
/** $lgSize integer */

?>
<div class="block cartablock">
    <?php if($_SERVER['REQUEST_URI'] == "/contacts/"){ ?>
    <div style="max-width: 310px;margin: 0 auto;">
        <p><strong>График работы:</strong> Ежедневно с 8:00 до 22:00</p>
        <p><strong>График работы в новогодние праздники:</strong></p>
        <ul>
            <li>31 декабря до последнего клиента;</li>
            <li>1 января выходной, 2 января рабочий день.</li>
        </ul>
    </div>
    <?php } ?>
    <div class="container">
         <?= $items; ?>
    </div>
    <div class="cartablock-carta">
        <div class="ymap-container1 ymap-container_one_phone">
            <div class="loader loader-default"></div>
            <div id="map-yandex" data-detailing="<?= $detailing ?>"></div>
        </div>
    </div>
</div>

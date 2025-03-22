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

?>
<div class="block markiblock">
    <div class="container">
        <div class="zag">Марки авто</div>
        <div class="markiblock-slider">
            <?= $itemsSlider; ?>
        </div>
        <div class="markiblock-spis">
            <div class="row">
                <?= $itemsPanel; ?>
            </div>
        </div>
        <div class="btn-wrap">
            <div class="markiblock-btn mbtn mbtn2">
                <span class="markiblock-btn-s1">Показать все</span>
                <span class="markiblock-btn-s2">Скрыть все</span>
            </div>
        </div>
    </div>
</div>
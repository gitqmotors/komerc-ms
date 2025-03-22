<?php

/*
 * 16.12.2020
 * File: block.php
 * Encoding: UTF-8
 * Project: RMS special for Quality Motors team
 * 
 * Author: Gafuroff Alexandr 
 * E-mail: gafuroff.al@yandex.ru
 */

?>
<section id="filter-to" class="hide_mobile_element">
    <div class="container container2 block2 block4">
        <h2 class="restore-title zag">Выбрать ближайший автосервис</h2>
        <div class="form-restore">

            <div class="filter-restore restore-county" id="restore-county">
                <label class="county-lable">Округ</label>
                <ul class="big-filter-restore">
                    <?= $itemsCounty; ?>
                    <div class="header-card-vip-close2"></div>
                </ul>
            </div>

            <div class="filter-restore  restore-dis" id="restore-district">
                <label class="district-lable">Район</label>
                <ul class="big-filter-restore">
                    <?= $itemsDistrict; ?>
                    <div class="header-card-vip-close2"></div>
                </ul>
            </div>
            <div class="filter-restore restore-subway" id="restore-subway">
                <label class="metro-lable">Метро</label>
                <ul class="big-filter-restore">
                    <?= $itemsMetro; ?>
                    <div class="header-card-vip-close2"></div>
                </ul>

            </div>

            <div class="filter-restore restore-services" id="restore-services">
                <label class="services-lable">Услуги</label>
                <ul class="big-filter-restore">
                    <div>
                        <li data-id="">Слесарный ремонт</li>
                        <li data-id="">Кузовной ремонт</li>
                        <li data-id="">Техническое обслуживание</li>
                    </div>
                    <div class="header-card-vip-close2"></div>
                </ul>
            </div>

            <button onclick="goToPage()" class="mbtn restore-button">Найти</button>
            <div class="big-filter-restore__overlay"></div>
        </div>
    </div>
</section>
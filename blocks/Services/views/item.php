<?php

/*
 * 30.11.2020
 * File: item.php
 * Encoding: UTF-8
 * Project: RMS special for Quality Motors team
 * 
 * Author: Gafuroff Alexandr 
 * E-mail: gafuroff.al@yandex.ru
 */

?>
<div class="col-xl-3 col-lg-4 col-sm-6 <?= $params['extClass']; ?>">
    <div class="cenablock-card cenablock-<?= $item->url; ?>">
        <div class="cenablock-card-ten">
            <div class="cenablock-card-abs">
                <div class="cenablock-card-abs-text">
                    <a href="/<?= $item->url; ?>/">
                        <?= $item->getCleanName(); ?>
                    </a>
                </div>
                <div class="cenablock-card-abs-btnwrap">
                    <a href="/<?= $item->url; ?>/" class="mbtn mbtn2">Цена</a>
                    <a href="#" class="mbtn mbtng modal-form-open" data-name="Получить консультацию" data-type="consultation">Получить консультацию</a>
                </div>
            </div>
        </div>
    </div>
</div>
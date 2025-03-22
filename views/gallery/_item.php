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

    <div class="cenablock-card background-cover" style="background: url('/uploads/images/portfolio/preview/<?= $model->image; ?>')">
        <div class="cenablock-card-ten">
            <div class="cenablock-card-abs">
                <div class="cenablock-card-abs-text">
                    <a href="/gallery/<?= $model->url; ?>/">
                        <?= $model->name; ?> - <?= date("d.m.Y", strtotime($model->date)); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>

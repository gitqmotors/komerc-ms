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

use yii\helpers\Html;

?>
<div class="seoblock d-none d-md-block">
    <div class="container container2">
        <div class="seoblock-wrap">
            <?= Html::tag('h2', $header); ?>
            <?= $text; ?>
            <div class="btnwrap">
                <div class="mbtn mbtn2 seo-skrcont-open"><span class="text1">Показать весь текст</span></div>
            </div>
        </div>
    </div>
</div>

<?php

/*
 * 01.12.2020
 * File: block.php
 * Encoding: UTF-8
 * Project: RMS special for Quality Motors team
 * 
 * Author: Gafuroff Alexandr 
 * E-mail: gafuroff.al@yandex.ru
 */

use yii\helpers\Html;

?>
<div class="akciiblock block <?= $mt_0 ? 'mt-0' : ''; ?>">
    <div class="akciiblock-wrap">
        <div class="container container2">
            <?= Html::tag($h1 ? 'h1' : 'div', 'Наши акции', ['class' => 'zag']); ?>
            <div class="akciiblock-slider">
                <?= $items; ?>
            </div>
        </div>
    </div>
</div>
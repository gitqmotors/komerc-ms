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

use yii\helpers\Html;

?>
<div class="block5">
    <div class="container ">
        <?= Html::tag($h1 ? 'h1' : 'div', $header, ['class' => 'zag']); ?>
        <div class="accordion">
            <?= $groups; ?> 
        </div>
    </div>
</div>
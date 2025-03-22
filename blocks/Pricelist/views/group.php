<?php

/*
 * 02.12.2020
 * File: group.php
 * Encoding: UTF-8
 * Project: RMS special for Quality Motors team
 * 
 * Author: Gafuroff Alexandr 
 * E-mail: gafuroff.al@yandex.ru
 */

/**
 * @var \app\models\Pricelist $group
 * @var string $items
 * @var int $iter
 */

?>
<div class="accordion_item<?= ($iter == 1 ? ' db active_block' : ''); ?>">
    <h3 class="title_block b5bgc<?= $iter; ?>"><?= $group->name; ?></h3>
    <div class="info">
        <?= $items; ?>
    </div>
</div>
<?php

/* 
 * 2021 Jan 31
 * File: item.php
 * Encoding: UTF-8
 * Project: RMS special for Quality Motors team
 * 
 * Author: Gafuroff Alexandr 
 * E-mail: gafuroff.al@yandex.ru
 */

?>
<div class="header-center-addrw-text">
    <div class="header-center-addrw-close"></div>
    <div class="header-center-addrw-text-zag"><?= $item->name; ?></div>
    <span><?= $item->address; ?></span>
    <a href="tel:<?= $item->getLinkPhone(); ?>"><?= $item->phone; ?></a>
</div>

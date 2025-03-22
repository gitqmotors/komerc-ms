<?php

/*
 * 03.12.2020
 * File: widget.php
 * Encoding: UTF-8
 * Project: RMS special for Quality Motors team
 * 
 * Author: Gafuroff Alexandr 
 * E-mail: gafuroff.al@yandex.ru
 */


?>
<div class="col-lg-3 col-sm-6 footer-menu">
    <?= $items; ?>
    <? if ( $showhtmlmap == true): ?>
    <a href="/dist/avtoservis">Автосервис районы и метро</a>
    <a href="/dist/remont">Ремонт авто районы и метро</a>
    <a href="/dist/kuzovnoj-remont">Кузовной ремонт районы и метро</a>
    <a href="/dist/tekhnicheskoe-obsluzhivanie">ТО районы и метро</a>
<? elseif ( $showhtmlmapmain  == true): ?>
     <a href="<?= '/'.$brand; ?>/dist/avtoservis">Автосервис районы и метро</a>
     <a href="<?= '/'.$brand; ?>/dist/remont">Ремонт авто районы и метро</a>
     <a href="<?= '/'.$brand; ?>/dist/kuzovnoj-remont">Кузовной ремонт районы и метро</a>
     <a href="<?= '/'.$brand; ?>/dist/tekhnicheskoe-obsluzhivanie">ТО районы и метро</a>
<? endif; ?>
</div>
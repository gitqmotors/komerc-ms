<?php

/* 
 * 24.11.2020
 * File: item.php
 * Encoding: UTF-8
 * Project: RMS special for Quality Motors team
 * 
 * Author: Gafuroff Alexandr 
 * E-mail: gafuroff.al@yandex.ru
 */
$url = "/".$item->url;

if($item->url_subdomain == "remont-mercedes-benz.r-ms.ru" || $item->url_subdomain == "servis-bmw.r-ms.ru" || $item->url_subdomain == "remont-volkswagen.r-ms.ru"){
    $url = "http://".$item->url_subdomain;
}

?>
<a href="<?=$url; ?>/" class="markiblock-card">
    <span class="markiblock-card-img"><img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-lazy="/uploads/images/brands/<?= mb_strtolower($item->url); ?>.png" alt="<?= $item->name; ?>"></span>
    <span class="markiblock-card-zag"><?= $item->name; ?></span>
</a>
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
$name = str_replace("район", "", $item->name);


?>
<li class="dist-sort" data-id="<?= $item->url; ?>"><?= $name; ?></li>


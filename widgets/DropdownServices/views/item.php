<?php

/* 
 * 03.12.2020
 * File: item.php
 * Encoding: UTF-8
 * Project: RMS special for Quality Motors team
 * 
 * Author: Gafuroff Alexandr 
 * E-mail: gafuroff.al@yandex.ru
 */

?>
<div class="spis-block col-md-6">

    <?php
    if($params['subdomain'] == true){
    ?>
        <a href="/<?= $params['modelUrl']; ?><?= $item->url; ?>/" class="<?= $item->url; ?>"><?= $item->getCleanName(); ?></a>
    <?php
    } else{
    ?>
        <a href="/<?= $params['brandUrl']; ?><?= $params['modelUrl']; ?><?= $item->url; ?>/" class="<?= $item->url; ?>"><?= $item->getCleanName(); ?></a>
    <?php
    }
    ?>


</div>
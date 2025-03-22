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
<?php
if($params['subdomain'] == true){
    ?>
    <a href="/<?= $params['modelUrl']; ?><?= $item->url; ?>/"><?= $item->getCleanName(); ?></a>
    <?php
} else{
    ?>
    <a href="/<?= $params['brandUrl']; ?><?= $params['modelUrl']; ?><?= $item->url; ?>/"><?= $item->getCleanName(); ?></a>
    <?php
}
?>

<?php 
if($params['divide'] == $params['counter'] OR ($params['divide'] * 2) == $params['counter']) {
    include __DIR__ . '/divider.php';
}
?>
<?php

/* 
 * 02.12.2020
 * File: item.php
 * Encoding: UTF-8
 * Project: RMS special for Quality Motors team
 * 
 * Author: Gafuroff Alexandr 
 * E-mail: gafuroff.al@yandex.ru
 */

use yii\helpers\Html;

?>
<?= Html::a(Html::img('data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==', ['data-lazy' => '/uploads/images/portfolio/' . $item, 'alt' => '*']), '/uploads/images/portfolio/' . $item, ['class' => 'rabotiblock-slider-s', 'data-fancybox' => "images"]); ?>

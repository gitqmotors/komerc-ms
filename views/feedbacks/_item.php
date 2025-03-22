<?php

/*
 * 30.11.2020
 * File: item.php
 * Encoding: UTF-8
 * Project: RMS special for Quality Motors team
 * 
 * Author: Gafuroff Alexandr 
 * E-mail: gafuroff.al@yandex.ru
 */

use yii\helpers\Url;

?>
<div class="review border rounded mb-2 p-3">
    <div class="row">
        <div class="reviews-wrap__img col-sm-3"> 
            <a href="<?= Url::to(['/reviews/' . $model->url]); ?>">
                <img src="/uploads/images/feedbacks/<?= $model->image; ?>" alt="<?= $model->header; ?>" border="0" class="img-responsive"> 
            </a>
        </div>
        <div class="col-sm-6">
            <big class="reviews-wrap__author"><?= $model->reviewer; ?> — <?= date("d.m.Y", strtotime($model->date)); ?></big>
            <br>
            <?= $model->anons; ?>  
        </div>
        <div class="col-sm-3"> <a href="<?= Url::to(['/reviews/' . $model->url]); ?>" class="mbtn" style="margin-top: 60px;">Подробнее</a></div>
    </div>
</div>

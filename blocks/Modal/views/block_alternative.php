<?php

/* 
 * 2021 Mar 14
 * File: block.php
 * Encoding: UTF-8
 * Project: RMS special for Quality Motors team
 * 
 * Author: Gafuroff Alexandr 
 * E-mail: gafuroff.al@yandex.ru
 */

use yii\helpers\Html;
use yii\web\View;

$this->registerJS("var servicesJson = " . $json . ";", View::POS_BEGIN);

?>
<div class="modal modal-form" id="modal-form">
    <form id="recall-form">
        <?= Html::hiddenInput('type'); ?>
        <?= Html::hiddenInput(\Yii::$app->getRequest()->csrfParam, \Yii::$app->getRequest()->getCsrfToken(), []); ?>
        <h4 class="text-center" id="recall-form-name"></h4>
        <div class="form-group">
            <label for="client_name">Ваше имя</label>
            <?= Html::textInput('client_name', '', ['class' => 'form-control', 'id' => 'client_name', 'required' => true]); ?>
        </div>
        <div class="form-group">
            <label for="client_phone">Номер телефона</label>
            <?= Html::textInput('client_phone', '', ['class' => 'form-control', 'id' => 'client_phone', 'placeholder' => '+7 (___) ___-__-__', 'required' => true]); ?>
        </div>
       <!-- <div id="service-space"></div>-->
        <div class="form-group">
            <select id="service-name" class="form-control" name="service" style="visibility: hidden;">
                <option value="com_trans" selected>Комерческий транспорт</option>
            </select>
        </div>


        <div class="form-group">
            <?= Html::checkbox('obrabotkaDanix', true) ?> <a href="/agreement/" target="_blank">Согласен с политикой конфиденциальности</a>
        </div>
        <div class="form-group">
            <div id="form-recall-send" class="mbtn">Отправить</div>
        </div>        
    </form>
</div>

<div class="modal modal-report" id="modal-report">
    <h4 class="text-center" id="modal-report-header"></h4>
    <p id="modal-report-massage"></p>
    <div class="form-group">
        <a href="#" rel="modal:close" class="mbtn">OK</a>
    </div>
</div>
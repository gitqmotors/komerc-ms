<?php

/*
 * 10.07.2020
 * File: mango.php
 * Encoding: UTF-8
 * Project: migauto.loc
 * 
 * Author: Gafuroff Alexandr 
 * E-mail: gafuroff.al@yandex.ru
 */

?>
<div role="button" class="callback-bt_perezvon" onclick="showHide_perezvon('perethvon0'); showHide_perezvon('perethvon');" id='perethvon0' style="display: block;">
    <div class="text-call_perezvon" >
        <i class="fa fa-phone"></i>
        <span>Заказать<br>звонок</span>
    </div>
</div> 

<div class="callback-blok_perezvon" id='perethvon' style="display: none;" >
    <div class="close-popup_perezvon" onClick="showHide_perezvon('perethvon0');showHide_perezvon('perethvon');"></div>
    <h5 class="title-widget_perezvon" >Заказать звонок</h5>
    <p class="text-widget_perezvon">Мы перезвоним<br>через 30 секунд</p>
    <img class="flag-ru_perezvon" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" alt="Заказать звонок">
    <span class="box-phone-span-input_perezvon ru-box-phone-span-input_perezvon" data-content="+7">
        <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->getCsrfToken(); ?>">
        <input id="phoneperezvon" placeholder="(ххх) ххх-хх-хх" class="phone_mask_perezvon"  style="padding-left: 30px; height: 35px; width: 190px;" ></span>
    <div class="button-call_perezvon button-widget_perezvon">Позвоните мне</div> 
</div>
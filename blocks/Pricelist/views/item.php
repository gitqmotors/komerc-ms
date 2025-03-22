<?php

use app\models\Pricelist;
use yii\helpers\Html;

/**
 * @var Pricelist $item
 */

if(isset(Yii::$app->controller->model) AND !is_null(Yii::$app->controller->model) AND Yii::$app->controller->model->hide_url_price_list) {
    $itemName = $item->name;
} elseif (is_null($item->href)) {
    $itemName = $item->name;
} else {
    $itemName = Html::a($item->name, $item->href);
}

?>
<div class="info-text-wrap">
    <div class="info-text">
        <span><?= $itemName; ?></span>
        <div class="float-right font-weight-bold">от <?= $item->getPrice(); ?> р.</div>
        <div class="d-block d-sm-none clearfix"></div>
        <button class="d-none btn border-0 rounded-pill py-0 mr-0 mr-sm-2 text-white h-auto float-right modal-form-open" type="button" data-name="Запись на ремонт / ТО" data-type="repaire"></button>
    </div>
</div>
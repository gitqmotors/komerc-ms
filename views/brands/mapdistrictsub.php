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

use app\blocks\Promo\PromoBlock;
use app\blocks\RepareCar\RepareCarBlock;
use app\blocks\SeoFilter\SeoFilterBlock;
use app\blocks\Modelslider\ModelsliderBlock;
use app\blocks\Campaigns\CampaignsBlock;
use app\blocks\Pricelist\PricelistBlock;
use app\blocks\Underprice\UnderpriceBlock;
use app\blocks\Advantages\AdvantagesBlock;
use app\blocks\SeoText\SeoTextBlock;
use app\blocks\Contacts\ContactsBlockDist;
use app\helpers\Specsymbols;
use app\helpers\Subdomains;
use yii\widgets\Breadcrumbs;

// Генерация метатегов
$this->title = $core->getTitle($name . " " .$brand->name ." по районам и метро", true);
$this->registerMetaTag(['name' => 'description', 'content' => Specsymbols::replace($core->getDescription($brand->description, true))]);
$this->registerMetaTag(['name' => 'keywords', 'content' => $core->getKeywords($brand->keywords, true)]);

if (Subdomains::getStatus() == false) {
    // Хлебные крошки
    $this->params['breadcrumbs'][] = ['label' => $core['name'], 'url' => '/' . $core['url'] . '/'];
    $this->params['breadcrumbs'][] = $brand->name;

    // Canonical
    $this->params['canonical'] = $brand->url;
} 


?>

<div class="container container2">

<div id="dist-list" class="seoblock mt-90">
    <h1 class="zag"><?=$name?> по районам и метро</h1>
    <? foreach($countys as $county): ?>
        <? $cleanc = str_replace("в Москве ", "", $county['name'])?>
        <? $cleanc = str_replace("в Москве", "", $cleanc)?>
        <h2><a href="<?=$county['url'].$s?>"><?=$cleanc?></a></h2>
        <h4>По районам</h4>
        <ul>
        <? foreach($districts as $district): ?>
            <? if(strpos("/".$district['url'], $county['url'])){  ?>
                <? $urlnew = $district['url'].$s ?>
                <? $urlnew = str_replace("//", "/", $urlnew)?>
                <? $cleanname = str_replace("район ", "", $district['name'])?>
                <? $cleanname = str_replace("район", "", $cleanname)?>
                <li data-id="<?=$urlnew?>"><a href="<?=$urlnew?>"><?=$cleanname?></a></li>
            <?}?>
        <? endforeach;?>
        </ul>
        <h4>По метро</h4>
        <ul>
        <? foreach($metroes as $metro): ?>
            <? if(strpos("/".$metro['url'], $county['url'])){  ?>
                <? $urlnew = $metro['url'].$s ?>
                <? $urlnew = str_replace("//", "/", $urlnew)?>
                <? $cleanname = str_replace("метро", "", $metro['name'])?>
                <li data-id="<?=$metro['url']?><?=$county['url']?>"><a href="<?=$urlnew?>"><?=$cleanname?></a></li>
            <?}?>
        <? endforeach;?>
        </ul>
    <? endforeach;?>

</div>

</div>
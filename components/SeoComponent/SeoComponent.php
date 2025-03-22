<?php

/*
 * 27.03.2020
 * File: SeoComponent.php
 * Encoding: UTF-8
 * Project: tokyogarage-yii2.loc
 * 
 * Author: Gafuroff Alexandr 
 * E-mail: gafuroff.al@yandex.ru
 */

namespace app\components\SeoComponent;

use Yii;
use yii\base\Component;
//use yii\helpers\Html;
use yii\helpers\Url;
use app\helpers\Specsymbols;

/**
 * Description of SeoComponent
 *
 * @author Александр
 */
class SeoComponent extends Component {

    public static $title = null;
    public static $description = null;
    public static $keywords = null;
    public static $seo = array();

    public function setData($page) {
        if (is_null(self::$title)) {
            self::$title = $page['title'];
            self::$seo['title'] = $page['title'];
        }
        if (is_null(self::$description)) {
            self::$description = Specsymbols::replace($page['description']);
            self::$seo['description'] = Specsymbols::replace($page['description']);
        }
        if (is_null(self::$keywords)) {
            self::$keywords = ($page['keywords'] ? $page['keywords'] : '' );
            self::$seo['keywords'] = ($page['keywords'] ? $page['keywords'] : '' );
        }
    }

    public function renderOGMeta() {
        return \Yii::$app->view->renderFile('@app/components/SeoComponent/views/open_graph.php', ['seo' => self::$seo]);
    }

    public function renderShemaMeta() {
        return \Yii::$app->view->renderFile('@app/components/SeoComponent/views/shema_org.php', ['seo' => self::$seo]);
    }

    public function breadcrumbShema($params): string
    {
        return \Yii::$app->view->renderFile(
            '@app/components/SeoComponent/views/google_schema.php',
            ['breadcrumbs' => $params['breadcrumbs'] ?? []]
        );
    }
    
    public function canonicalMeta($params) {
        \Yii::$app->view->registerLinkTag(['rel' => 'canonical', 'href' => Url::base(true) . '/' . (isset($params['canonical']) ? $params['canonical'] . '/' : '')]);
    }
    
    public function ampMeta($params) {
        if(isset($params['is_amp']) AND !is_null($params['is_amp'])) {
            \Yii::$app->view->registerLinkTag(['rel' => 'amphtml', 'href' => Url::base(true) . '/amp/' . (isset($params['canonical']) ? $params['canonical'] . '/' : '')]);
        }
        
    }

}

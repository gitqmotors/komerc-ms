<?php

/*
 * 03.12.2020
 * File: FooterServicesWidget.php
 * Encoding: UTF-8
 * Project: RMS special for Quality Motors team
 * 
 * Author: Gafuroff Alexandr 
 * E-mail: gafuroff.al@yandex.ru
 */

namespace app\widgets\FooterServices;

use app\widgets\DropdownServices\DropdownServicesWidget;
use app\helpers\Subdomains;
use app\models\Brands;
use Yii;
/**
 * Description of FooterServicesWidget
 *
 * @author Александр
 */
class FooterServicesWidget extends DropdownServicesWidget
{   
    /**
     * {@inheritdoc}
    */
    public $brandA;

    public function run()
    {
        $params = $this->getParams();
        $params['counter'] = 0;
        $items = '';
        $brand = '';
        foreach($this->services as $item) {
            $params['counter']++;
            $items .= $this->getItem($item, $params);
        }
        $showhtmlmap = false;
        $showhtmlmapmain = false;
        if(Subdomains::getStatus() && Yii::$app->request->url == "/"):
            $showhtmlmap = true;
        endif;
        $uri = Yii::$app->request->url;
        $uri = explode("/", $uri);

        if (!Subdomains::getStatus() && count($uri) === 3) {
            $this->brandA = Brands::find()->where(['url' => $uri[1]])->one();
            if (isset($this->brandA) && $this->brandA->seo_filter == 1) {
                $showhtmlmapmain = true;
                $brand = $this->brandA['url'];
            }
        }

        return $this->render(compact('items', 'showhtmlmap', 'showhtmlmapmain', 'brand'));
    }
    
    protected function getParams() 
    {
        $params = [];
        $params['subdomain'] = Subdomains::getStatus();
        $params['length'] = count($this->services);
        $params['divide'] = round($params['length'] / 3, 0, PHP_ROUND_HALF_UP);
        if($params['length'] % 3 != 0) {
            $params['divide']++;
        }
        return array_merge($this->params, $params);
    }
    
}

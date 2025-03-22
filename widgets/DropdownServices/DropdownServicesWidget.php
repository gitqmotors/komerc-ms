<?php

/*
 * 03.12.2020
 * File: DropdownServicesWidget.php
 * Encoding: UTF-8
 * Project: RMS special for Quality Motors team
 * 
 * Author: Gafuroff Alexandr 
 * E-mail: gafuroff.al@yandex.ru
 */

namespace app\widgets\DropdownServices;

use Yii;
use app\widgets\AppWidget;
use app\models\IndependensServices;
use app\models\CommonServices;
use app\helpers\Subdomains;

/**
 * Description of DropdownServicesWidget
 *
 * @author Александр
 */
class DropdownServicesWidget extends AppWidget
{
    /**
     * @var app\models\IndependensServices
     */
    public $services;
    protected $params;
    
    public function init() 
    {
        parent::init();
        if(isset(Yii::$app->controller->brand) AND !is_null(Yii::$app->controller->brand)) {
            $this->services = CommonServices::find()
                    ->where(['is', 'parent_id', new \yii\db\Expression('null')])
                    ->all();
        } else {
            if(isset(Yii::$app->controller->services) AND !is_null(Yii::$app->controller->services) AND is_null($this->services)) {
                $this->services = Yii::$app->controller->services;
            }
            if(is_null($this->services)) {
                $this->services = IndependensServices::find()
                        ->where(['is', 'parent_id', new \yii\db\Expression('null')])
                        //->andWhere(['not in', 'id', [6, 8]])
                        ->all();
            }
        } 
        $this->params = [
            'brandUrl' => '',
            'modelUrl' => '',
            'subdomain' => Subdomains::getStatus(),
        ];
        if(isset(Yii::$app->controller->brand) AND !is_null(Yii::$app->controller->brand)) {
            $this->params['brandUrl'] = Yii::$app->controller->brand->url . '/';
            if(isset(Yii::$app->controller->model) AND !is_null(Yii::$app->controller->model)) {
                $this->params['modelUrl'] = Yii::$app->controller->model->url . '/';
            }
        }
    }
    
    public function run()
    {        
        $items = '';
        foreach($this->services as $item) {
            $items .= $this->getItem($item, $this->params);
        }
        return $this->render(compact('items'));
    }
}

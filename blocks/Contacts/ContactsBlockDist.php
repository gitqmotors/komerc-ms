<?php

/*
 * 02.12.2020
 * File: ContactsBlock.php
 * Encoding: UTF-8
 * Project: RMS special for Quality Motors team
 * 
 * Author: Gafuroff Alexandr 
 * E-mail: gafuroff.al@yandex.ru
 */

namespace app\blocks\Contacts;

use Yii;
use app\blocks\Block;
use app\models\Contacts;

/**
 * Description of ContactsBlock
 *
 * @author Александр
 */
class ContactsBlockDist extends Block
{
    /**
     * @var app\models\Contacts
     */
    public $contacts;
    /**
     * @var boolean
     */
    public $detailing;
    public $filter;
    
    public function init() 
    {
        parent::init();
        if(isset(Yii::$app->controller->contacts) AND !is_null(Yii::$app->controller->contacts) AND is_null($this->contacts)) {
            $this->contacts = Yii::$app->controller->contacts;
        }
        if(is_null($this->contacts)) {
            $this->contacts = Contacts::find()->all();
        }
    }    
    
    public function run()
    {
        $items = '';
        foreach($this->contacts as $item) {
            if (str_contains($this->filter, $item->seo_filter_id)) {

                $items .= $this->getItem($item);
            }
        }
        error_log($this->detailing . " - вывод detailing");
        return $this->render([
            'items' => $items,
            'detailing' => $this->detailing,
        ]);
    }
}

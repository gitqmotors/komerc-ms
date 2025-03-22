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

class ContactsBlock extends Block
{
    /**
     * @var Contacts
     */
    public $contacts;
    /**
     * @var bool
     */
    public $detailing;
    /**
     * @var string|null
     */
    public $h2;

    public function init()
    {
        parent::init();
        if(isset(Yii::$app->controller->contacts) AND !is_null(Yii::$app->controller->contacts) AND is_null($this->contacts)) {
            $this->contacts = Yii::$app->controller->contacts;
        }
        if(is_null($this->contacts)) {
            $this->contacts = Contacts::find()->cache()->all();
        }
    }

    public function run()
    {
        $items = '';
        $header = '';

        foreach($this->contacts as $item) {
            if ($this->detailing && $item->service_identifier == 'kalugskaya') {
                continue;
            }

            $items .= $this->getItem($item);
        }

        if (!empty($this->h2)) {
            $header = $this->h2;
        }

        return $this->render([
            'items' => $items,
            'detailing' => $this->detailing,
            'header' => $header,
        ]);
    }
}

<?php

/*
 * 2021 Mar 14
 * File: ModalForm.php
 * Encoding: UTF-8
 * Project: RMS special for Quality Motors team
 * 
 * Author: Gafuroff Alexandr 
 * E-mail: gafuroff.al@yandex.ru
 */

namespace app\blocks\Modal;

use app\blocks\Block;
use app\models\Contacts;

/**
 * Description of ModalForm
 *
 * @author Александр
 */
class ModalForm extends Block
{
    /**
     * @var boolean
     */
    public $detailing;
    
    /**
     * {@inheritdoc}
     */
    public function run()
    {
        $query = Contacts::find()
            ->select('form_name')
            ->indexBy('service_identifier');
        if ($this->detailing) {
            $query->where(['!=', 'service_identifier', 'kalugskaya']);
        }        
        $services = $query->column();
        $json = \yii\helpers\Json::encode($services);
        return $this->render(compact('json'));
    }
}

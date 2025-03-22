<?php

/*
 * 03.12.2020
 * File: AppWidget.php
 * Encoding: UTF-8
 * Project: RMS special for Quality Motors team
 * 
 * Author: Gafuroff Alexandr 
 * E-mail: gafuroff.al@yandex.ru
 */

namespace app\widgets;

use yii\base\Widget;

/**
 * Description of AppWidget
 *
 * @author Александр
 */
class AppWidget extends Widget
{
    public function render($params = [], $view = null) 
    {
        $blockView = is_null($view) ? 'widget' : $view;
        return parent::render($blockView, $params);
    }
    
    protected function getItem($item, $params = [], $view = null) 
    {
        $view = is_null($view) ? 'item' : $view;
        ob_start();
        include $this->getViewPath() . '/' . $view . '.php';
        return ob_get_clean();
    }
}

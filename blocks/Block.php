<?php

/*
 * 24.11.2020
 * File: Block.php
 * Encoding: UTF-8
 * Project: RMS special for Quality Motors team
 * 
 * Author: Gafuroff Alexandr 
 * E-mail: gafuroff.al@yandex.ru
 */

namespace app\blocks;

use yii\base\Widget;

/**
 * Description of Block
 *
 * @author Александр
 */
class Block extends Widget 
{
    
    public static function block($config = []) 
    {
        return parent::widget($config);
    }
    
    public function render($params = [], $view = null) 
    {
        $blockView = is_null($view) ? 'block' : $view;
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

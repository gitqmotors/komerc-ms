<?php

/*
 * 2021 Jan 31
 * File: SeoTextBlock.php
 * Encoding: UTF-8
 * Project: RMS special for Quality Motors team
 * 
 * Author: Gafuroff Alexandr 
 * E-mail: gafuroff.al@yandex.ru
 */

namespace app\blocks\SeoText;

use app\blocks\Block;

/**
 * Description of SeoTextBlock
 *
 * @author Александр
 */
class SeoTextBlock extends Block {

    public $header;
    public $text;
    public $brand;
    public $model;
    public $service;

    public function run() {
        $header = $this->header;
        $view = null;
        if(!is_null($this->service)) {
            if(!is_null($this->brand)) $header = preg_replace('/'.$this->brand->name.'/', '', $this->service->header, 1);
            if(!is_null($this->model)) $header = preg_replace('/'.$this->model->name.'/', '', $this->service->header, 1);
        }
        // Выводить шаблон-заглушку, если отсутствует текст
        if (empty($this->text)) {
            $view = 'blank';
        }
        return $this->render([
            'header' => $header,
            'text' => $this->str_insert($this->text, "</p>", '<div class="seo-skrcont">') . '</div>'
        ], $view);
    }

    protected function str_insert($str, $search, $insert) {
        if(!$str){
            return '';
        }
        $index = strpos($str, $search);
        if ($index === false) {
            return $str;
        }
        return substr_replace($str, $search . $insert, $index, strlen($search));
    }

}

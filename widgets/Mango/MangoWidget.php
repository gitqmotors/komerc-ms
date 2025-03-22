<?php

/*
 * 10.07.2020
 * File: MangoWidget.php
 * Encoding: UTF-8
 * Project: migauto.loc
 * 
 * Author: Gafuroff Alexandr 
 * E-mail: gafuroff.al@yandex.ru
 */

namespace app\widgets\Mango;

use yii\base\Widget;

/**
 * Description of MangoWidget
 *
 * @author Александр
 */
class MangoWidget extends Widget {
    
    public function run() {
        return $this->render('mango');
    }
    
}

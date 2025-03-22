<?php

namespace app\modules\ajax;

use Yii;

/**
 * ajax module definition class
 */
class Module extends \yii\base\Module {

    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\ajax\controllers';

    /**
     * {@inheritdoc}
     */
    public function init() {
        parent::init();  
        // Указываем модулю работать только черех AJAX
        if(!Yii::$app->request->isAjax) {
            throw new \yii\web\NotFoundHttpException();
        }
    }

}

<?php

/*
 * 03.12.2020
 * File: ServiceController.php
 * Encoding: UTF-8
 * Project: RMS special for Quality Motors team
 * 
 * Author: Gafuroff Alexandr 
 * E-mail: gafuroff.al@yandex.ru
 */

namespace app\controllers;

use Yii;
use app\controllers\AppBaseController;
use app\models\IndependensServices;

/**
 * Description of ServicesController
 *
 * @author Александр
 */
class ServiceController extends AppBaseController 
{

    /**
     * Displays site section services page.
     *
     * @return string HTML
     */
    public function actionIndex() 
    {
        $this->initCurrentPageData();
        $this->getLastModified();
        Yii::$app->seo->setData($this->currentPage);
        return $this->render('index');
    }

    /**
     * Displays service item page.
     *
     * @return string HTML
     */
    public function actionItem() 
    {
        $core = $this->initParentPageData();
        $service = IndependensServices::find()->where(['url' => $this->route[0]])->andWhere(['hidden' => 0])->one();
        if(!is_null($service)) {   
            $this->getLastModified($service->update_at);
            Yii::$app->seo->setData($service);
            return $this->render('indep_service', compact('service', 'core'));
        }
        throw new \yii\web\NotFoundHttpException();
    }
    
}

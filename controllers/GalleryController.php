<?php

/*
 * 2021 Mar 9
 * File: GalleryController.php
 * Encoding: UTF-8
 * Project: RMS special for Quality Motors team
 * 
 * Author: Gafuroff Alexandr 
 * E-mail: gafuroff.al@yandex.ru
 */

namespace app\controllers;

use Yii;
use app\controllers\AppBaseController;
use app\models\PortfoliosSearch;
use app\models\Portfolios;

/**
 * Description of GalleryController
 *
 * @author Александр
 */
class GalleryController extends AppBaseController
{
    /**
     * Displays site section portfolio page.
     *
     * @return string HTML
     */
    public function actionIndex() 
    {
        $this->initCurrentPageData();
        $this->getLastModified();
        Yii::$app->seo->setData($this->currentPage);
 
        $searchModel = new PortfoliosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        if(is_null($dataProvider)) {
            throw new \yii\web\NotFoundHttpException();
        }
        return $this->render('index', compact('dataProvider'));
    }

    /**
     * Displays portfolio item page.
     *
     * @return string HTML
     */
    public function actionItem() 
    {
        $core = $this->initParentPageData();
        $portfolio = Portfolios::find()->where(['url' => $this->route[1]])->one();        
        if(!is_null($portfolio)) {   
            $this->getLastModified($portfolio->update_at);
            Yii::$app->seo->setData($portfolio);
            
            $gallery = array_merge(
                unserialize($portfolio->before_gallery),
                unserialize($portfolio->gallery),
                unserialize($portfolio->after_gallery)
            );
            
            return $this->render('item', compact('portfolio', 'core', 'gallery'));
        }
        throw new \yii\web\NotFoundHttpException();
    }
}

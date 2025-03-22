<?php

/*
 * 10.03.2021
 * File: NewsController.php
 * Encoding: UTF-8
 * Project: RMS special for Quality Motors team
 * 
 * Author: Gafuroff Alexandr 
 * E-mail: gafuroff.al@yandex.ru
 */

namespace app\controllers;

use Yii;
use app\controllers\AppBaseController;
use app\models\News;
use app\models\NewsSearch;

class NewsController extends AppBaseController
{
    /**
     * Displays site section news page.
     *
     * @return string HTML
     */
    public function actionIndex()
    {
        $this->initCurrentPageData();
        $this->getLastModified();
        Yii::$app->seo->setData($this->currentPage);
        
        $searchModel = new NewsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = 10;

        if(is_null($dataProvider)) {
            throw new \yii\web\NotFoundHttpException();
        }
        
        return $this->render('index', compact('dataProvider'));
    }

    /**
     * Displays news item page.
     *
     * @return string HTML
     */
    public function actionItem()
    {
        $core = $this->initParentPageData();
        $news = News::find()->where(['url' => $this->route[1]])->one();        
        if(!is_null($news)) {   
            $this->getLastModified($news->update_at);
            Yii::$app->seo->setData($news);
            return $this->render('item', compact('news', 'core'));
        }
        throw new \yii\web\NotFoundHttpException();        
    }

}

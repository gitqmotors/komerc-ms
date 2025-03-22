<?php

/*
 * 10.03.2021
 * File: FeedbacksController.php
 * Encoding: UTF-8
 * Project: RMS special for Quality Motors team
 * 
 * Author: Gafuroff Alexandr 
 * E-mail: gafuroff.al@yandex.ru
 */

namespace app\controllers;

use Yii;
use app\controllers\AppBaseController;
use app\models\Feedbacks;
use app\models\FeedbacksSearch;

class FeedbacksController extends AppBaseController
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
        
        $searchModel = new FeedbacksSearch();
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
        $feedback = Feedbacks::find()->where(['url' => $this->route[1]])->one();        
        if(!is_null($feedback)) {   
            $this->getLastModified($feedback->update_at);
            Yii::$app->seo->setData($feedback);
            return $this->render('item', compact('feedback', 'core'));
        }
        throw new \yii\web\NotFoundHttpException();        
    }

}

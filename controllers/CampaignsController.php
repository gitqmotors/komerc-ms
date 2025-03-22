<?php

/*
 * 2021 Mar 6
 * File: CampaignsController.php
 * Encoding: UTF-8
 * Project: RMS special for Quality Motors team
 * 
 * Author: Gafuroff Alexandr 
 * E-mail: gafuroff.al@yandex.ru
 */

namespace app\controllers;

use Yii;
use app\controllers\AppBaseController;
use app\models\Campaigns;

/**
 * Description of CampaignsController
 *
 * @author Александр
 */
class CampaignsController extends AppBaseController
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
        $campaign = Campaigns::find()->where(['url' => $this->route[1]])->one();        
        if(!is_null($campaign)) {   
            $this->getLastModified($campaign->update_at);
            Yii::$app->seo->setData($campaign);
            return $this->render('item', compact('campaign', 'core'));
        }
        throw new \yii\web\NotFoundHttpException();
    }
}

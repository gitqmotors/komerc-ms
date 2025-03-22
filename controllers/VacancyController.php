<?php

namespace app\controllers;

use app\models\Vacancy;
use Yii;
use app\controllers\AppBaseController;
use app\models\IndependensServices;

class VacancyController extends AppBaseController
{
    /**
     * Displays vacancy page.
     *
     * @return string HTML
     */
    public function actionIndex()
    {
        $this->initCurrentPageData();
        $this->getLastModified();
        Yii::$app->seo->setData($this->currentPage);
        $vacancy = Vacancy::find()->all();
        return $this->render('index', compact('vacancy'));
    }

    /**
     * Displays vacancy item page.
     *
     * @return string HTML
     */
    public function actionItem()
    {
        $core = $this->initParentPageData();
        $vacancy = Vacancy::find()->where(['url' => $this->route[1]])->one();
        if(!is_null($vacancy)) {
            $this->getLastModified($vacancy->update_at);
            Yii::$app->seo->setData($vacancy);
            return $this->render('item', compact('vacancy', 'core'));
        }
        throw new \yii\web\NotFoundHttpException();
    }

}
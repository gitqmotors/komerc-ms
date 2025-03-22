<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Models;

class BrandmodelController extends Controller
{
    public function actionJsonResponse()
    {
        $brand_id = Yii::$app->request->get('brand_id');

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $models = Models::find()->where(['brand_id' => $brand_id])->all();

        return $models;
    }
}


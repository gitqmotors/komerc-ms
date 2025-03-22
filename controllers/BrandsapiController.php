<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Brands;

class BrandsapiController extends Controller
{
    public function actionJsonResponse()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $brands = Brands::find()->orderBy('order')->all();

        return $brands;
    }
}

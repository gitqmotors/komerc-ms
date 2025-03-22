<?php

namespace app\controllers;

use app\models\Question;
use Yii;
use yii\web\Controller;

class QuestionanswerController extends Controller
{
    public $enableCsrfValidation = false;

    public function actionJsonResponse()
    {
        $rawBody = Yii::$app->request->getRawBody();

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (!empty($rawBody)) {
            $requestData = json_decode($rawBody, true);
            if ($requestData !== null) {
                $brand_id = $requestData['brand_id'];
                $model_id = $requestData['model_id'];
                $question = $requestData['question'];
                $answer = $requestData['answer'];

                $result = Question::find()->where(['brand_id' => $brand_id, 'model_id' => $model_id, 'status' => 1])->orderBy('order_id DESC')->one();

                $next_order = 0;
                if($result !== null){
                    $next_order = $result['order_id'] + 1;
                }

                $newQuestion = new Question();

                $newQuestion->brand_id = $brand_id;
                $newQuestion->model_id = $model_id;
                $newQuestion->question = $question;
                $newQuestion->answer = $answer;
                $newQuestion->order_id = $next_order;
                $newQuestion->status = 1;

                if ($newQuestion->save()) {
                    return ['status'=> true];
                } else {
                    $errors = $newQuestion->getErrors();
                    return ['status'=> false, 'error'=>"Ошибка создания записи в БД!", "code"=>$errors];
                }
            } else {
                return ['error' => 'Invalid JSON data'];
            }
        } else {
            return ['error' => 'No JSON data received'];
        }
    }
}

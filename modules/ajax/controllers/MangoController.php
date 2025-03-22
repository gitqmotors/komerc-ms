<?php

/*
 * 27.03.2020
 * File: MangoController.php
 * Encoding: UTF-8
 * Project: tokyogarage-yii2.loc
 * 
 * Author: Gafuroff Alexandr 
 * E-mail: gafuroff.al@yandex.ru
 */

namespace app\modules\ajax\controllers;

use Yii;
use yii\base\Controller;
use app\models\Contacts;

/**
 * Description of MangoController
 *
 * @author Александр
 */
class MangoController extends Controller {
    
    public $subject = "«RMS» Запрос звонока с сайта";
   
    public function actionIndex() {
        
        $post = Yii::$app->request->post();
        if (empty($post)) {
            throw new \yii\web\BadRequestHttpException();
        }
        
        extract($post);
        
        $contact = Contacts::find()
                ->where(['service_identifier' => 'sevastopolskiy'])
                ->one();

        $recipients = unserialize($contact->directors_email);       
       
        if(isset($do_thisss) AND $do_thisss == 'perezvonishka') {
            foreach ($recipients as $recipient) {
                Yii::$app->mailer->compose('mango', compact('phonezrr'))
                        ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
                        ->setTo($recipient)
                        ->setSubject($this->subject)
                        ->send();
                time_nanosleep(0, 500000000);
            }
        }   
        
    }    
    
}

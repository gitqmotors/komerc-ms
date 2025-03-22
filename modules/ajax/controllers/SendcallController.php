<?php

/*
 * 23.03.2020
 * File: SendcallController.php
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
 * Description of SendcallController
 *
 * @author Александр
 */
class SendcallController extends Controller {

    public $types = [
        'diagnostic' => 'Бесплатная диагностика',
        'repaire' => 'Запись на ремонт / ТО',
        'consultation' => 'Получить консультацию',
        'zayavka' => 'Оставить заявку',
        'evacuator' => 'Заявка на эвакуатор',
        'photo' => 'Оценить стоимость ремонта по фото',
        'zapchast' => 'Заказать запчасти',
        'calculate' => 'Рассчитать стоимость работы',
        'vacancy' => 'Отклик на вакансию',
        'zaloba' => 'Жалоба',
    ];

    public function actionIndex() {

        $post = Yii::$app->request->post();
        if (empty($post)) {
            throw new \yii\web\BadRequestHttpException();
        }
        extract($post);

        $contact = Contacts::find()
                ->where(['service_identifier' => $service])
                ->one();
        $service_name = $contact->form_name;

        if($type == "vacancy"){
            $recipients = ["clients@qmotors.ru", "89853148967@mail.ru", "3hr@qmotots.ru"];
        }
        elseif ($type == "zaloba"){
            $recipients = ["anya-programmist@qmotors.ru", "clients@qmotors.ru", "89853148967@mail.ru", "y.shmakova@qmotors.ru"];

            if($service_name == 'sevastopolskiy'){
                $recipients[] = "direktor@rovercity.ru";
            }elseif ($service_name == 'kalugskaya'){
                $recipients[] = "direktor@tokyogarage.ru";
            }elseif ($service_name == 'lobnenskaya'){
                $recipients[] = "direktor@qmotors.ru";
            }
        }
        else{
            $recipients = unserialize($contact->directors_email);
        }

        if($type != "zaloba") {
            $subject = '«R-MS» запрос на обратный звонок';
            $premessage = 'В техцентр «R-MS» поступил запрос на обратный звонок.';
            $target = $this->types[$type];

            foreach ($recipients as $recipient) {
                Yii::$app->mailer->compose('sendcall', compact('username', 'phone', 'service_name', 'premessage', 'target'))
                    ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
                    ->setTo($recipient)
                    ->setSubject($subject)
                    ->send();
                time_nanosleep(0, 500000000);
            }
            $return = array();
            $return['username'] = $username;
            $return['data'] = 'Успешно отправлено!';
        }
        else{
            $subject = '«R-MS» жалоба руководству';
            $premessage = 'В техцентр «R-MS» поступила жалоба.';
            $target = $this->types[$type];

            foreach ($recipients as $recipient) {
                Yii::$app->mailer->compose('zaloba', compact('username', 'phone', 'service_name', 'email', 'urgently', 'text', 'premessage', 'target'))
                    ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
                    ->setTo($recipient)
                    ->setSubject($subject)
                    ->send();
                time_nanosleep(0, 500000000);
            }
            $return = array();
            $return['username'] = $username;
            $return['data'] = 'Успешно отправлено!';
        }

        return json_encode($return);
    }

}

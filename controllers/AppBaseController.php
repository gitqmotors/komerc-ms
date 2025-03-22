<?php

/*
 * 24.11.2020
 * File: AppBaseController.php
 * Encoding: UTF-8
 * Project: RMS special for Quality Motors team
 * 
 * Author: Gafuroff Alexandr 
 * E-mail: gafuroff.al@yandex.ru
 */

namespace app\controllers;

use Yii;
use yii\base\Controller;
use app\models\{Mainpages, Brands, IndependensServices, Contacts, Models};

/**
 * Description of AppBaseController
 *
 * @author Александр
 */
class AppBaseController extends Controller
{
    /**
     * @var Brands[]
     */
    public $brands;
    /**
     * @var Brands
     */
    public $brand;
    /**
     * @var Models
     */
    public $model;
    /**
     * @var IndependensServices
     */
    public $services;
    /**
     * @var Contacts
     */
    public $contacts;
    /**
     * @var Mainpages Объект данных текущей страницы (если имеются данные для страницы
     * в таблице main_pages под индексами контроллера, действия или УРЛ и 
     * вызван метод $this->initCurrentPageData() в действии
     */
    public $currentPage = null;
    /**
     * @var array Массив цепочки раутов
     */
    public $route;
    /**
     * @var int Размер массива цепочки раутов
     */
    public $routeLength;
    
    /**
     * Инициализация служебных данных используемых всеми контроллерами наследниками
     */
    public function init() 
    {
        parent::init();
        $this->brands = Brands::find()->cache()->orderBy('order')->all();
        $this->services = IndependensServices::find()
                    ->cache()
                    ->where(['is', 'parent_id', new \yii\db\Expression('null')])
                    ->andWhere(['hidden' => 0])
                    //->andWhere(['not in', 'id', [6, 8]])
                    ->all();
        $this->contacts = Contacts::find()->cache()->all();
        // Элементы раутинга и его длинна для текущего контроллера
        $this->route = explode('/', trim(Yii::$app->request->url, '/'));
        $this->routeLength = count($this->route);
    }
    
    /**
     * Отдельные действия контроллеров
     * 
     * @return array Карта отдельных действий
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
    
    /**
     * Инициализация seo данных для индексных страниц контроллеров или прочих страниц,
     * для которых не существует данных в собственных таблицах (моделях), из-за
     * ограничений вызванных особенностями реляционных баз данных. Для получения
     * данных, необходимо вызвать метод в действии, в котором эти данные нужны.
     * 
     * @return void
     */
    public function initCurrentPageData() 
    {
        $this->currentPage = Mainpages::find()->where([
            'module_id' => $this->module->id,
            'controller_id' => $this->id,
            'action_id' => $this->action->id
        ])->one();        
    }
    
    /**
     * Делает то же, что и $this->initCurrentPageData(), только в качестве 
     * уточняющего идентификатора использует URL текущей страницы и возвращает 
     * результат без перезаписи свойства currentPage
     * 
     * @param string $url Часть URL текущей страницы
     * @return Mainpages Объект seo данных запрашиваемой страницы
     */
    public function initMainPageDataByUrl(string $url) 
    {
        return Mainpages::find()->where([
            'module_id' => $this->module->id,
            'controller_id' => $this->id,
            'url' => $url
        ])->one();
    }
    
    /**
     * Делает то же, что и $this->initCurrentPageData(), только в качестве 
     * уточняющего идентификатора использует action_id index текущей страницы и 
     * возвращает результат без перезаписи свойства currentPage
     * 
     * @param string $url Часть URL текущей страницы
     * @return Mainpages Объект seo данных запрашиваемой страницы
     */
    public function initParentPageData() 
    {
        return $this->currentPage = Mainpages::find()->where([
            'module_id' => $this->module->id,
            'controller_id' => $this->id,
            'action_id' => 'index'
        ])->one();
    }
    
    /**
     * Получение html meta и выдача http заголовков Last-Modified
     * 
     * @param string $timeString Метка времени update_at из базы данных
     * @return void 
     */
    protected function getLastModified($timeString = null)
    {
        if(is_null($timeString)) {
            $timeString = $this->currentPage->update_at;
        }
        $timestamp = strtotime($timeString);
        $lastModified = Yii::$app->lastmodified->get($timestamp);
//        $this->view->registerMetaTag(['http-equiv' => 'last-modified', 'content' => $lastModified]);
    }
   
}

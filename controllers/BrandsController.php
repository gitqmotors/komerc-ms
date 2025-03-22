<?php

/*
 * 03.12.2020
 * File: BrandsController.php
 * Encoding: UTF-8
 * Project: RMS special for Quality Motors team
 * 
 * Author: Gafuroff Alexandr 
 * E-mail: gafuroff.al@yandex.ru
 */

namespace app\controllers;

use app\models\CommonServicesScheme;
use app\models\County;
use app\models\District;
use app\models\Metro;
use PHPUnit\Framework\Constraint\Count;
use Yii;
use app\controllers\AppBaseController;
use app\models\Brands;
use app\models\Models;
use app\models\CommonServices;
use yii\helpers\Url;
use app\helpers\Subdomains;
use yii\web\NotFoundHttpException;

/**
 * Description of BrandsController
 *
 * @author Александр
 */
class BrandsController extends AppBaseController 
{
    
    /**
     * Displays site section brands page.
     *
     * @return string HTML
     */
    public function actionIndex()
    {

        $this->initCurrentPageData();
        $this->getLastModified();
        Yii::$app->seo->setData($this->currentPage);
        $brands = Brands::find()->orderBy('order')->all();
        return $this->render('index', compact('brands'));

    }

    /**
     * Displays brands item page.
     *
     * @return string HTML
     */
    public function actionItem() 
        {


                $core = $this->initParentPageData();
                $this->brand = Brands::find()->where(['url' => $this->route[0]])->one();
                $this->getLastModified($this->brand->update_at);
                //$this->brand->title = 'Ремонт '.$this->brand->name. ' в Москве - автосервис '. str_replace(array('(',')'), array('',''), $this->brand->rus_name) .' Раннинг Моторс';
//                $this->brand->title = 'Ремонт '. str_replace(array('(',')'), array('',''), $this->brand->rus_name) .' цена - автосервис '. $this->brand->name. ' Раннинг Моторс в Москве';
                $this->brand->title = 'Ремонт '. $this->brand->name .' цена - автосервис '. $this->brand->name. ' Раннинг Моторс в Москве';
//                $this->brand->description = '⭐⭐⭐⭐⭐ Качественный ремонт '. str_replace(array('(',')'), array('',''), $this->brand->rus_name) .' в Москве. 📍 Профильный автосервис '. $this->brand->name. '. ✅ Дешевле дилера до 60%. ✅ Гарантия на ремонт 2 года. 🚀 Ремонт '. $this->brand->name. ' по доступным ценам ⏰ Запись в автосервис «Раннинг Моторс» ☎️ 8(499)444-14-37';
                $this->brand->description = '⭐⭐⭐⭐⭐ Качественный ремонт '. $this->brand->name .' в Москве. 📍 Профильный автосервис '. $this->brand->name. '. ✅ Дешевле дилера до 60%. ✅ Гарантия на ремонт 2 года. 🚀 Ремонт '. $this->brand->name. ' по доступным ценам ⏰ Запись в автосервис «Раннинг Моторс» ☎️ 8(499)444-14-37';
                Yii::$app->seo->setData($this->brand);
                $models = Models::find()
                    ->where(['brand_id' => $this->brand->id])
                    ->andWhere(['status' => 1])
                    ->all();

                //redirect
                //error_log($this->brand->name . " Brand name");
                if(Subdomains::getStatusBrand($this->brand->url) == true){
                    $url= "http://".$this->brand->url_subdomain;
                    return Yii::$app->response->redirect($url, 301);
                }

                return $this->render('item', [
                    'core' => $core,
                    'brand' => $this->brand,
                    'models' => $models
                ]);


    }

    /**
     * Displays brands subdomain item page.
     *
     * @return string HTML
     */
    public function actionItemSubdomain()
    {
        $core = $this->initParentPageData();
        $brand = Subdomains::getBrand();
        $this->brand = Brands::find()->where(['url' => $brand])->one();
        //$this->brand = Brands::find()->where(['url' => $this->route[0]])->one();
        $this->getLastModified($this->brand->update_at);
        //$this->brand->title = 'Ремонт '.$this->brand->name. ' в Москве - автосервис '. str_replace(array('(',')'), array('',''), $this->brand->rus_name) .' Раннинг Моторс';
//        $this->brand->title = 'Ремонт '. str_replace(array('(',')'), array('',''), $this->brand->rus_name) .' цена - автосервис '. $this->brand->name. ' Раннинг Моторс в Москве';
        $this->brand->title = 'Ремонт '. $this->brand->name .' цена - автосервис '. $this->brand->name. ' Раннинг Моторс в Москве';
//        $this->brand->description = '⭐⭐⭐⭐⭐ Качественный ремонт '. str_replace(array('(',')'), array('',''), $this->brand->rus_name) .' в Москве. 📍 Профильный автосервис '. $this->brand->name. '. ✅ Дешевле дилера до 60%. ✅ Гарантия на ремонт 2 года. 🚀 Ремонт '. $this->brand->name. ' по доступным ценам ⏰ Запись в автосервис «Раннинг Моторс» ☎️ 8(499)444-14-37';
        $this->brand->description = '⭐⭐⭐⭐⭐ Качественный ремонт '. $this->brand->name .' в Москве. 📍 Профильный автосервис '. $this->brand->name. '. ✅ Дешевле дилера до 60%. ✅ Гарантия на ремонт 2 года. 🚀 Ремонт '. $this->brand->name. ' по доступным ценам ⏰ Запись в автосервис «Раннинг Моторс» ☎️ 8(499)444-14-37';
        Yii::$app->seo->setData($this->brand);
        $models = Models::find()
            ->where(['brand_id' => $this->brand->id])
            ->andWhere(['status' => 1])
            ->all();
        return $this->render('item', [
            'core' => $core,
            'brand' => $this->brand,
            'models' => $models
        ]);
    }
    
    /**
     * Displays brand service page.
     *
     * @return string HTML
     */
    public function actionService() 
    {
        $core = $this->initParentPageData();        
        $this->brand = Brands::find()->where(['url' => $this->route[0]])->one();
        $this->checkRedirects();
        if ($this->brand->seo_scheme != 0){
            $service = CommonServices::find()->where([
                'url' => $this->route[1],
            ])->one();
        } else {
            $service = CommonServices::find()->where([
                'url' => $this->route[1]
            ])->one();
        }

        if ($service !== null) {
            if (!$this->brand->isVAG() AND $service->isDSG()) {
                throw new NotFoundHttpException('Трансмиссия DSG должна относиться только к группе VAG');
            }
        }


        if(is_null($service)) {
            //TODO: Search service from individual services table whene will it
        } else {
            $service->setSeoData($this->brand);
        }
        $this->getLastModified($service->update_at);
        Yii::$app->seo->setData($service);
        //Redirection
        if(Subdomains::getStatusBrand($this->brand->url) == true){
            $url= "http://".$this->brand->url_subdomain."/".$service->url;
            return Yii::$app->response->redirect($url, 301);
        }
        return $this->render('service', [
            'core' => $core,
            'brand' => $this->brand,
            'service' => $service
       ]);
    }

    /**
     * Displays brand service page.
     *
     * @return string HTML
     */
    public function actionServiceSubdomain()
    {
        $core = $this->initParentPageData();
        $brand = Subdomains::getBrand();
        $this->brand = Brands::find()->where(['url' => $brand])->one();

        $service = CommonServices::find()->where([
            'url' => $this->route[0]
        ])->one();
        $this->checkRedirects();

        if ($service !== null) {
            if (!$this->brand->isVAG() AND $service->isDSG()) {
                throw new NotFoundHttpException('Трансмиссия DSG относится только к группе VAG');
            }
        }

        if(is_null($service)) {
            //TODO: Search service from individual services table whene will it
        } else {
            $service->setSeoData($this->brand);
        }

        $host = $_SERVER['HTTP_HOST'];
        if (str_contains($host, 'mercedes-benz') == true){
           // error_log("Hello i am hear " . $this->route[0]);
            if(!empty($this->route[0])){

                switch ( $this->route[0]){
                    case 'sniatieustanovka_kolesa_R13';
                    case 'sniatieustanovka_kolesa_R14';
                    case 'sniatieustanovka_kolesa_R15';
                    case 'sniatieustanovka_kolesa_R16';
                    case 'sniatieustanovka_kolesa_R17';
                    case 'sniatieustanovka_kolesa_R18';
                    case 'sniatieustanovka_kolesa_R19';
                    case 'sniatieustanovka_kolesa_R20';
                    case 'sniatieustanovka_kolesa_4x4_i_mikroavtobusa';
                    case 'razborkasborka_kolesa_R20_4x4_i_mikroavtobusa';
                    case 'balansirovka_kolesa_R13';
                    case 'balansirovka_kolesa_R14';
                    case 'balansirovka_kolesa_R15';
                    case 'balansirovka_kolesa_R16';
                    case 'balansirovka_kolesa_R17';
                    case 'balansirovka_kolesa_R18';
                    case 'balansirovka_kolesa_R19';
                    case 'balansirovka_kolesa_R20';
                    case 'balansirovka_kolesa_4x4_i_mikroavtobusa';
                    case 'kompleks_rabot_na_4_kolesa_R13';
                    case 'kompleks_rabot_na_4_kolesa_R14';
                    case 'kompleks_rabot_na_4_kolesa_R15';
                    case 'kompleks_rabot_na_4_kolesa_R16';
                    case 'kompleks_rabot_na_4_kolesa_R17';
                    case 'kompleks_rabot_na_4_kolesa_R18';
                    case 'kompleks_rabot_na_4_kolesa_R19';
                    case 'kompleks_rabot_na_4_kolesa_R20';
                    case 'kompleks_rabot_na_4_kolesa_4x4_i_mikroavtobusa';
                    case 'ochistka_borta_diska_i_germetizaciia';
                    case 'gruzy_dlia_balansirovki_odnogo_kolesa';
                    case 'gruzy_dlia_balansirovki_chetyreh_koles';
                    case 'remont_odnogo_kolesa_zhgutom';

                    $url= "http://".$this->brand->url_subdomain."/shinomontazh";
                        //$url= "https://nelset.com";
                    return Yii::$app->response->redirect($url, 301);

                    case 'zamena_zadnih_tormoznyh_kolodok_barabany';

                        $url= "http://".$this->brand->url_subdomain."/zamena_zadnih_tormoznyh_kolodok_diskovye";
                        return Yii::$app->response->redirect($url, 301);
                    default:
                    //     throw new \yii\web\NotFoundHttpException('Страница не найдена!');
                }

            }

        }



        $this->getLastModified($service->update_at);
        Yii::$app->seo->setData($service);
        return $this->render('service', [
            'core' => $core,
            'brand' => $this->brand,
            'service' => $service
        ]);
    }

    /**
     * Displays brand service page.
     *
     * @return string HTML
     */
    public function actionHomeSubdomain()
    {
        $url = "/" ;//. $brand->url_subdomain;
        return Yii::$app->response->redirect($url, 301);

    }

    public function checkRedirects(){
        $brandRedirectServices = [
            'zamena_zadnih_tormoznyh_kolodok_barabany_594',
            'zamena_perednei_balki',
            'zamena_sailentbloka_verhnego_rychaga_1_sht',
            'perepressovka_podshipnika_poluosi_1_sht',
            'zamena_prokladki_poddona',
            'zamena_kollektornyh_prokladok',
            'regulirovka_trosa_ruchnogo_tormoza',
            'zamena_magistralnoi_tormoznoi_trubki_1_sht',
            'zamena_priemnoi_chasti_glushitelia',
            'zamena_srednei_chasti_glushitelia',
            'zamena_zadnei_chasti_glushitelia',
            'zamena_odnogo_homuta',
            'razborkasborka_kolesa_R20_4x4_i_mikroavtobusa',
            'razborkasborka_kolesa_R20_4x4_i_mikroavtobusa',
            'sniatieustanovka_kolesa_R13',
            'sniatieustanovka_kolesa_R14',
            'sniatieustanovka_kolesa_R15',
            'sniatieustanovka_kolesa_R16',
            'sniatieustanovka_kolesa_R17',
            'sniatieustanovka_kolesa_R18',
            'sniatieustanovka_kolesa_R20',
            'sniatieustanovka_kolesa_4x4_i_mikroavtobusa',
            'sniatieustanovka_kolesa_R19',
            'balansirovka_kolesa_R13',
            'balansirovka_kolesa_R14',
            'balansirovka_kolesa_R15',
            'balansirovka_kolesa_R16',
            'balansirovka_kolesa_R17',
            'balansirovka_kolesa_R18',
            'balansirovka_kolesa_R19',
            'balansirovka_kolesa_R20',
            'balansirovka_kolesa_4x4_i_mikroavtobusa',
            'kompleks_rabot_na_4_kolesa_R13',
            'kompleks_rabot_na_4_kolesa_R14',
            'kompleks_rabot_na_4_kolesa_R15',
            'kompleks_rabot_na_4_kolesa_R16',
            'kompleks_rabot_na_4_kolesa_R17',
            'kompleks_rabot_na_4_kolesa_R18',
            'kompleks_rabot_na_4_kolesa_R19',
            'kompleks_rabot_na_4_kolesa_R20',
            'kompleks_rabot_na_4_kolesa_4x4_i_mikroavtobusa',
            'ochistka_borta_diska_i_germetizaciia',
            'gruzy_dlia_balansirovki_odnogo_kolesa',
            'gruzy_dlia_balansirovki_chetyreh_koles',
            'remont_odnogo_kolesa_zhgutom',
            'armaturnye_raboty',
            'kuzovnoi_remont_poroga',
            'remont_aliuminievyh_detalei_kuzova',
            'remont_aliuminievogo_kapota',
            'remont_aliuminievogo_kryla',
            'remont_aliuminievoi_dveri',
            'ustanovka_na_stapel',
            'stapelnye_raboty',
            'sniatie_i_ustanovka_obshivki_dveri_1_sht',
            'zamena_dveri_s_pereborkoi',
            'zamena_dvernoi_ruchki',
            'zamena_trosa_privoda_zamka_kapota',
            'zamena_zadnego_stekla',
            'zamena_trosa_kapota',
            'zamena_ruchki_kapota',
            'zamena_petel_kapota',
            'zamena_dveri_bagazhnika',
            'zamena_lampochki_bagazhnika',
            'zamena_provodki_bagazhnika',
            'zamena_lichinki_zamka_bagazhnika',
            'zamena_trosa_bagazhnika',
            'zamena_pola_bagazhnika',
            'zamena_stekla_bagazhnika',
            'remont_skolov_kraski',
            'lokalnyi_remont_skolov',
            'himchistka-pola',
            'himchistka-potolka',
            'polirovka-avtostekol',
            'polirovka-zhidkim-steklom',
            'moyka-podveski',
            'remont-i-vosstanovlenie-potolka',
            'remont-i-vosstanovlenie-plastika-torpedi',
            'remont-carapin-salona',
            'nanesenie-zhidkogo-stekla-ceramic-pro',
            'okleyka-zashchitnoy-plenkoy-ot-skolov',
            'okleyka-zashchitnoy-plenkoy-stekol',
            'okleyka-zashchitnoy-plenkoy-porogov',
            'okleyka-zashchitnoy-plenkoy-kapota',
            'okleyka-zashchitnoy-plenkoy-bampera',
            'remont_kpp',
            'zamena_pylnika_privoda_vnutrennego_shrus_sniatogo',
            'zamena_pylnika_privoda_naruzhnogo_shrus_sniatogo',
            'zamena_elastichnoi_mufty_kardana',
            'diagnostika_kpp',
            'diagnostika_inzhektora',
            'diagnostika_razdatki',
            'diagnostika_zadnego_mosta',
            'diagnostika_perednogo_mosta',
            'proverka_davleniia_v_toplivnoi_sisteme',
            'zamena_tosola',
            'zamena_tosola_s_promyvkoi',
            'zamena_datchika_ventiliatora',
            'zamena_datchika_temperatury',
            'zamena_rasshiritelnogo_bochka_sistemy_ohlazhdeniia',
            'remont_elektricheskih_uzlov_i_agregatov',
            'remont_sistemy_zazhiganiia',
            'schityvanie_kodov_neispravnosti',
            'antibakterialnaia_obrabotka',
            'remont_shlangov_kondicionera',
        ];
        if(in_array($this->route[array_key_last($this->route)], $brandRedirectServices)){
            if(Subdomains::getStatusBrand($this->brand->url) == true) $url = Url::base().'/';
            else $url = Url::base(). "/" . $this->brand->url. "/";
            return Yii::$app->response->redirect($url, 301);
        }
    }

    /**
     * Displays District item page.
     *
     * @return string HTML
     */
    public function actionDistrict()
    {

        $s = $this->route[2];
        $dist = "";
        $t = "Ремонт ";
        //$this->brand = Brands::find()->where(['url' => $this->route[0]])->one();
        $core = $this->initParentPageData();
        $this->brand = Brands::find()->where(['url' => $this->route[0]])->one();
        $this->getLastModified($this->brand->update_at);

        if($s == "avtoservis" or $s == "remont" or $s == "kuzovnoj-remont" or $s == "tekhnicheskoe-obsluzhivanie") {
            {
                $dist = County::find()->where(['url' => "/".$this->route[1]."/"])->one();
                if ($s == "avtoservis"){
                    $t = "Автосервис ";
                    $this->brand->title = $t. $this->brand->name ." ". $dist['name']. ' | Сервис ' . $this->brand->name.$this->brand->rus_name . ' Раннинг Моторс';
                    $this->brand->description = $t.' '. $this->brand->name .' '. $dist['name'] . ' 📍 Профильный автосервис '. $this->brand->name. '. ✅ Дешевле дилера до 60%. ✅ Гарантия на ремонт 2 года. 🚀 Ремонт '. $this->brand->name. $dist['name'] . ' по доступным ценам ⏰ Запись в автосервис «Раннинг Моторс» ☎️ 8(499)444-14-37';
                }
                if ($s == "remont"){
                    $t = "Ремонт ";
                    $this->brand->title = $t. $this->brand->name ." ". $dist['name']. ' | Цены на ремонт ' . $this->brand->name.$this->brand->rus_name . ' Раннинг Моторс';
                    $this->brand->description = $t.' '. $this->brand->name .' '. $dist['name'] . ' 📍 Профильный автосервис '. $this->brand->name. '. ✅ Дешевле дилера до 60%. ✅ Гарантия на ремонт 2 года. 🚀 Ремонт '. $this->brand->name . $dist['name'].  ' по доступным ценам ⏰ Запись в автосервис «Раннинг Моторс» ☎️ 8(499)444-14-37';
                }
                if ($s == "kuzovnoj-remont"){
                    $t = "Кузовной ремонт ";
                    $this->brand->title = $t. $this->brand->name ." ". $dist['name']. ' | Центр кузовного ремонта ' . $this->brand->name.$this->brand->rus_name . ' Раннинг Моторс';
                    $this->brand->description = $t.' '. $this->brand->name .' '. $dist['name'] . ' 📍 Профильный автосервис '. $this->brand->name. '. ✅ Дешевле дилера до 60%. ✅ Гарантия на ремонт 2 года. 🚀 Центр кузовного ремонта '. $this->brand->name.  $dist['name']. ' по доступным ценам ⏰ Запись в автосервис «Раннинг Моторс» ☎️ 8(499)444-14-37';
                }
                if ($s == "tekhnicheskoe-obsluzhivanie"){
                    $t = "Техническое обслуживание ";
                    $this->brand->title = $t. $this->brand->name ." ". $dist['name']. ' | Регламент и стоимость ТО ' . $this->brand->name.$this->brand->rus_name . ' в Раннинг Моторс';
                    $this->brand->description = $t.' '. $this->brand->name .' '.$dist['name'] . ' 📍 Профильный автосервис '. $this->brand->name. '. ✅ Дешевле дилера до 60%. ✅ Гарантия на ремонт 2 года. 🚀 Регламент и стоимость ТО '. $this->brand->name.  $dist['name']. ' ⏰ Запись в автосервис «Раннинг Моторс» ☎️ 8(499)444-14-37';
                }

            }
        }

        if(isset($this->route[3])) {
            $s = $this->route[3];
            if ($s == "avtoservis" or $s == "remont" or $s == "kuzovnoj-remont" or $s == "tekhnicheskoe-obsluzhivanie") {
                {

                    $dist = District::find()->where(['url' => "/".$this->route[1]."/".$this->route[2]."/"])->one();
                    if ($s == "avtoservis"){
                        $t = "Автосервис ";
                        $this->brand->title = $t. $this->brand->name ." ". $dist['name']. ' | Сервис ' . $this->brand->name.$this->brand->rus_name . ' Раннинг Моторс';
                        $this->brand->description = $t.' '. $this->brand->name .' '. $dist['name'] . ' 📍 Профильный автосервис '. $this->brand->name. '. ✅ Дешевле дилера до 60%. ✅ Гарантия на ремонт 2 года. 🚀 Ремонт '. $this->brand->name. $dist['name'] . ' по доступным ценам ⏰ Запись в автосервис «Раннинг Моторс» ☎️ 8(499)444-14-37';
                    }
                    if ($s == "remont"){
                        $t = "Ремонт ";
                        $this->brand->title = $t. $this->brand->name ." ". $dist['name']. ' | Цены на ремонт ' . $this->brand->name.$this->brand->rus_name . ' Раннинг Моторс';
                        $this->brand->description = $t.' '. $this->brand->name .' '. $dist['name'] . ' 📍 Профильный автосервис '. $this->brand->name. '. ✅ Дешевле дилера до 60%. ✅ Гарантия на ремонт 2 года. 🚀 Ремонт '. $this->brand->name . $dist['name'].  ' по доступным ценам ⏰ Запись в автосервис «Раннинг Моторс» ☎️ 8(499)444-14-37';
                    }
                    if ($s == "kuzovnoj-remont"){
                        $t = "Кузовной ремонт ";
                        $this->brand->title = $t. $this->brand->name ." ". $dist['name']. ' | Центр кузовного ремонта ' . $this->brand->name.$this->brand->rus_name . ' Раннинг Моторс';
                        $this->brand->description = $t.' '. $this->brand->name .' '. $dist['name'] . ' 📍 Профильный автосервис '. $this->brand->name. '. ✅ Дешевле дилера до 60%. ✅ Гарантия на ремонт 2 года. 🚀 Центр кузовного ремонта '. $this->brand->name.  $dist['name']. ' по доступным ценам ⏰ Запись в автосервис «Раннинг Моторс» ☎️ 8(499)444-14-37';
                    }
                    if ($s == "tekhnicheskoe-obsluzhivanie"){
                        $t = "Техническое обслуживание ";
                        $this->brand->title = $t. $this->brand->name ." ". $dist['name']. ' | Регламент и стоимость ТО ' . $this->brand->name.$this->brand->rus_name . ' в Раннинг Моторс';
                        $this->brand->description = $t.' '. $this->brand->name .' '.$dist['name'] . ' 📍 Профильный автосервис '. $this->brand->name. '. ✅ Дешевле дилера до 60%. ✅ Гарантия на ремонт 2 года. 🚀 Регламент и стоимость ТО '. $this->brand->name.  $dist['name']. ' ⏰ Запись в автосервис «Раннинг Моторс» ☎️ 8(499)444-14-37';
                    }
                }
            }
        }

        if(isset($this->route[4])){
            $s = $this->route[4];
            if($s == "avtoservis" or $s == "remont" or $s == "kuzovnoj-remont" or $s == "tekhnicheskoe-obsluzhivanie") {
                {

                    $dist = Metro::find()->where(['url' => "/".$this->route[1]."/".$this->route[2]."/".$this->route[3]."/"])->one();

                    if ($s == "avtoservis"){
                        $t = "Автосервис ";
                        $this->brand->title = $t. $this->brand->name ." ". $dist['name']. ' | Сервис ' . $this->brand->name.$this->brand->rus_name . ' Раннинг Моторс';
                        $this->brand->description = $t.' '. $this->brand->name .' '. $dist['name'] . ' 📍 Профильный автосервис '. $this->brand->name. '. ✅ Дешевле дилера до 60%. ✅ Гарантия на ремонт 2 года. 🚀 Ремонт '. $this->brand->name. $dist['name'] . ' по доступным ценам ⏰ Запись в автосервис «Раннинг Моторс» ☎️ 8(499)444-14-37';
                    }
                    if ($s == "remont"){
                        $t = "Ремонт ";
                        $this->brand->title = $t. $this->brand->name ." ". $dist['name']. ' | Цены на ремонт ' . $this->brand->name.$this->brand->rus_name . ' Раннинг Моторс';
                        $this->brand->description = $t.' '. $this->brand->name .' '. $dist['name'] . ' 📍 Профильный автосервис '. $this->brand->name. '. ✅ Дешевле дилера до 60%. ✅ Гарантия на ремонт 2 года. 🚀 Ремонт '. $this->brand->name . $dist['name'].  ' по доступным ценам ⏰ Запись в автосервис «Раннинг Моторс» ☎️ 8(499)444-14-37';
                    }
                    if ($s == "kuzovnoj-remont"){
                        $t = "Кузовной ремонт ";
                        $this->brand->title = $t. $this->brand->name ." ". $dist['name']. ' | Центр кузовного ремонта ' . $this->brand->name.$this->brand->rus_name . ' Раннинг Моторс';
                        $this->brand->description = $t.' '. $this->brand->name .' '. $dist['name'] . ' 📍 Профильный автосервис '. $this->brand->name. '. ✅ Дешевле дилера до 60%. ✅ Гарантия на ремонт 2 года. 🚀 Центр кузовного ремонта '. $this->brand->name.  $dist['name']. ' по доступным ценам ⏰ Запись в автосервис «Раннинг Моторс» ☎️ 8(499)444-14-37';
                    }
                    if ($s == "tekhnicheskoe-obsluzhivanie"){
                        $t = "Техническое обслуживание ";
                        $this->brand->title = $t. $this->brand->name ." ". $dist['name']. ' | Регламент и стоимость ТО ' . $this->brand->name.$this->brand->rus_name . ' в Раннинг Моторс';
                        $this->brand->description = $t.' '. $this->brand->name .' '.$dist['name'] . ' 📍 Профильный автосервис '. $this->brand->name. '. ✅ Дешевле дилера до 60%. ✅ Гарантия на ремонт 2 года. 🚀 Регламент и стоимость ТО '. $this->brand->name.  $dist['name']. ' ⏰ Запись в автосервис «Раннинг Моторс» ☎️ 8(499)444-14-37';
                    }


                }
            }
        }


        $this->brand->header = $t. $this->brand->name . $this->brand->rus_name." ". $dist['name'];
        Yii::$app->seo->setData($this->brand);

        if(Subdomains::getStatusBrand($this->brand->url) == true){
            $url= "http://".$this->brand->url_subdomain;
            return Yii::$app->response->redirect($url, 301);
        }

        return $this->render('district', [
            'core' => $core,
            'brand' => $this->brand,
            'h2' => $t. $this->brand->name . " ". $dist['name'],
            'hprice' => $t. $this->brand->name . " цена - ". $dist['name'],
            'dist' => $dist['services'],
        ]);


    }

    /**
     * Displays District item page.
     *
     * @return string HTML
     */
    public function actionDistrictSubdomain()
    {

        $s = $this->route[1];
        $dist = "";
        $t = "Ремонт ";
        //$this->brand = Brands::find()->where(['url' => $this->route[0]])->one();
        $core = $this->initParentPageData();
        $brand = Subdomains::getBrand();
        $this->brand = Brands::find()->where(['url' => $brand])->one();
        $this->getLastModified($this->brand->update_at);

        if($s == "avtoservis" or $s == "remont" or $s == "kuzovnoj-remont" or $s == "tekhnicheskoe-obsluzhivanie") {

            {
                $dist = County::find()->where(['url' => "/".$this->route[0]."/"])->one();
                if ($s == "avtoservis"){
                    $t = "Автосервис ";
                    $this->brand->title = $t. $this->brand->name ." ". $dist['name']. ' | Сервис ' . $this->brand->name.$this->brand->rus_name . ' Раннинг Моторс';
                    $this->brand->description = $t.' '. $this->brand->name .' '. $dist['name'] . ' 📍 Профильный автосервис '. $this->brand->name. '. ✅ Дешевле дилера до 60%. ✅ Гарантия на ремонт 2 года. 🚀 Ремонт '. $this->brand->name. $dist['name'] . ' по доступным ценам ⏰ Запись в автосервис «Раннинг Моторс» ☎️ 8(499)444-14-37';
                }
                if ($s == "remont"){
                    $t = "Ремонт ";
                    $this->brand->title = $t. $this->brand->name ." ". $dist['name']. ' | Цены на ремонт ' . $this->brand->name.$this->brand->rus_name . ' Раннинг Моторс';
                    $this->brand->description = $t.' '. $this->brand->name .' '. $dist['name'] . ' 📍 Профильный автосервис '. $this->brand->name. '. ✅ Дешевле дилера до 60%. ✅ Гарантия на ремонт 2 года. 🚀 Ремонт '. $this->brand->name . $dist['name'].  ' по доступным ценам ⏰ Запись в автосервис «Раннинг Моторс» ☎️ 8(499)444-14-37';
                }
                if ($s == "kuzovnoj-remont"){
                    $t = "Кузовной ремонт ";
                    $this->brand->title = $t. $this->brand->name ." ". $dist['name']. ' | Центр кузовного ремонта ' . $this->brand->name.$this->brand->rus_name . ' Раннинг Моторс';
                    $this->brand->description = $t.' '. $this->brand->name .' '. $dist['name'] . ' 📍 Профильный автосервис '. $this->brand->name. '. ✅ Дешевле дилера до 60%. ✅ Гарантия на ремонт 2 года. 🚀 Центр кузовного ремонта '. $this->brand->name.  $dist['name']. ' по доступным ценам ⏰ Запись в автосервис «Раннинг Моторс» ☎️ 8(499)444-14-37';
                }
                if ($s == "tekhnicheskoe-obsluzhivanie"){
                    $t = "Техническое обслуживание ";
                    $this->brand->title = $t. $this->brand->name ." ". $dist['name']. ' | Регламент и стоимость ТО ' . $this->brand->name.$this->brand->rus_name . ' в Раннинг Моторс';
                    $this->brand->description = $t.' '. $this->brand->name .' '.$dist['name'] . ' 📍 Профильный автосервис '. $this->brand->name. '. ✅ Дешевле дилера до 60%. ✅ Гарантия на ремонт 2 года. 🚀 Регламент и стоимость ТО '. $this->brand->name.  $dist['name']. ' ⏰ Запись в автосервис «Раннинг Моторс» ☎️ 8(499)444-14-37';
                }

            }
        }

        if(isset($this->route[2])) {
            $s = $this->route[2];

            if ($s == "avtoservis" or $s == "remont" or $s == "kuzovnoj-remont" or $s == "tekhnicheskoe-obsluzhivanie") {
                {

                    $dist = District::find()->where(['url' => "/".$this->route[0]."/".$this->route[1]."/"])->one();
                    if ($s == "avtoservis"){
                        $t = "Автосервис ";
                        $this->brand->title = $t. $this->brand->name ." ". $dist['name']. ' | Сервис ' . $this->brand->name.$this->brand->rus_name . ' Раннинг Моторс';
                        $this->brand->description = $t.' '. $this->brand->name .' '. $dist['name'] . ' 📍 Профильный автосервис '. $this->brand->name. '. ✅ Дешевле дилера до 60%. ✅ Гарантия на ремонт 2 года. 🚀 Ремонт '. $this->brand->name. $dist['name'] . ' по доступным ценам ⏰ Запись в автосервис «Раннинг Моторс» ☎️ 8(499)444-14-37';
                    }
                    if ($s == "remont"){
                        $t = "Ремонт ";
                        $this->brand->title = $t. $this->brand->name ." ". $dist['name']. ' | Цены на ремонт ' . $this->brand->name.$this->brand->rus_name . ' Раннинг Моторс';
                        $this->brand->description = $t.' '. $this->brand->name .' '. $dist['name'] . ' 📍 Профильный автосервис '. $this->brand->name. '. ✅ Дешевле дилера до 60%. ✅ Гарантия на ремонт 2 года. 🚀 Ремонт '. $this->brand->name . $dist['name'].  ' по доступным ценам ⏰ Запись в автосервис «Раннинг Моторс» ☎️ 8(499)444-14-37';
                    }
                    if ($s == "kuzovnoj-remont"){
                        $t = "Кузовной ремонт ";
                        $this->brand->title = $t. $this->brand->name ." ". $dist['name']. ' | Центр кузовного ремонта ' . $this->brand->name.$this->brand->rus_name . ' Раннинг Моторс';
                        $this->brand->description = $t.' '. $this->brand->name .' '. $dist['name'] . ' 📍 Профильный автосервис '. $this->brand->name. '. ✅ Дешевле дилера до 60%. ✅ Гарантия на ремонт 2 года. 🚀 Центр кузовного ремонта '. $this->brand->name.  $dist['name']. ' по доступным ценам ⏰ Запись в автосервис «Раннинг Моторс» ☎️ 8(499)444-14-37';
                    }
                    if ($s == "tekhnicheskoe-obsluzhivanie"){
                        $t = "Техническое обслуживание ";
                        $this->brand->title = $t. $this->brand->name ." ". $dist['name']. ' | Регламент и стоимость ТО ' . $this->brand->name.$this->brand->rus_name . ' в Раннинг Моторс';
                        $this->brand->description = $t.' '. $this->brand->name .' '.$dist['name'] . ' 📍 Профильный автосервис '. $this->brand->name. '. ✅ Дешевле дилера до 60%. ✅ Гарантия на ремонт 2 года. 🚀 Регламент и стоимость ТО '. $this->brand->name.  $dist['name']. ' ⏰ Запись в автосервис «Раннинг Моторс» ☎️ 8(499)444-14-37';
                    }
                }
            }
        }

        if(isset($this->route[3])){
            $s = $this->route[3];

            if($s == "avtoservis" or $s == "remont" or $s == "kuzovnoj-remont" or $s == "tekhnicheskoe-obsluzhivanie") {
                {

                    $dist = Metro::find()->where(['url' => "/".$this->route[0]."/".$this->route[1]."/".$this->route[2]."/"])->one();

                    if ($s == "avtoservis"){
                        $t = "Автосервис ";
                        $this->brand->title = $t. $this->brand->name ." ". $dist['name']. ' | Сервис ' . $this->brand->name.$this->brand->rus_name . ' Раннинг Моторс';
                        $this->brand->description = $t.' '. $this->brand->name .' '. $dist['name'] . ' 📍 Профильный автосервис '. $this->brand->name. '. ✅ Дешевле дилера до 60%. ✅ Гарантия на ремонт 2 года. 🚀 Ремонт '. $this->brand->name. $dist['name'] . ' по доступным ценам ⏰ Запись в автосервис «Раннинг Моторс» ☎️ 8(499)444-14-37';
                    }
                    if ($s == "remont"){
                        $t = "Ремонт ";
                        $this->brand->title = $t. $this->brand->name ." ". $dist['name']. ' | Цены на ремонт ' . $this->brand->name.$this->brand->rus_name . ' Раннинг Моторс';
                        $this->brand->description = $t.' '. $this->brand->name .' '. $dist['name'] . ' 📍 Профильный автосервис '. $this->brand->name. '. ✅ Дешевле дилера до 60%. ✅ Гарантия на ремонт 2 года. 🚀 Ремонт '. $this->brand->name . $dist['name'].  ' по доступным ценам ⏰ Запись в автосервис «Раннинг Моторс» ☎️ 8(499)444-14-37';
                    }
                    if ($s == "kuzovnoj-remont"){
                        $t = "Кузовной ремонт ";
                        $this->brand->title = $t. $this->brand->name ." ". $dist['name']. ' | Центр кузовного ремонта ' . $this->brand->name.$this->brand->rus_name . ' Раннинг Моторс';
                        $this->brand->description = $t.' '. $this->brand->name .' '. $dist['name'] . ' 📍 Профильный автосервис '. $this->brand->name. '. ✅ Дешевле дилера до 60%. ✅ Гарантия на ремонт 2 года. 🚀 Центр кузовного ремонта '. $this->brand->name.  $dist['name']. ' по доступным ценам ⏰ Запись в автосервис «Раннинг Моторс» ☎️ 8(499)444-14-37';
                    }
                    if ($s == "tekhnicheskoe-obsluzhivanie"){
                        $t = "Техническое обслуживание ";
                        $this->brand->title = $t. $this->brand->name ." ". $dist['name']. ' | Регламент и стоимость ТО ' . $this->brand->name.$this->brand->rus_name . ' в Раннинг Моторс';
                        $this->brand->description = $t.' '. $this->brand->name .' '.$dist['name'] . ' 📍 Профильный автосервис '. $this->brand->name. '. ✅ Дешевле дилера до 60%. ✅ Гарантия на ремонт 2 года. 🚀 Регламент и стоимость ТО '. $this->brand->name.  $dist['name']. ' ⏰ Запись в автосервис «Раннинг Моторс» ☎️ 8(499)444-14-37';
                    }


                }
            }
        }


        $this->brand->header = $t. $this->brand->name . $this->brand->rus_name." ". $dist['name'];
        Yii::$app->seo->setData($this->brand);

        return $this->render('district', [
            'core' => $core,
            'brand' => $this->brand,
            'h2' => $t. $this->brand->name . " ". $dist['name'],
            'hprice' => $t. $this->brand->name . " цена - ". $dist['name'],
            'dist' => $dist['services'],
        ]);


    }

    public function actionMapDistrict()
    {
        $countys = County::find()->asArray()->all();
        $metroes = Metro::find()->asArray()->all();
        $districts = District::find()->asArray()->all();
        $core = $this->initParentPageData();
        $this->brand = Brands::find()->where(['url' => $this->route[0]])->one();

        $this->brand->title = "Карта по районам и метро";
        $this->brand->description = "Карта по районам и метро ltcr";
        $this->brand->header = "Header set";

        $s = $this->route[2];
        $name = "Автосервис";
        if($s == "avtoservis"){
            $name = "Автосервис";
        }
        else if ($s == "remont"){
            $name = "Ремонт";
        }
        else if ($s == "kuzovnoj-remont"){
            $name = "Кузовной ремонт";
        }
        else if ($s == "tekhnicheskoe-obsluzhivanie"){
            $name = "Техническое обслуживание";
        }

        Yii::$app->seo->setData($this->brand);

        return $this->render('mapdistrict', [
            'core' => $core,
            'brand' => $this->brand,
            'h2' => $this->brand->name . " по районам и метро",

            //'hprice' => $t. $this->brand->name . " цена - ". $dist['name'],
            'countys' => $countys,
            'districts' => $districts,
            'metroes' => $metroes,

            'name' => $name,
            's' => $s,
        ]);


    }

    public function actionMapDistrictSubdomain()
    {
        $countys = County::find()->asArray()->all();
        $metroes = Metro::find()->asArray()->all();
        $districts = District::find()->asArray()->all();
        $core = $this->initParentPageData();
        $brand = Subdomains::getBrand();
        $this->brand = Brands::find()->where(['url' => $brand])->one();

        $this->brand->title = "Карта по районам и метро";
        $this->brand->description = "Карта по районам и метро ltcr";
        $this->brand->header = "Header set";

        $s = $this->route[1];

        Yii::$app->seo->setData($this->brand);
        $name = "Автосервис";
        if($s == "avtoservis"){
            $name = "Автосервис";
        }
        else if ($s == "remont"){
            $name = "Ремонт";
        }
        else if ($s == "kuzovnoj-remont"){
            $name = "Кузовной ремонт";
        }
        else if ($s == "tekhnicheskoe-obsluzhivanie"){
            $name = "Техническое обслуживание";
        }

        return $this->render('mapdistrictsub', [
            'core' => $core,
            'brand' => $this->brand,
            'h2' => $this->brand->name . " по районам и метро",

            //'hprice' => $t. $this->brand->name . " цена - ". $dist['name'],
            'countys' => $countys,
            'districts' => $districts,
            'metroes' => $metroes,
            'name' => $name,
            's' => $s,
        ]);


    }

}

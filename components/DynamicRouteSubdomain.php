<?php

namespace app\components;

use yii\base\BootstrapInterface;
use yii\db\Exception;
use yii\web\Application;

class DynamicRouteSubdomain implements BootstrapInterface
{
    /**
     * @param Application $app
     * @return void
     * @throws Exception
     */
    public function bootstrap($app)
    {
        $db = $app->getDb();

        $cache = $app->getCache();
        $cacheKey = md5(__CLASS__);

        $cacheItem = $cache->get($cacheKey);

        if ($cacheItem === false) {
//        $brands = $db->createCommand('SELECT url FROM brands')->queryColumn();
//        $brandsSeoFilter = $db->createCommand('SELECT url FROM brands WHERE seo_filter = 1')->queryColumn();
            $models = $db->createCommand('SELECT url FROM models')->queryColumn();
            $commonServices = $db->createCommand('SELECT url FROM common_services')->queryColumn();
            $indepServices = $db->createCommand('SELECT url FROM indep_services')->queryColumn();
            $countys = $db->createCommand('SELECT url FROM seo_county')->queryColumn();
            $metroes = $db->createCommand('SELECT url FROM seo_metro')->queryColumn();
            $districts = $db->createCommand('SELECT url FROM seo_district')->queryColumn();

            $routeArray = [];

            // brands
//        $controllers = implode('|', $brands);
//        $alias = '<action:(' . $controllers . ')>';
//        $rule = 'brands/item';
//        $routeArray[] = ['class' => 'yii\web\UrlRule', 'pattern' => $alias, 'route' => $rule];

            // brand services
            $servicesActions = implode('|', $commonServices);
            $alias = '<action:(' . $servicesActions . ')>';
            $rule = 'brands/service-subdomain';
            $routeArray[] = ['class' => 'yii\web\UrlRule', 'pattern' => $alias, 'route' => $rule];

            // models
            $modelActions = implode('|', $models);
            //<controller:(' . $controllers . ')>/
            $alias = '<action:(' . $modelActions . ')>';
            $rule = 'model/index-subdomain';
            $routeArray[] = ['class' => 'yii\web\UrlRule', 'pattern' => $alias, 'route' => $rule];

            // model services
            //<controller:(' . $controllers . ')>/
            $alias = '<action:(' . $modelActions . ')>/<service:(' . $servicesActions . ')>';
            $rule = 'model/service-subdomain';
            $routeArray[] = ['class' => 'yii\web\UrlRule', 'pattern' => $alias, 'route' => $rule];

            // independence services
            $actions = implode('|', $indepServices);
            $alias = '<action:(' . $actions . ')>';
            $rule = 'service/item';
            $routeArray[] = ['class' => 'yii\web\UrlRule', 'pattern' => $alias, 'route' => $rule];

            // districtPages
            $arrayServices = implode('|', ['remont', 'avtoservis', 'kuzovnoj-remont', 'tekhnicheskoe-obsluzhivanie']);

            //Генерация округов
            $countys = array_map(function ($url) {
                return trim($url, '/ ');
            }, $countys);
            $countysItems = implode('|', $countys);
            $alias = '<dist:(' . $countysItems . ')>/<service:(' . $arrayServices . ')>';
            $rule = 'brands/district-subdomain';
            $routeArray[] = ['class' => 'yii\web\UrlRule', 'pattern' => $alias, 'route' => $rule, 'encodeParams' => false];

            //Район
            $districts = array_map(function ($url) {
                return substr($url, 1);
            }, $districts);
            $districtsItems = implode('|', $districts);
            $alias = '<dist:(' . $districtsItems . ')><service:(' . $arrayServices . ')>';
            $rule = 'brands/district-subdomain';
            $routeArray[] = ['class' => 'yii\web\UrlRule', 'pattern' => $alias, 'route' => $rule, 'encodeParams' => false];

            //Метро
            $metroes = array_map(function ($url) {
                return substr($url, 1);
            }, $metroes);
            $metroesItems = implode('|', $metroes);
            $alias = '<dist:(' . $metroesItems . ')><service:(' . $arrayServices . ')>';
            $rule = 'brands/district-subdomain';
            $routeArray[] = ['class' => 'yii\web\UrlRule', 'pattern' => $alias, 'route' => $rule, 'encodeParams' => false];

            $alias = 'dist/<service:(' . $arrayServices . ')>';
            $rule = 'brands/map-district-subdomain';
            $routeArray[] = ['class' => 'yii\web\UrlRule', 'pattern' => $alias, 'route' => $rule, 'encodeParams' => false];

            $cache->set($cacheKey, $routeArray, $duration = 0);
            $cacheItem = $cache->get($cacheKey);
        }

        $app->getUrlManager()->addRules($cacheItem);
    }
}

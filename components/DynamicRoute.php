<?php

namespace app\components;

use yii\base\BootstrapInterface;
use yii\db\Exception;
use yii\web\Application;

class DynamicRoute implements BootstrapInterface
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
            $brands = $db->createCommand('SELECT url FROM brands')->queryColumn();
            $brandsSeoFilter = $db->createCommand('SELECT url FROM brands WHERE seo_filter = 1')->queryColumn();
            $models = $db->createCommand('SELECT url FROM models')->queryColumn();
            $commonServices = $db->createCommand('SELECT url FROM common_services')->queryColumn();
            $indepServices = $db->createCommand('SELECT url FROM indep_services')->queryColumn();
            $countys = $db->createCommand('SELECT url FROM seo_county')->queryColumn();
            $metroes = $db->createCommand('SELECT url FROM seo_metro')->queryColumn();
            $districts = $db->createCommand('SELECT url FROM seo_district')->queryColumn();

            $routeArray = [];

            // brands
            $controllers = implode('|', $brands);
            $alias = '<action:(' . $controllers . ')>';
            $rule = 'brands/item';
            $routeArray[] = ['class' => 'yii\web\UrlRule', 'pattern' => $alias, 'route' => $rule];

            // brand services
            $servicesActions = implode('|', $commonServices);
            $alias = '<controller:(' . $controllers . ')>/<action:(' . $servicesActions . ')>';
            $rule = 'brands/service';
            $routeArray[] = ['class' => 'yii\web\UrlRule', 'pattern' => $alias, 'route' => $rule];

            // models
            $modelActions = implode('|', $models);
            $alias = '<controller:(' . $controllers . ')>/<action:(' . $modelActions . ')>';
            $rule = 'model/index';
            $routeArray[] = ['class' => 'yii\web\UrlRule', 'pattern' => $alias, 'route' => $rule];

            // model services
            $alias = '<controller:(' . $controllers . ')>/<action:(' . $modelActions . ')>/<service:(' . $servicesActions . ')>';
            $rule = 'model/service';
            $routeArray[] = ['class' => 'yii\web\UrlRule', 'pattern' => $alias, 'route' => $rule];

            // independence services
            $actions = implode('|', $indepServices);
            $alias = '<action:(' . $actions . ')>';
            $rule = 'service/item';
            $routeArray[] = ['class' => 'yii\web\UrlRule', 'pattern' => $alias, 'route' => $rule];


            $controllers2 = implode('|', $brandsSeoFilter);

            // districtPages
            $arrayServices = implode('|', ['remont', 'avtoservis', 'kuzovnoj-remont', 'tekhnicheskoe-obsluzhivanie']);

            //Генерация округов
            $countys = array_map(function ($url) {
                return trim($url, '/ ');
            }, $countys);
            $countysItems = implode('|', $countys);
            $alias = '<controller:(' . $controllers2 . ')>/<dist:(' . $countysItems . ')>/<service:(' . $arrayServices . ')>';
            $rule = 'brands/district';
            $routeArray[] = ['class' => 'yii\web\UrlRule', 'pattern' => $alias, 'route' => $rule];

            //Метро
            $metroesItems = implode('|', $metroes);
            $alias = '<controller:(' . $controllers2 . ')><dist:(' . $metroesItems . ')><service:(' . $arrayServices . ')>';
            $rule = 'brands/district';
            $routeArray[] = ['class' => 'yii\web\UrlRule', 'pattern' => $alias, 'route' => $rule, 'encodeParams' => false];

            //Район
            $districts = array_map(function ($url) {
                return str_replace("%2F", '/', $url);
            }, $districts);
            $districtsItems = implode('|', $districts);
            $alias = '<controller:(' . $controllers2 . ')><dist:(' . $districtsItems . ')><service:(' . $arrayServices . ')>';
            $rule = 'brands/district';
            $routeArray[] = ['class' => 'yii\web\UrlRule', 'pattern' => $alias, 'route' => $rule, 'encodeParams' => false];

            /*$alias = '<controller:(' . implode('|', $controllers2) . ')><dist:(' . implode('|', $districtsItems) . ')><service:(' . implode('|', $arrayServices) . ')>';
            $rule = 'brands/district';
            $routeArray[] = ['class' => 'yii\web\UrlRule', 'pattern' => $alias, 'route' => $rule, 'encodeParams' => false];*/

            $alias = '<controller:(' . $controllers2 . ')>/dist/<service:(' . $arrayServices . ')>';
            $rule = 'brands/map-district';
            $routeArray[] = ['class' => 'yii\web\UrlRule', 'pattern' => $alias, 'route' => $rule, 'encodeParams' => false];

            $cache->set($cacheKey, $routeArray, $duration = 0);
            $cacheItem = $cache->get($cacheKey);
        }

        $app->getUrlManager()->addRules($cacheItem);
    }
}

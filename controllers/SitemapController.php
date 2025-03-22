<?php

namespace app\controllers;

use app\helpers\Subdomains;
use app\models\Pricelist;
use DateTime;
use Exception;
use Iterator;
use Sitemap;
use SitemapIndex;
use Throwable;
use Yii;
use yii\helpers\Url;
use yii\web\Controller;

class SitemapController extends Controller
{
    public function actionBuild()
    {
        $dateNow = new DateTime();

        $sitemapWriter = $this->sitemapWriterGen();

        // Разделы сайта
        $sitemapWriter->send([Url::base(true), $dateNow]);
        $sitemapWriter->send([Url::toRoute(['site/pricelist'], true), $dateNow]);
        $sitemapWriter->send([Url::toRoute(['site/company'], true), $dateNow]);
        $sitemapWriter->send([Url::toRoute(['site/contacts'], true), $dateNow]);
        $sitemapWriter->send([Url::toRoute(['site/agreement'], true), $dateNow]);
        $sitemapWriter->send([Url::toRoute(['service/index'], true), $dateNow]);
        $sitemapWriter->send([Url::toRoute(['brands/index'], true), $dateNow]);
        $sitemapWriter->send([Url::toRoute(['campaigns/index'], true), $dateNow]);
        $sitemapWriter->send([Url::toRoute(['/gallery'], true), $dateNow]);
        $sitemapWriter->send([Url::toRoute(['/news'], true), $dateNow]);
        $sitemapWriter->send([Url::toRoute(['/vacancy'], true), $dateNow]);
        $sitemapWriter->send([Url::toRoute(['/feedbacks'], true), $dateNow]);

        // Акции
        foreach ($this->getCampaigns() as $campaignUrl) {
            $sitemapWriter->send([Url::toRoute(['campaigns/item', 'action' => $campaignUrl], true), $dateNow]);
        }

        // Наши работы
        foreach ($this->getPortfolio() as $portfolioUrl) {
            $sitemapWriter->send([Url::toRoute(['gallery/item', 'action' => $portfolioUrl], true), $dateNow]);
        }

        // Новости
        foreach ($this->getNews() as $newsUrl) {
            $sitemapWriter->send([Url::toRoute(['news/item', 'action' => $newsUrl], true), $dateNow]);
        }

        // Вакансии
        foreach ($this->getVacancy() as $vacancyUrl) {
            $sitemapWriter->send([Url::toRoute(['vacancy/item', 'action' => $vacancyUrl], true), $dateNow]);
        }

        // Отзывы клиентов
        foreach ($this->getFeedbacks() as $feedbackUrl) {
            $sitemapWriter->send([Url::toRoute(['feedbacks/item', 'action' => $feedbackUrl], true), $dateNow]);
        }

        // Марки
        foreach ($this->getBrands() as $brandUrl) {
            $sitemapWriter->send([Url::toRoute(['brands/item', 'action' => $brandUrl], true), $dateNow]);

            // Услуги по маркам
            foreach ($this->getCommonServices($brandUrl) as $commonServiceUrl) {
                $sitemapWriter->send(
                    [
                        Url::toRoute(['brands/service', 'controller' => $brandUrl, 'action' => $commonServiceUrl], true),
                        $dateNow
                    ]
                );
            }

            // Модели
            foreach ($this->getModels($brandUrl) as $model) {
                $sitemapWriter->send(
                    [
                        Url::toRoute(['model/index', 'controller' => $brandUrl, 'action' => $model['url']], true),
                        $dateNow
                    ]
                );

                // Услуги по моделям
                $hide_url_price_list = (int)$model['hide_url_price_list'];

                if ($hide_url_price_list > 0) {
                    continue;
                }

                foreach ($this->getCommonServices($brandUrl) as $commonServiceUrl) {
                    $sitemapWriter->send(
                        [
                            Url::toRoute(
                                [
                                    'model/service',
                                    'controller' => $brandUrl,
                                    'action'     => $model['url'],
                                    'service'    => $commonServiceUrl
                                ],
                                true
                            ),
                            $dateNow
                        ]
                    );
                }
            }
        }

        // Услуги
        foreach ($this->getIndepServices() as $indepServiceUrl) {
            $sitemapWriter->send([Url::toRoute(['service/item', 'action' => $indepServiceUrl], true), $dateNow]);
        }

        foreach ($this->getSeoFilterBrands() as $brandUrl) {
            // Округа
            foreach ($this->getCountys() as $countyUrl) {
                foreach ($this->getDistrictPages() as $serviceUrl) {
                    $sitemapWriter->send(
                        [
                            Url::toRoute(
                                [
                                    'brands/district',
                                    'controller' => $brandUrl,
                                    'dist'       => $countyUrl,
                                    'service'    => $serviceUrl
                                ],
                                true
                            ),
                            $dateNow
                        ]
                    );
                }
            }

            // Метро
            foreach ($this->getMetro() as $metroUrl) {
                foreach ($this->getDistrictPages() as $serviceUrl) {
                    $sitemapWriter->send(
                        [
                            Url::toRoute(
                                [
                                    'brands/district',
                                    'controller' => $brandUrl,
                                    'dist'       => $metroUrl,
                                    'service'    => $serviceUrl
                                ],
                                true
                            ),
                            $dateNow
                        ]
                    );
                }
            }

            // Районы
            foreach ($this->getDistricts() as $districtUrl) {
                foreach ($this->getDistrictPages() as $serviceUrl) {
                    $sitemapWriter->send(
                        [
                            Url::toRoute(
                                [
                                    'brands/district',
                                    'controller' => $brandUrl,
                                    'dist'       => $districtUrl,
                                    'service'    => $serviceUrl
                                ],
                                true
                            ),
                            $dateNow
                        ]
                    );
                }
            }

            // map-district
            foreach ($this->getDistrictPages() as $serviceUrl) {
                $sitemapWriter->send(
                    [
                        Url::toRoute(
                            [
                                'brands/map-district',
                                'controller' => $brandUrl,
                                'service'    => $serviceUrl
                            ],
                            true
                        ),
                        $dateNow
                    ]
                );
            }
        }

        // Конец записи
        $sitemapWriter->throw(new Exception('StopGenerator'));

        // Запись в индексный файл
        $sitemapindex = new SitemapIndex(Yii::getAlias('@webroot/sitemap.xml'));

        foreach ($sitemapWriter->getReturn() as $filename) {
            $sitemapindex->url(Url::to($filename, true), $dateNow);
        }

        // Закрытие индексного файла
        $sitemapindex->close();

        Yii::$app
            ->getResponse()
            ->getHeaders()
            ->set('cache-control', 'no-cache, no-store, must-revalidate')
            ->set('X-Robots-Tag', 'none')
        ;

        return 'Карта создана';
    }

    /**
     * @return array|Iterator
     * @throws Throwable
     */
    private function sitemapWriterGen()
    {
        $filenameFn = function () {
            static $n = 0;

            return Yii::getAlias('@webroot/sitemap-' . (++$n) . '.xml');
        };

        // Формирование списка созданных карт для дальнейшей записи в индексный файл
        $files = [];
        $counter = 0;
        $limit = 50000;

        $sitemapCreator = function () use ($filenameFn, &$files) {
            $filename = $filenameFn();
            $files[] = basename($filename);
            return new Sitemap($filename);
        };

        $sitemapInstance = $sitemapCreator();

        try {
            while (true) {
                [$loc, $lastmod] = yield;

                $sitemapInstance->url($loc, $lastmod);

                if ($limit <= ++$counter) {
                    $sitemapInstance = $sitemapCreator();

                    // Сброс значений
                    $counter = 0;
                }
            }
        } catch (Throwable $e) {
            if ($e->getMessage() != 'StopGenerator') {
                throw $e;
            }
        }

        return $files;
    }


    /**
     * @return array
     */
    private function getCampaigns()
    {
        return Yii::$app->getDb()->createCommand('SELECT url FROM campaigns WHERE status = 1')->queryColumn();
    }


    /**
     * @return array
     */
    private function getPortfolio()
    {
        return Yii::$app->getDb()->createCommand('SELECT url FROM portfolio WHERE status = 1')->queryColumn();
    }


    /**
     * @return array
     */
    private function getNews()
    {
        return Yii::$app->getDb()->createCommand('SELECT url FROM news WHERE active = 1')->queryColumn();
    }


    /**
     * @return array
     */
    private function getVacancy()
    {
        return Yii::$app->getDb()->createCommand('SELECT url FROM vacancy WHERE status = 1')->queryColumn();
    }


    /**
     * @return array
     */
    private function getFeedbacks()
    {
        return Yii::$app->getDb()->createCommand('SELECT url FROM feedbacks WHERE active = 1')->queryColumn();
    }


    /**
     * @return array
     */
    private function getBrands()
    {
        $brands = Yii::$app->getDb()->createCommand('SELECT url FROM brands WHERE status = 1')->queryColumn();

        return array_filter($brands, function ($brandUrl) {
            return !Subdomains::getStatusBrand($brandUrl);
        });
    }


    /**
     * @return array
     */
    private function getSeoFilterBrands()
    {
        $brands = Yii::$app
            ->getDb()
            ->createCommand('SELECT url FROM brands WHERE status = 1 AND seo_filter = 1')
            ->queryColumn()
        ;

        return array_filter($brands, function ($brandUrl) {
            return !Subdomains::getStatusBrand($brandUrl);
        });
    }

    /**
     * @param string $brandUrl
     * @return array
     */
    private function getModels(string $brandUrl)
    {
        $sql = <<<'SQL'
SELECT m.url, m.hide_url_price_list
FROM models m
    JOIN brands b
        ON b.id = m.brand_id
WHERE b.url = :brandUrl 
  AND m.status = 1
SQL;

        return Yii::$app->db->createCommand($sql)->bindValue(':brandUrl', $brandUrl)->queryAll();
    }

    /**
     * @return array
     */
    private function getCommonServices(string $brandUrl)
    {
        static $services = [];

        if (!isset($services[$brandUrl])) {
            $pricelist = Pricelist::find()->where(['hidden' => 0])->joinWith(['commonservice'])->all(Yii::$app->db);

            // Фильтруются услуги по ремонту трансмиссий DSG, если это не группа VAG
            $pricelist = array_filter($pricelist, function (Pricelist $item) use ($brandUrl) {
                if ($this->isVAG($brandUrl)) {
                    if ($item->commonservice !== null && $item->commonservice->isDSG()) {
                        return false;
                    }
                }

                return true;
            });

            $commonservices = [];

            /**
             * @var Pricelist $item
             */
            foreach ($pricelist as $item) {
                if ($item->commonservice !== null) {
                    $commonservices[] = $item->commonservice->url;
                }
            }

            $commonservices = array_filter($commonservices, function ($serviceUrl) {
                return !in_array(
                    $serviceUrl,
                    // См. blocks/Pricelist/PricelistBlock.php:110 и blocks/Pricelist/PricelistBlock.php:118
                    ['promyvka_drosselnoi_zaslonki', 'zamena_zadnih_tormoznyh_kolodok_barabany_594']
                );
            });

            $services[$brandUrl] = $commonservices;
        }

        return $services[$brandUrl];
    }

    /**
     * @return array
     */
    private function getIndepServices()
    {
        $sql = <<<'SQL'
SELECT iserv.url 
FROM indep_services iserv
    JOIN pricelist pl
        ON iserv.price_id = pl.id
SQL;

        return Yii::$app->getDb()->createCommand($sql)->queryColumn();
    }

    /**
     * @return array
     */
    private function getCountys()
    {
        $countys = Yii::$app->getDb()->createCommand('SELECT url FROM seo_county')->queryColumn();

        return array_map(function ($url) {
            return trim($url, '/ ');
        }, $countys);
    }

    /**
     * @return array
     */
    private function getMetro()
    {
        return Yii::$app->getDb()->createCommand('SELECT url FROM seo_metro')->queryColumn();
    }

    /**
     * @return array
     */
    private function getDistricts()
    {
        return Yii::$app->getDb()->createCommand('SELECT url FROM seo_district')->queryColumn();
    }

    /**
     * @return string[]
     */
    private function getDistrictPages()
    {
        return ['remont', 'avtoservis', 'kuzovnoj-remont', 'tekhnicheskoe-obsluzhivanie'];
    }

    /**
     * @param string $brandUrl
     * @return bool
     */
    private function isVAG(string $brandUrl)
    {
        $vagGroup = [
            'volkswagen',
            'audi',
            'skoda',
            'porsche',
            'seat',
            'bentley'
        ];

        $brand = strtolower($brandUrl);

        return in_array($brand, $vagGroup);
    }
}

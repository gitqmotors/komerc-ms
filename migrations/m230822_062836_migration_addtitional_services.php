<?php

use app\models\Brands;
use app\models\CommonServices;
use app\models\IndependensServices;
use app\models\Models;
use app\models\Ourworks;
use app\models\Pricelist;
use yii\db\Migration;
use yii\helpers\Inflector;

/**
 * Class m230822_062836_migration_addtitional_services
 */
class m230822_062836_migration_addtitional_services extends Migration
{
    private string|bool $date;
    private array $slugs;
    private array $ourWorksAliases;
    private string $ourWorksImageDir;

    public function init()
    {
        parent::init();

        $this->date = (new \DateTimeImmutable('2023-08-22'))->format('Y-m-d H:i:s');

        $serviceDataFilename = __DIR__ . '/data/data_m201127_063933.php';

        // Не критично, если файл не будет найден
        if (file_exists($serviceDataFilename)) {
            $dataArray = include $serviceDataFilename;

            foreach ($dataArray as $data) {
                if (!empty($data['url'])) {
                    $this->slugs[$data['name']] = $data['url'];
                }
            }
        }

        $this->ourWorksAliases = [
            'tehnicheskoe_obsluzhivanie' => 'to',
            'remont_hodovoi_chasti_podveski_avtomobilia' => 'hodovaya',
            'remont_dvigatelia' => 'diz-dvigetel',
            'remont-dizelnogo-dvigatela' => 'diz-dvigetel',
            'remont_dizelnogo_dvigatelya' => 'diz-dvigetel',
            'kuzovnoi_remont' => 'kuzov',
            'pokraska_avtomobilia' => 'pokraska',
            'moika_himchistka_polirovka_avtomobilia' => 'plenka',
            'diagnostika_avtomobilia' => 'diagnostics',
            'remont_transmissii' => 'transmission',
            'remont_rulevogo_upravleniia' => 'rulevoe',
            'remont_tormoznoi_sistemy' => 'tormoz',
            'remont_toplivnoi__sistemy' => 'remont_toplivnoi__sistemy',
            'remont_sistemy_ohlazhdeniia' => 'remont_sistemy_ohlazhdeniia',
            'remont_vyhlopnoi__sistemy' => 'remont_vyhlopnoi__sistemy',
            'remont_kondicionera' => 'kondicioner',
            'shinomontazh' => 'shinomontazh',
            'remont_elektrooborudovaniia' => 'elektro',
        ];

        $this->ourWorksImageDir = Yii::getAlias('@app') . '/public_html/uploads/images/ourworks/';
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        printf("Загрузка недостающих услуг у марок\n");
        printf("Добавление общих страниц-услуг...\n");

        // Получение списка услуг, которые есть в прайс-листе, но отсутствуют в indep_services
        $sql = 'SELECT pl.* FROM '
            . IndependensServices::tableName()
            . ' AS srv RIGHT JOIN '
            . Pricelist::tableName()
            . ' AS pl ON pl.id = srv.price_id WHERE srv.id IS NULL ORDER BY pl.parent_id'
        ;

        $priceList = $this->db->createCommand($sql)->queryAll();

        foreach ($priceList as $service) {
            $price = new Pricelist();
            $price->setAttributes($service, false);

            $priceName = $price->getAttribute('name');
            $isParent = $price->getAttribute('parent_id') === null;

            // Чтобы определить тип, нужно название родительской услуги
            $type = $this->getTypeByName($this->getParentPriceName($price->getAttribute('parent_id') ?? $price->getAttribute('id')));
            $url = $this->slugger($priceName);

            $condition = [
                'and',
                ['=', 'name', $priceName],
                ['=', 'price_group_id', $price->getAttribute('parent_id')],
                ['IS NOT', 'parent_id', null],
            ];

            if ($isParent) {
                $condition = [
                    'and',
                    ['=', 'name', $priceName],
                    ['=', 'price_id', 0],
                    ['IS', 'parent_id', null],
                ];
            }

            // Могут быть одинаковые названия у услуг, относящиеся к разным категориям
            // Поэтому также нужно учитывать url
            $indepServiceEntity = IndependensServices::find()->where($condition)->one();

            // Запись может существовать, но не быть привязанной к pricelist
            if ($indepServiceEntity === null) {
                $indepServiceEntity = new IndependensServices();
                $indepServiceEntity->setAttribute('name', $priceName);
                $indepServiceEntity->setAttribute('type', $type);
                $indepServiceEntity->setAttribute('g_rate', $this->indepServiceRateGen()); // рейтинг
                $indepServiceEntity->setAttribute('g_feeds', $this->indepServiceFeedGen()); // кол-во отзывов
                $indepServiceEntity->setAttribute('header', $priceName . ' в Москве');
                $indepServiceEntity->setAttribute('title', $priceName . ' в Москве | Раннинг Моторс');
                $indepServiceEntity->setAttribute('update_at', $this->date);
                $indepServiceEntity->setAttribute('create_at', $this->date);
                $indepServiceEntity->setAttribute('price_id', $price->getAttribute('id'));
                $indepServiceEntity->setAttribute('price_group_id', $price->getAttribute('parent_id'));

                if ($this->checkServiceDublicateByUrl($url, IndependensServices::class)) {
                    // Если url содержит подчеркивания, то меняем их на тире/дефисы, и наоборот
                    if (str_contains($url, '_')) {
                        $url = Inflector::slug($priceName);
                    } else {
                        $url = Inflector::slug($priceName, '_');
                    }

                    if ($this->checkServiceDublicateByUrl($url, IndependensServices::class)) {
                        throw new Exception("Не удалось создать уникальный url для услуги \"{$priceName}\" (IndependensServices)");
                    }
                }

                $indepServiceEntity->setAttribute('url', $url);

                if ($isParent) {
                    $indepServiceEntity->setAttribute('price_id', 0);
                    $indepServiceEntity->setAttribute('price_group_id', $price->getAttribute('id'));
                } else {
                    $parentPriceName = $this->getParentPriceName($price->getAttribute('parent_id'));

                    $parentID = IndependensServices::findOne(['name' => $parentPriceName, 'parent_id' => null])?->getAttribute('id');

                    $indepServiceEntity->setAttribute('parent_id', $parentID);
                }

                $indepServiceEntity->save();
            }
        }

        printf("Добавление страниц-услуг у марок и моделей...\n");

        // Получение списка услуг, которые есть в прайс-листе, но отсутствуют в common_services
        $sql = 'SELECT pl.* FROM '
            . CommonServices::tableName()
            . ' AS srv RIGHT JOIN '
            . Pricelist::tableName()
            . ' AS pl ON pl.id = srv.price_id WHERE srv.id IS NULL ORDER BY pl.parent_id'
        ;

        $priceList = $this->db->createCommand($sql)->queryAll();

        foreach ($priceList as $service) {
            $price = new Pricelist();
            $price->setAttributes($service, false);

            $priceName = $price->getAttribute('name');
            $isParent = $price->getAttribute('parent_id') === null;

            // Чтобы определить тип, нужно название родительской услуги
            $type = $this->getTypeByName($this->getParentPriceName($price->getAttribute('parent_id') ?? $price->getAttribute('id')));
            $url = $this->slugger($priceName);

            $condition = [
                'and',
                ['=', 'name', $priceName],
                ['=', 'price_group_id', $price->getAttribute('parent_id')],
                ['IS NOT', 'parent_id', null],
            ];

            if ($isParent) {
                $condition = [
                    'and',
                    ['=', 'name', $priceName],
                    ['=', 'price_id', 0],
                    ['IS', 'parent_id', null],
                ];
            }

            $commonServiceEntity = CommonServices::find()->where($condition)->one();

            if ($commonServiceEntity === null) {
                $commonServiceEntity = new CommonServices();
                $commonServiceEntity->setAttribute('name', $priceName);
                $commonServiceEntity->setAttribute('type', $type);
                $commonServiceEntity->setAttribute('g_rate', $this->commonServiceRateGen());
                $commonServiceEntity->setAttribute('g_feeds', $this->commonServiceFeedGen());
                $commonServiceEntity->setAttribute('header', $priceName);
                $commonServiceEntity->setAttribute('title', $priceName . ' {BRAND} - цена в Москве | Раннинг Моторс');
                $commonServiceEntity->setAttribute('update_at', $this->date);
                $commonServiceEntity->setAttribute('create_at', $this->date);
                $commonServiceEntity->setAttribute('price_id', $price->getAttribute('id'));
                $commonServiceEntity->setAttribute('price_group_id', $price->getAttribute('parent_id'));

                if ($this->checkServiceDublicateByUrl($url, CommonServices::class)) {
                    // Если url содержит подчеркивания, то меняем их на тире/дефисы, и наоборот
                    if (str_contains($url, '_')) {
                        $url = Inflector::slug($priceName);
                    } else {
                        $url = Inflector::slug($priceName, '_');
                    }

                    if ($this->checkServiceDublicateByUrl($url, CommonServices::class)) {
                        throw new Exception("Не удалось создать уникальный url для услуги \"{$priceName}\" (CommonServices)");
                    }
                }

                $commonServiceEntity->setAttribute('url', $url);

                if ($isParent) {
                    $commonServiceEntity->setAttribute('price_id', 0);
                    $commonServiceEntity->setAttribute('price_group_id', $price->getAttribute('id'));
                } else {
                    $parentPriceName = $this->getParentPriceName($price->getAttribute('parent_id'));

                    $parentID = CommonServices::findOne(['name' => $parentPriceName, 'parent_id' => null])?->getAttribute('id');

                    $commonServiceEntity->setAttribute('parent_id', $parentID);
                }

                $commonServiceEntity->save();
            }
        }

        printf("Привязка новых услуг к фотографиям \"Примеры выполненных работ\"...\n");

        foreach ($this->serviceUrlList() as $row) {
            [$parentUrl, $url] = $row;

            $ourWorks = Ourworks::findOne(['url_page' => $url]);

            if ($ourWorks === null) {
                $images = $this->ourWorksImageGen($parentUrl);

                if (empty($images)) {
                    continue;
                }

                $ourWorks = new Ourworks();
                $ourWorks->setAttribute('url_page', $url);
                $ourWorks->setAttribute('images', implode('|', $images));
                $ourWorks->setAttribute('update_at', $this->date);
                $ourWorks->setAttribute('create_at', $this->date);
                $ourWorks->save();
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete(IndependensServices::tableName(), 'create_at = :date', [':date' => $this->date]);
        $this->delete(CommonServices::tableName(), 'create_at = :date', [':date' => $this->date]);
        $this->delete(Ourworks::tableName(), 'create_at = :date', [':date' => $this->date]);
    }

    private function slugger(string $serviceName)
    {
        return $this->slugs[$serviceName] ?? Inflector::slug($serviceName);
    }

    /**
     * Взято из \m211108_195306_add_type_field_to_indep_services_table::getTypeByName
     *
     * @param string $name
     * @return string|null
     */
    private function getTypeByName(string $name): ?string
    {
        $name = trim($name);
        $types = [
            'slesarny' => [
                'Техническое обслуживание (ТО) авто',
                'Ремонт трансмиссии',
                'Ремонт двигателя автомобиля',
                'Ремонт электрооборудования авто',
                'Ремонт рулевого управления',
                'Ремонт автокондиционеров',
                'Ремонт системы охлаждения',
                'Услуги по шиномонтажу',
                'Диагностика авто',
                'Ремонт АКПП',
                'Ремонт ходовой части (подвески)',
                'Ремонт тормозной системы',
                'Ремонт топливной системы',
                'Ремонт выхлопной системы',
                'Аргонная сварка авто',
            ],
            'kuzovnoy' => [
                'Кузовной ремонт авто',
                'Покраска авто'
            ],
            'detailing' => [
                'Мойка, химчистка, полировка'
            ],
            'zapchasty' => [
                'Запчасти'
            ]
        ];

        foreach ($types as $type => $names) {
            if (in_array($name, $names)) {
                return $type;
            }
        }

        return null;
    }

    private function getParentPriceName(int $id): string
    {
        static $cache = [];

        if (!isset($cache[$id])) {
            [$parentName] = $this
                ->db
                ->createCommand(
                    'SELECT name FROM ' . Pricelist::tableName() . ' WHERE id = :id',
                    [':id' => $id]
                )
                ->queryColumn()
            ;

            $cache[$id] = $parentName;
        }

        return $cache[$id];
    }

    private function indepServiceRateGen(): float
    {
        static $rateRange = [];

        if (empty($rateRange)) {
            [$minRate, $maxRate] = $this
                ->db
                ->createCommand('SELECT MIN(g_rate), MAX(g_rate) FROM ' . IndependensServices::tableName())
                ->queryOne(PDO::FETCH_NUM)
            ;

            $rateRange = range((float)$minRate, (float)$maxRate, 0.1);
        }

        $rate = $rateRange[array_rand($rateRange)];

        return round($rate, 1);
    }

    private function indepServiceFeedGen(): float
    {
        static $feedRange = [];

        if (empty($feedRange)) {
            [$minFeed, $maxFeed] = $this
                ->db
                ->createCommand('SELECT MIN(g_feeds), MAX(g_feeds) FROM ' . IndependensServices::tableName())
                ->queryOne(PDO::FETCH_NUM)
            ;

            $feedRange = range((int)$minFeed, (int)$maxFeed);
        }

        return $feedRange[array_rand($feedRange)];
    }

    private function commonServiceRateGen(): float
    {
        static $rateRange = [];

        if (empty($rateRange)) {
            [$minRate, $maxRate] = $this
                ->db
                ->createCommand('SELECT MIN(g_rate), MAX(g_rate) FROM ' . CommonServices::tableName())
                ->queryOne(PDO::FETCH_NUM)
            ;

            $rateRange = range((float)$minRate, (float)$maxRate, 0.1);
        }

        $rate = $rateRange[array_rand($rateRange)];

        return round($rate, 1);
    }

    private function commonServiceFeedGen(): float
    {
        static $feedRange = [];

        if (empty($feedRange)) {
            [$minFeed, $maxFeed] = $this
                ->db
                ->createCommand('SELECT MIN(g_feeds), MAX(g_feeds) FROM ' . CommonServices::tableName())
                ->queryOne(PDO::FETCH_NUM)
            ;

            $feedRange = range((int)$minFeed, (int)$maxFeed);
        }

        return $feedRange[array_rand($feedRange)];
    }

    private function checkServiceDublicateByUrl(string $url, string $serviceClassName): bool
    {
        /*
         * Раз могут быть услуги с одинаковым названием, но относящиеся к разным категориям, то могут буть дубли в url!
         * Для решения этой проблемы предыдущие авторы использовали разный разделитель в url, например
         *
         *      zamena_toplivnogo_filtra
         *      zamena-toplivnogo-filtra
         */

        return $serviceClassName::findOne(['url' => $url]) !== null;
    }

    private function ourWorksImageGen(string $parentServiceUrl): array
    {
        static $cache = [];

        $parentServiceUrl = trim($parentServiceUrl, '/');

        if (!isset($cache[$parentServiceUrl])) {
            $parentServiceUrl = $this->ourWorksAliases[$parentServiceUrl] ?? null;

            $imageDir = $this->ourWorksImageDir . $parentServiceUrl;

            $images = [];

            if ($parentServiceUrl !== null AND file_exists($imageDir)) {
                $iterator = new GlobIterator($imageDir . '/*.jpg', FilesystemIterator::SKIP_DOTS | FilesystemIterator::CURRENT_AS_PATHNAME);

                foreach ($iterator as $filename) {
                    $images[] = $filename;
                }
            }

            $cache[$parentServiceUrl] = $images;
        }

        $images = $cache[$parentServiceUrl];

        shuffle($images);

        $images = array_slice($images, 0, 8);

        return array_map(function ($filename) use ($parentServiceUrl) {
            // Оставляет относительный путь
            return strstr($filename, $parentServiceUrl);
        }, $images);
    }

    private function getBrandUrlList(): array
    {
        return $this
            ->db
            ->createCommand('SELECT id, url FROM ' . Brands::tableName() . ' WHERE status = 1')
            ->queryAll(PDO::FETCH_NUM)
        ;
    }

    private function getModelUrlList(int $brandID): array
    {
        return $this
            ->db
            ->createCommand(
                'SELECT url FROM ' . Models::tableName() . ' WHERE brand_id = :id AND status = 1',
                [':id' => $brandID]
            )
            ->queryAll(PDO::FETCH_NUM)
        ;
    }

    private function serviceUrlList(): Generator
    {
        $serviceUrlList = $this->db->createCommand(
            'SELECT isrv2.url AS parentUrl, isrv1.url FROM '
            . IndependensServices::tableName()
            . ' isrv1 JOIN '
            . IndependensServices::tableName()
            . ' isrv2 ON isrv2.id = isrv1.parent_id WHERE isrv1.create_at = :date'
            . ' UNION SELECT csrv2.url AS parentUrl, csrv1.url FROM '
            . CommonServices::tableName()
            . ' csrv1 JOIN '
            . CommonServices::tableName()
            . ' csrv2 ON csrv2.id = csrv1.parent_id WHERE csrv1.create_at = :date',
            [
                ':date' => $this->date
            ]
        )->queryAll(PDO::FETCH_NUM);

        foreach ($serviceUrlList as $service) {
            [$parentServiceUrl, $serviceUrl] = $service;

            //      /услуга/
            yield [$parentServiceUrl, "/{$serviceUrl}/"];

            foreach ($this->getBrandUrlList() as $brand) {
                [$brandID, $brandUrl] = $brand;

                //       /марка/услуга/
                yield [$parentServiceUrl, "/{$brandUrl}/{$serviceUrl}/"];

                foreach ($this->getModelUrlList($brandID) as $model) {
                    [$modelUrl] = $model;

                    //       /марка/модель/услуга/
                    yield [$parentServiceUrl, "/{$brandUrl}/{$modelUrl}/{$serviceUrl}/"];
                }
            }
        }
    }
}

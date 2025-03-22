<?php

use app\models\Brands;
use app\models\Models;
use yii\db\Migration;
use yii\helpers\Console;
use yii\helpers\Inflector;

/**
 * Class m231024_085317_migration_add_brands_models
 */
class m231024_085317_migration_add_brands_models extends Migration
{
    private string|bool $date;
    private array $brands;
    private array $models;

    public function init()
    {
        parent::init();

        $this->date = (new \DateTimeImmutable('2023-10-25'))->format('Y-m-d H:i:s');

        $this->brands = [
            ['Jac', 'Джак'],
            ['Iveco', 'Ивеко'],
            ['Baw', 'Бав'],
            ['Man', 'Ман'],
            ['Shacman', 'Шакман'],
            ['Isuzu', 'Исузу'],
            ['Daf', 'Даф'],
            ['Maz', 'Маз'],
            ['Tatra', 'Tatra'],
            ['Hino', 'Хино'],
            ['Nissan', 'Нисан'],
            ['Faw', 'Фав'],
            ['Mercedes', 'Мерседес'],
            ['Volvo', 'Вольво'],
            ['Hyundai', 'Хендай'],
            ['Sitrak', 'Ситрак'],
            ['Fuso', 'Фусо'],
            ['Renault', 'Рено'],
            ['Volkswagen', 'Фольксваген'],
            ['Foton', 'Фотон'],
            ['Peugeot', 'Пежо'],
            ['Tata', 'Тата'],
            ['Scania', 'Скания'],
            ['Sdac', 'Сдак'],
            ['Dongfeng', 'Донгфенг'],
            ['Fiat', 'Фиат'],
            ['Shaanxi', 'Шаанхи'],
            ['Ford', 'Форд'],
        ];

        $this->models = [
//            'BAIC' => [
//                ['U5 Plus', 'У5 Плюс'],
//                ['X35', 'Икс35'],
//                ['BJ40', 'Бджей40'],
//            ],
//            'Hongqi' => [
//                ['E-HS9', 'Е-ХС9'],
//                ['H5', 'Х5'],
//                ['HS5', 'ХС5'],
//            ],
//            'Jetta' => [
//                ['VA3', 'ВА3'],
//                ['VS5', 'ВС5'],
//                ['VS7', 'ВС7'],
//            ],
//            'Kaiyi' => [
//                ['E5', 'Е5'],
//                ['X3', 'Икс3', true],
//            ],
//            'Tank' => [
//                ['300', '300'],
//                ['500', '500'],
//            ],
//            'Voyah' => [
//                ['Dream', 'Дрим'],
//                ['Free', 'Фри'],
//            ],
//            'Zeekr' => [
//                ['1', '1', true],
//                ['9', '9'],
//                ['X', 'Х', true],
//            ],
//            'Nio' => [
//                ['ES6', 'Ес 6'],
//            ],
//            'BYD' => [
//                ['F3', 'Ф3'],
//                ['Han', 'Хан'],
//                ['Tang', 'Тэнг'],
//            ],
//            'HiPhi' => [
//                ['X', 'Х', true],
//                ['Y', 'Y'],
//                ['Z', 'Z'],
//            ],
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        printf("Добавление новых брендов и моделей...\n");
        $defaultBrand = Brands::findOne(['id' => 1]);
        foreach ($this->brands as $brandData) {
            [$brandName, $brandNameRU] = $brandData;

            $brandUrl = $this->slugger($brandName);

            $brand = Brands::findOne(['url' => $brandUrl]);

            printf("%s\n", $brandName);

            if ($brand === null) {
                $brand = new Brands();
                $brand->setAttribute('name', $brandName);
                $brand->setAttribute('rus_name', "({$brandNameRU})");
                $brand->setAttribute('url', $brandUrl);
                $brand->setAttribute('url_subdomain', '');
                $brand->setAttribute('header', "Ремонт {$brandName} ({$brandNameRU})");
                $brand->setAttribute('title', "Ремонт {$brandName} ({$brandNameRU}) - автосервис {$brandName}");
                $brand->setAttribute('description', str_replace($defaultBrand->rus_name, "({$brandNameRU})", str_replace($defaultBrand->name, $brandName, $defaultBrand->description)));
                $brand->setAttribute('keywords', str_replace(substr($defaultBrand->rus_name, 1, -1), $brandNameRU, str_replace($defaultBrand->name, $brandName, $defaultBrand->keywords)));
                $brand->setAttribute('order', $this->getLastBrandOrder());
                $brand->setAttribute('g_rate', $this->brandRateGen());
                $brand->setAttribute('g_feeds', $this->brandFeedGen());
                $brand->setAttribute('status', 1);
                $brand->setAttribute('update_at', $this->date);
                $brand->setAttribute('create_at', $this->date);
                $brand->save();
            }

            if(!isset($this->models[$brandName])){
                continue;
            }
            foreach ($this->models[$brandName] as $modelData) {
                [$modelName, $modelNameRU, $notUnique] = $modelData + [2 => false];

                $modelUrl = $this->slugger($modelName);

                if ($notUnique) {
                    $modelUrl = $this->slugger($brandName . ' ' . $modelName);
                }

                $model = Models::findOne(['url' => $modelUrl]);

                if ($model === null) {
                    printf("   %s\n", $modelName);

                    $model = new Models();
                    $model->setAttribute('brand_id', $brand->getPrimaryKey());
                    $model->setAttribute('name', $modelName);
                    $model->setAttribute('rus_name', "({$brandNameRU} {$modelNameRU})");
                    $model->setAttribute('url', $modelUrl);
                    $model->setAttribute('header', "Ремонт {$brandName} {$modelName} ({$brandNameRU} {$modelNameRU})");
                    $model->setAttribute('title', "Ремонт {$brandName} {$modelName} ({$brandNameRU} {$modelNameRU}) - автосервис {$brandName}");
                    $model->setAttribute('g_rate', $this->modelRateGen());
                    $model->setAttribute('g_feeds', $this->modelFeedGen());
                    $model->setAttribute('status', 1);
                    $model->setAttribute('update_at', $this->date);
                    $model->setAttribute('create_at', $this->date);
                    $model->save();
                } else {
                    $this->warning("   {$modelName} не добавлен");
                }
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete(Brands::tableName(), 'create_at = :date', [':date' => $this->date]);
        $this->delete(Models::tableName(), 'create_at = :date', [':date' => $this->date]);
    }

    private function slugger(string $value): string
    {
        return Inflector::slug($value);
    }

    private function brandRateGen(): float
    {
        static $rateRange = [];

        if (empty($rateRange)) {
            [$minRate, $maxRate] = $this
                ->db
                ->createCommand('SELECT MIN(g_rate), MAX(g_rate) FROM ' . Brands::tableName())
                ->queryOne(PDO::FETCH_NUM)
            ;

            $rateRange = range((float)$minRate, (float)$maxRate, 0.1);
        }

        $rate = $rateRange[array_rand($rateRange)];

        return round($rate, 1);
    }

    private function brandFeedGen(): float
    {
        static $feedRange = [];

        if (empty($feedRange)) {
            [$minFeed, $maxFeed] = $this
                ->db
                ->createCommand('SELECT MIN(g_feeds), MAX(g_feeds) FROM ' . Brands::tableName())
                ->queryOne(PDO::FETCH_NUM)
            ;

            $feedRange = range((int)$minFeed, (int)$maxFeed);
        }

        return $feedRange[array_rand($feedRange)];
    }

    private function getLastBrandOrder(): int
    {
        static $orderN;

        if ($orderN === null) {
            $orderN = (int)$this
                ->db
                ->createCommand('SELECT MAX(`order`) FROM ' . Brands::tableName())
                ->queryScalar()
            ;
        }

        return ++$orderN;
    }

    private function modelRateGen(): float
    {
        static $rateRange = [];

        if (empty($rateRange)) {
            [$minRate, $maxRate] = $this
                ->db
                ->createCommand('SELECT MIN(g_rate), MAX(g_rate) FROM ' . Models::tableName())
                ->queryOne(PDO::FETCH_NUM)
            ;

            $rateRange = range((float)$minRate, (float)$maxRate, 0.1);
        }

        $rate = $rateRange[array_rand($rateRange)];

        return round($rate, 1);
    }

    private function modelFeedGen(): float
    {
        static $feedRange = [];

        if (empty($feedRange)) {
            [$minFeed, $maxFeed] = $this
                ->db
                ->createCommand('SELECT MIN(g_feeds), MAX(g_feeds) FROM ' . Models::tableName())
                ->queryOne(PDO::FETCH_NUM)
            ;

            $feedRange = range((int)$minFeed, (int)$maxFeed);
        }

        return $feedRange[array_rand($feedRange)];
    }

    private function warning(string $message)
    {
        echo Console::ansiFormat($message, [Console::BG_YELLOW]) . "\n";
    }
}

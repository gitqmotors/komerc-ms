<?php

use yii\db\Migration;
use yii\helpers\Inflector;

class m250320_210513_refactor_services extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $services = [
            "Техническое обслуживание" => [ // +++
                "Замена масла в двигателе" => "2 466",
                "Замена масла в коробке" => "2 055",
                "Замена масла редуктора моста" => "2 466",
                "Замена антифриза" => "2 466",
                "Замена топливного фильтра" => "658",
                "Смазка авто по хим карте" => "2 795"
            ],
            "Ремонт двигателя" => [  // +++
                "Клапана регулировка" => "12 330",
                "Насос масляный" => "30 907",
                "Сальник коленвала передний" => "12 330",
                "Вал распределительный" => "32 880",
                "Картер масляный" => "6 247",
                "ДВС кап ремонт" => "124 944",
                "Опора двигателя" => "3 124",
                "ГБЦ ремонт" => "32 880",
                "Цепи ГРМ - замена комплекта" => "42 744",
                "Вал коленчатый ремонт" => "32 880",
                "Вал коленчатый полировка" => "19 070"
            ],
            "Диагностика" => [ // +++
                "АКБ диагностика" => "658",
                "Компьютерная диагностика" => "4 110",
                "Система охлаждения - диагностика" => "1 644",
                "Трансмиссия диагностика" => "5 261",
                "АБС диагностика" => "4 110",
                "Воздушная система - диагностика" => "1 973",
                "Давление масла ГУР - проверка" => "7 234",
                "Электрооборудование диагностика" => "10 522",
                "Ходовая часть а/м - диагностика" => "4 603",
                "Редуктор моста диагностика" => "4 932"
            ],
            "Ремонт ходовой (подвески)" => [ // +++ ???
                "Амортизатор передний" => "2 055",
                "Рессора задняя" => "11 179",
                "Палец рессоры" => "3 124",
                "Стремянка рессоры - замена" => "2 055"
            ],
            "Ремонт трансмиссии" => [ // +++
                "Вал карданный" => "2 466",
                "КПП" => "23 016",
                "КПП ремонт" => "41 100",
                "Крестовина карданного вала (кард. вал снят)" => "4 521",
                "ПГУ" => "7 234",
                "Редуктор моста" => "12 330",
                "Редуктор моста ремонт" => "35 017",
                "Ступица передняя" => "4 603",
                "Кулиса КПП" => "4 932",
                "Редуктор ЗМ - диагностика с разборкой" => "10 275"
            ],
            "Ремонт системы охлаждения" => [ // +++
                "Датчик уровня О/Ж" => "658",
                "Муфта вентилятора радиатора" => "7 398",
                "Насос водяной" => "10 275",
                "Радиатор" => "12 659",
                "Термостат" => "2 466",
                "Бачок расширительный" => "1 644",
                "Патрубок системы охлаждения" => "1 644",
                "Подушка крепления радиатора" => "411",
                "Радиатор отопителя салона" => "13 152",
                "Система охлаждения - промывка" => "6 576",
                "Теплообменник" => "16 440",
                "Кронштейн крепления топливного бака" => "4 110"
            ],
            "Ремонт впускной системы" => [ // ---
                "Снятие интеркуллера" => "2 466",
                "Обслуживание впускного коллетора" => "7 891",
                "Снятие воздушного фильтра" => "592",
                "Обслуживание бака мочевины" => "9 864"
            ],
            "Ремонт выпускной системы" => [ // ---
                "Обслуживание сажевого фильтра" => "3 946",
                "Ремонт глушителя" => "3 288",
                "Ремонт Турбокомпрессора" => "3 946",
                "Ремонт горного тормоза" => "7 234",
                "Ремонт клапана горного тормоза" => "1 644",
                "Клапан ЕГР" => "3 288"
            ],
            "Ремонт рулевого управления" => [ // +++
                "Колонка рулевая" => "7 234",
                "Насос ГУР" => "6 576",
                "Схождение - регулировка" => "4 274",
                "Тяга рулевая продольняя" => "2 877",
                "Шкворень - замена(1 сторона)" => "12 330",
                "Бачок ГУР" => "3 124",
                "Кулак поворотный" => "13 810",
                "Рулевое колесо" => "1 973"
            ],
            "Ремонт кабины" => [ // ---
                "Зеркало заднего вида" => "1 644",
                "Ящик инструментальный - установка" => "8 220",
                "Форсунка стеклоомывателя - замена" => "658",
                "Фильтр отопителя салона" => "986",
                "Фиксатор двери" => "2 302",
                "Бампер" => "4 603",
                "Замок двери кабины - замена" => "5 918",
                "Концевик двери" => "658",
                "Кронштейн запасного колеса" => "4 932",
                "Петля двери" => "2 302",
                "Поводок стеклоочистителя" => "986",
                "Сиденье водительское" => "2 959",
                "Стекло заднее" => "2 466",
                "Стекло кабины боковое замена" => "4 110",
                "Стекло лобовое" => "12 330",
                "Трапеция стеклоочистителя" => "5 261",
                "Шноркель замена" => "3 124"
            ],
            "Ремонт тормозной системы" => [ // +++
                "Колодки тормозные передняя ось" => "6 165",
                "Компрессор воздушный" => "2 137",
                "Суппорт тормозной- обслуживание" => "2 137",
                "Суппорт тормозной" => "4 603",
                "Энергоаккумулятор тормозной" => "6 247",
                "Камера тормозная" => "3 699",
                "Диск тормозной передний" => "6 165",
                "Гидроблок ABS - ремонт" => "47 676",
                "Цилиндр тормозной главный" => "10 522",
                "Трубка тормозная" => "2 466",
                "Трубка пневмосистемы" => "2 055"
            ],
            "Ремонт топливной системы" => [ // +++
                "Бак топливный" => "6 576",
                "ТНВД" => "13 152",
                "Форсунка топливная" => "2 055",
                "Датчик уровня топлива" => "3 946",
                "Клапан аварийного давления топлива" => "2 055",
                "Корпус ФГОТ" => "2 877",
                "Рампа топливная" => "7 891",
                "ТНВД - ремонт" => "16 440",
                "Форсунка - параметрирование" => "2 466"
            ]
        ];

//        $services = [
//            "Техническое обслуживание" => 'slesarny',
//            "Ремонт двигателя" => 'slesarny',
//            "Диагностика" => 'slesarny',
//            "Ремонт ходовой (подвески)" => 'slesarny',
//            "Ремонт трансмиссии" => 'slesarny',
//            "Ремонт системы охлаждения" => 'slesarny',
//            "Ремонт впускной системы" => 'slesarny',
//            "Ремонт выпускной системы" => 'slesarny',
//            "Ремонт рулевого управления" => 'slesarny',
//            "Ремонт кабины" => 'slesarny',
//            "Ремонт тормозной системы" => 'slesarny',
//            "Ремонт топливной системы" => 'slesarny'
//        ];
//        $slug = new Slugify();
        echo Inflector::slug('инструменты');
//        exit();

        $servicesDB = \app\models\Pricelist::findAll(['parent_id' => null]);
//        echo count($servicesDB) . PHP_EOL;

        foreach ($services as $key => $serv) {
            $flagFound = false;
            foreach ($servicesDB as $keyDB => $servDB) {
                if (strpos($key, $servDB->name) !== false) {
                    echo 'FOUND GROUP -> ' . $servDB->name . ' |-> ' . $key . PHP_EOL;
                    $servDB->hidden = 0;
                    $servDB->save();
                    $flagFound = true;

                    $indepGroup = \app\models\IndependensServices::findOne(['price_group_id' => $servDB->id]);
                    if($indepGroup){
                        $indepGroup->hidden = 0;
                        $indepGroup->save();
                    }

                    foreach ($serv as $serKey => $serValue) {
                        $newServiceGroup = new \app\models\Pricelist();
                        $newServiceGroup->parent_id = $servDB->id;
                        $newServiceGroup->name = $serKey;
                        $newServiceGroup->price = $serValue;
                        $newServiceGroup->level = 2;
                        $newServiceGroup->status = 1;
                        $newServiceGroup->order = 1;
                        $newServiceGroup->hidden = 0;
                        $newServiceGroup->save();
                        echo ' - - - - - ADD SERVICE -> ' . $serKey . PHP_EOL;

                        $newIndepServ = new \app\models\IndependensServices();
                        $newIndepServ->name = $serKey;
                        $newIndepServ->parent_id = $indepGroup->id;
                        $newIndepServ->url = str_replace(' ', '-', Inflector::slug($serKey));
                        $newIndepServ->header = "{$serKey} в Москве";
                        $newIndepServ->title = "{$serKey} в Москве";
                        $newIndepServ->description = "Выполняем {$serKey} в Москве";
                        $newIndepServ->price_id = $newServiceGroup->id;
                        $newIndepServ->price_group_id = $servDB->id;
                        $newIndepServ->order = 500;
                        $newIndepServ->g_rate = 4.8;
                        $newIndepServ->g_feeds = 17;
                        $newIndepServ->type = 'slesarny';
                        $newIndepServ->hidden = 0;
                        $newIndepServ->save();
                    }

                    break;
                }
            }
            if(!$flagFound){
                echo 'NOT FOUND GROUP -> ' .$key . PHP_EOL;
                $newServiceGroup = new \app\models\Pricelist();
                $newServiceGroup->name  = $key;
                $newServiceGroup->price = 0;
                $newServiceGroup->level = 1;
                $newServiceGroup->status = 1;
                $newServiceGroup->order = 1;
                $newServiceGroup->hidden = 0;
                $newServiceGroup->save();
                echo ' - - - ADD GROUP -> ' . $key . PHP_EOL;

                $newIndepGroup = new \app\models\IndependensServices();
                $newIndepGroup->name = $key;
                $newIndepGroup->url = str_replace(' ', '-', Inflector::slug($key));
                $newIndepGroup->header = "{$key} в Москве";
                $newIndepGroup->title = "{$key} в Москве";
                $newIndepGroup->description = "Выполняем {$key} в Москве";
                $newIndepGroup->price_id = 0; //$newServiceGroup->id;
                $newIndepGroup->price_group_id = $newServiceGroup->id;
                $newIndepGroup->order = 500;
                $newIndepGroup->g_rate = 4.8;
                $newIndepGroup->g_feeds = 17;
                $newIndepGroup->type = 'slesarny';
                $newIndepGroup->hidden = 0;
                $newIndepGroup->save();
                echo ' - - - ADD GROUP INDEP -> ' . $key . PHP_EOL;

                foreach ($serv as $itemKey => $itemValue){
                    $newService = new \app\models\Pricelist();
                    $newService->parent_id = $newServiceGroup->id;
                    $newService->name = $itemKey;
                    $newService->price = $itemValue;
                    $newService->level = 2;
                    $newService->status = 1;
                    $newService->order = 1;
                    $newService->hidden = 0;
                    $newService->save();
                    echo ' - - - - - ADD SERVICE -> ' . $itemKey . PHP_EOL;

                    $newIndepServ = new \app\models\IndependensServices();
                    $newIndepServ->name = $itemKey;
                    $newIndepServ->parent_id = $newIndepGroup->id;
                    $newIndepServ->url = str_replace(' ', '-', Inflector::slug($itemKey));
                    $newIndepServ->header = "{$itemKey} в Москве";
                    $newIndepServ->title = "{$itemKey} в Москве";
                    $newIndepServ->description = "Выполняем {$itemKey} в Москве";
                    $newIndepServ->price_id = $newService->id;
                    $newIndepServ->price_group_id = $newServiceGroup->id;
                    $newIndepServ->order = 500;
                    $newIndepServ->g_rate = 4.8;
                    $newIndepServ->g_feeds = 17;
                    $newIndepServ->type = 'slesarny';
                    $newIndepServ->hidden = 0;
                    $newIndepServ->save();
                    echo ' - - - - - ADD SERVICE INDEP -> ' . $itemKey . PHP_EOL;
                }
//                echo $newServiceGroup->id . PHP_EOL;
            }
            echo PHP_EOL;
        }
//        exit();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m250320_210513_refactorServices cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250320_210513_refactorServices cannot be reverted.\n";

        return false;
    }
    */
}

<?php

use app\models\Brands;
use app\models\Models;
use yii\db\Migration;
use yii\helpers\Console;

/**
 * Управление видимостью услуг в моделях
 */
class m240611_122344_visibility_service_models extends Migration
{
    public const HIDE_SERVICE = 1;
    public const SHOW_SERVICE = 0;

    private array $cars;
    public function init()
    {
        parent::init();

        $this->cars = [
            // brand url
            'audi' => [
                // Названия как в базе
                'A3',
                'A4',
                'A5',
                'A6',
                'A6 Allroad',
                'A7',
                'A8',
                'Q3',
                'Q5',
                'Q7',
                'Q8',
                'TT',
            ],
            'skoda' => [
                'Fabia',
                'Karoq',
                'Kodiaq',
                'Octavia',
                'Rapid',
                'Superb',
                'Yeti',
            ],
            'Kia' => [
                'Carnival',
                'Cee\'d',
                'Cerato',
                'K3',
                'K5',
                'Mohave',
                'Optima',
                'Rio',
                'Seltos',
                'Sorento',
                'Soul',
                'Spectra',
                'Sportage',
                'Stinger',
            ],
            'Hyundai' => [
                'Accent',
                'Creta',
                'Elantra',
                'Getz',
                'Grand Starex',
                'H-1',
                'i30',
                'i40',
                'ix35',
                'Palisade',
                'Santa Fe',
                'Solaris',
                'Sonata',
                'Staria',
                'Tucson'
            ],
            'chevrolet' => [
                'Aveo',
                'Camaro',
                'Captiva',
                'Cobalt',
                'Cruze',
                'Lacetti',
                'Lanos',
                'Niva',
                'Spark',
                'Tahoe',
                'Trailblazer',
            ],
            'Land_Rover' => [
                'Defender',
                'Discovery',
                'Discovery Sport',
                'Freelander',
                'Range Rover',
                'Range Rover Evoque',
                'Range Rover Sport',
                'Range Rover Velar',
            ],
            'Mitsubichi' => [
                'ASX',
                'Eclipse',
                'Galant',
                'L 200',
                'Lancer',
                'Montero Sport',
                'Outlander',
                'Pajero',
                'Pajero Sport',
                'Xpander',
            ],
            'Nissan' => [
                'Almera',
                'Almera Classic',
                'Juke',
                'Leaf',
                'Murano',
                'Note',
                'Pathfinder I',
                'Patrol',
                'Primera',
                'Qashqai',
                'Serena',
                'Teana',
                'Terrano',
                'Tiida',
                'X-Trail',
            ],
            'lexus' => [
                'ES',
                'GS',
                'GX',
                'IS',
                'LS',
                'LX',
                'NX',
                'RX',
            ],
            'toyota' => [
                'Alphard',
                'Auris',
                'Avensis',
                'CH-R',
                'Camry',
                'Corolla',
                'Fortuner',
                'Highlander',
                'Hilux',
                'Land Cruiser',
                'Land Cruiser Prado',
                'Mark II',
                'Prius',
                'Rav 4',
                'Tundra',
                'Sienna',
            ],
            'Infiniti' => [
                'EX',
                'FX',
                'G',
                'M',
                'Q50',
                'QX50',
                'QX56',
                'QX60',
                'QX70',
                'QX80',
            ],
            'Honda' => [
                'Accord',
                'Civic',
                'CR-V',
                'Fit',
                'Stepwgn',
                'Freed',
                'Pilot',
            ],
            'Mazda' => [
                '3',
                '6',
                'CX-4',
                'CX-5',
                'CX-7',
                'CX-9',
                'MPV',
            ],
            'Jeep' => [
                'Cherokee',
                'Grand Cherokee',
                'Wrangler',
            ],
            'Volvo' => [
                'C30',
                'S40',
                'S 60',
                'S 80',
                'S90',
                'V40 Cross Country',
                'V90 Cross Country',
                'XC60',
                'XC 70',
                'XC 90',
            ],
            'opel' => [
                'Antara',
                'Astra',
                'Corsa',
                'Insignia',
                'Meriva',
                'Mokka',
                'Omega',
                'Vectra',
                'Zafira',
            ],
            'Jaguar' => [
                'E-Pace',
                'F-Pace',
                'F-Type',
                'X-Type',
                'XE',
            ],
            'porsche' => [
                '911',
                'Cayenne',
                'Cayman',
                'Macan',
                'Panamera',
            ],
            'Acura' => [
                'MDX',
                'RDX',
            ],
            'Peugeot' => [
                '206',
                '207',
                '3008',
                '307',
                '308',
                '407',
                '408',
                'Partner',
            ],
            'Renault' => [
                'Arkana',
                'Duster',
                'Fluence',
                'Kangoo',
                'Kaptur',
                'Koleos',
                'Laguna',
                'Logan',
                'Megane',
                'Sandero',
                'Scenic',
            ],
            'Citroen' => [
                'Berlingo',
                'C4',
                'C4 Picasso',
                'C5',
                'C5 Aircross',
                'SpaceTourer',
            ],
            'Subary' => [
                'Forester',
                'Impreza',
                'Legacy',
                'Outback',
                'Tribeca',
            ],
            'Suzuki' => [
                'Baleno',
                'Grand Vitara',
                'Jimny',
                'SX 4',
                'Vitara',
            ],
            'SsangYong' => [
                'Actyon',
                'Kyron',
                'Rexton',
            ],
            'Seat' => [
                'Altea',
                'Ibiza',
                'Leon',
            ],
            'Saab' => [
                '9-3',
                '9-5',
            ],
            'Mini' => [
                'Clubman',
                'Countryman',
                'Hatch',
            ],
            'Fiat' => [
                '500',
                'Albea',
                'Doblo',
                'Punto',
            ],
            'Isuzu' => [
                'D-Max',
                'Trooper',
            ],
            'Genesis_auto' => [
                'G70',
                'G80',
                'G90',
                'GV70',
                'GV80',
            ],
            'Great_Wall' => [
                'Hover H3',
                'Hover H5',
                'Wingle 7',
            ],
            'Rolls_Royce' => [
                'Cullinan',
                'Ghost',
                'Phantom',
                'Wraith',
            ],
            'Lamborghini' => [
                'Aventador',
                'Huracan',
                'Urus',
            ],
            'Maserati' => [
                'Ghibli',
                'GranTurismo',
                'Levante',
                'Quattroporte',
            ],
            'Maybach' => [
                '62',
            ],
            'Ferrari' => [
                '812 Superfast',
                'California',
                'F8',
                'Roma',
            ],
            'Datsun' => [
                'mi-DO',
                'on-DO',
            ],
            'Bentley' => [
                'Bentayga',
                'Continental GT',
                'Flying Spur',
            ],
            'aston_martin' => [
                'DB9',
            ],
            'Alfa_Romeo' => [
                '147',
                '156',
                '159',
            ],
            'Dodge' => [
                'Caravan',
                'Challenger',
                'Caliber',
                'Charger',
                'Intrepid',
                'RAM',
                'Stratus',
            ],
            'Crysler' => [
                '300 C',
                'Pacifica',
                'PT Cruiser',
                'Sebring',
                'Town & Country',
                'Voyager',
            ],
            'Cadillac' => [
                'CTS',
                'Escalade',
                'SRX',
                'XT5',
            ],
            'Brilliance' => [
                'V5',
            ],
            'Chery' => [
                'T11',
                'Tiggo 4',
                'Tiggo 4 Pro',
                'Tiggo 7 Pro',
                'Tiggo 7 Pro Max',
                'Tiggo 8',
                'Tiggo 8 Pro',
                'Tiggo 8 Pro Max',
            ],
            'Changan' => [
                'CS35 PLUS',
                'CS75',
                'CS55Plus',
                'CS85',
                'UNI-K',
                'UNI-V',
            ],
            'FAW' => [
                'Besturn T77',
                'Besturn X40',
                'Besturn X80',
            ],
            'Dongfeng' => [
                '580',
                'DF6',
            ],
            'Geely' => [
                'Atlas',
                'Atlas Pro',
                'Coolray',
                'Monjaro',
                'Tugella',
            ],
            'Lifan' => [
                'Breez (520)',
                'Smily',
                'Solano',
                'X60',
            ],
            'JAC' => [
                'J7',
                'JS4',
                'JS6',
            ],
            'havai' => [
                'Dargo',
                'F7',
                'F7x',
                'H9',
                'Jolion',
            ],
            'Lada' => [
                '1111 Ока',
                '2101',
                '2104',
                '2105',
                '2106',
                '2107',
                '2108',
                '2109',
                '21099',
                '2110',
                '2111',
                '2112',
                '2113',
                '2114',
                '2115',
                '2121 (4x4)',
                '2131 (4x4)',
                'Granta',
                'Kalina',
                'Largus',
                'Niva',
                'Priora',
                'Vesta',
                'Xray',
            ],
            'ford' => [
                'C-max',
                'Escape',
                'Explorer',
                'Fiesta',
                'Focus i',
                'Fusion',
                'Galaxy',
                'Kuga',
                'Mondeo',
                'Mustang',
            ],
            'omoda' => [
                'C5',
                'S5',
            ],
            'baic' => [
                'U5 Plus',
                'X35',
                'BJ40',
            ],
            'hongqi' => [
                'E-HS9',
                'H5',
                'HS5',
            ],
            'jetta' => [
                'VA3',
                'VS5',
                'VS7',
            ],
            'kaiyi' => [
                'E5',
                'X3',
            ],
            'tank' => [
                '300',
                '500',
            ],
            'voyah' => [
                'Dream',
                'Free',
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        foreach ($this->cars as $carBrand => $carModels) {
            $brand = Brands::findOne(['url' => $carBrand]);

            if ($brand === null) {
                $this->warning("Марка $carBrand не найдена!\n");

                continue;
            }

            foreach ($carModels as $carModel) {
                $model = Models::findOne(['name' => $carModel, 'brand_id' => $brand->id]);

                if ($model === null) {
                    $this->warning("Модель {$brand->name} $carModel не найдена!\n");

                    continue;
                }

                $model->setAttribute('hide_url_price_list', self::SHOW_SERVICE);
                $model->setAttribute('status', 1);
                $model->save();
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {}

    private function warning(string $message): void
    {
        echo Console::ansiFormat($message, [Console::BG_YELLOW]) . "\n";
    }
}

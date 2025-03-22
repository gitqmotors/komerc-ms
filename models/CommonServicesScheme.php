<?php

namespace app\models;

use app\models\AppActiveRecord;
use app\traits\DSGServiceDetection;
use app\traits\HiddenServices;
use app\traits\ServiceCleanNaming;

class CommonServicesScheme extends AppActiveRecord
{
    use ServiceCleanNaming;
    use DSGServiceDetection;
    use HiddenServices;
    
    public static function tableName() {
        return 'common_services_scheme';
    }
    
    public function setSeoData($brand, $model = null) 
    {
        if (is_null($model)) {
            $brandName = ' ' . $brand->name . ' ' . $brand->rus_name . '';            
        } else {
            $brandName = ' ' . $brand->name . ' ' . $model->name . ' ' . $model->rus_name . ''; 
        }
        
        $this->header .= $brandName;
        $this->text = str_replace('{BRAND}', $brandName, $this->text);
            
        switch ($this->type) {
            case 'slesarny':
                $this->title = $this->header . ' цена в Москве | Раннинг Моторс' /*. ' - автосервис ' . $brand->name*/;
                $this->description = '⭐⭐⭐⭐⭐ ' . $this->header . ' по доступным ценам в Москве. ✅ Бесплатная диагностика. ✅ Бесплатный эвакуатор. ✅ Гарантия 2 года. 🚀 ' . $this->header . ' узнать цены и ⏰ записаться в автосервис ' . $brand->name . ' «Раннинг Моторс» ☎️ +7(495)477-33-96.';
                break;
            case 'kuzovnoy':
                $this->title = $this->header . ' цена в Москве | Раннинг Моторс' /*. ' - автосервис ' . $brand->name*/;
                $this->description = '⭐⭐⭐⭐⭐ ' . $this->header . ' по доступным ценам в Москве. ✅ Бесплатный подбор краски. ✅ Бесплатный эвакуатор. ✅ Пожизненная гарантия. 🚀 ' . $this->header . ' узнать цены и ⏰ записаться в автосервис ' . $brand->name . ' «Раннинг Моторс» ☎️ +7(495)477-33-96.';
                break;
            case 'detailing':
                $this->title = $this->header . ' цена в Москве | Детейлинг студия';
                $this->description = '⭐⭐⭐⭐⭐ ' . $this->header . ' по доступным ценам в Москве. ✅ Студия европейского уровня. ✅ Вернем вид нового автомобиля! ✅ Гарантия качества. 🚀 ' . $this->header . ' узнать цены и ⏰ записаться в детейлинг студию «Раннинг Моторс» ☎️ +7(499)444-14-37.';
                break;
            default:
                $this->title = str_replace('{BRAND}', $brandName, $this->title) . ' цена в Москве | Раннинг Моторс';
                $this->description = str_replace('{BRAND}', $brandName, $this->description); 
        }
    //  . ' - цена в Москве | Раннинг Моторс'
    }
    
}

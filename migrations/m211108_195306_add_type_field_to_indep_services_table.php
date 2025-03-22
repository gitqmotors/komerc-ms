<?php

use yii\db\Migration;
use app\models\IndependensServices;

/**
 * Class m211108_195306_add_type_field_to_indep_services_table
 */
class m211108_195306_add_type_field_to_indep_services_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%indep_services}}', 'type', $this->string(255)->after("g_feeds"));
        
        $superParents = IndependensServices::find()->where(['parent_id' => null])->all();
        foreach ($superParents as $superParent) {
            $type = $this->getTypeByName(trim($superParent->name));
            $superParent->type = $type;
            $superParent->save();
            
            $parents = IndependensServices::find()->where(['parent_id' => $superParent->id])->all();
            foreach($parents as $parent) {
                $parent->type = $type;
                $parent->save();
                
                $children = IndependensServices::find()->where(['parent_id' => $parent->id])->all();
                foreach($children as $child) {
                    $child->type = $type;
                    $child->save();                            
                }                
            }            
        } 
    }
    
    protected function getTypeByName($name) 
    {
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
        
        foreach($types as $type => $names) {
            if(in_array($name, $names)) {
                return $type;
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m211108_195306_add_type_field_to_indep_services_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211108_195306_add_type_field_to_indep_services_table cannot be reverted.\n";

        return false;
    }
    */
}

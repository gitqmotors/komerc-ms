<?php

/* 
 * 27.11.2020
 * File: m201127_082329_create_common_services_table.php
 * Encoding: UTF-8
 * Project: RMS special for Quality Motors team
 * 
 * Author: Gafuroff Alexandr 
 * E-mail: gafuroff.al@yandex.ru
 */

use yii\db\Migration;
use app\models\CommonServices;

/**
 * Handles the creation of table `{{%services}}`.
 */
class m201127_082329_create_common_services_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%common_services}}', [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer(),
            'name' => $this->string(150)->notNull(),
            'url' => $this->string(150)->notNull(),
            'header' => $this->string(190),
            'title' => $this->string(190),
            'description' => $this->string(420),
            'keywords' => $this->string(400),
            'price_id' => $this->integer()->defaultValue(0),
            'price_group_id' => $this->integer()->defaultValue(0),
            'text' => $this->text(),
            'order' => $this->integer(3)->defaultValue(0),
            'update_at' => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'create_at' => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP',
            'old_id' => $this->integer(11),
            'parent_old_id' => $this->integer(11)
        ]);
        
        // creates index for column `parent_id`
        $this->createIndex(
            '{{%idx-common_services-parent_id}}',
            '{{%common_services}}',
            'parent_id'
        );

        // add foreign key for table `{{%services}}`
        $this->addForeignKey(
            '{{%fk-common_services-parent_id}}',
            '{{%common_services}}',
            'parent_id',
            '{{%common_services}}',
            'id',
            'CASCADE'
        );
        
        // creates index for column `url`
        $this->createIndex(
            '{{%idx-common_services-url}}',
            '{{%common_services}}',
            'url'
        );
        
        $servicesData = include(__DIR__ . '/data/data_m201127_063933.php');
        
        foreach($servicesData as $key => $data) {
            if($data['url'] != '') {
                $this->insert('{{%common_services}}', [
                    'name' => $data['name'],
                    'header' => $data['name'],
                    'url' => $data['url'],
                    'title' => $data['title'] != '' ? str_replace('{CAR}', '{BRAND}', $data['title']) : $data['name'] . ' {BRAND} - Москва | Раннинг Моторс',
                    'description' => $data['description'] != '' ? str_replace('{CAR}', '{BRAND}', $data['description']) : $data['name'] . ' {BRAND} - Москва | Раннинг Моторс - ремонт автомобилей с гарантией',
                    'keywords' => str_replace('{CAR}', '{BRAND}', $data['keywords']),
                    'text' => str_replace('{CAR}', '{BRAND}', $data['text']),
                    'order' => $data['order'],
                    'old_id' => $data['old_id'],
                    'parent_old_id' => $data['parent_old_id']
                ]);
            }        
        }
        
        $independences = CommonServices::find()->where(['!=', 'parent_old_id', '0'])->all();
        foreach($independences as $services) {
            $parent = CommonServices::find()->where(['old_id' => $services->parent_old_id])->one();
            $this->update('{{%common_services}}', ['parent_id' => $parent->id], ['id' => $services->id]);
        }        
        
        $this->addColumn('{{%common_services}}', 'type', $this->string(255)->after("order"));
        
        $superParents = CommonServices::find()->where(['parent_id' => null])->all();
        
        foreach ($superParents as $superParent) {
            $type = $this->getTypeByName(trim($superParent->name));
            $superParent->type = $type;
            $superParent->save();
            
            $parents = CommonServices::find()->where(['parent_id' => $superParent->id])->all();
            foreach($parents as $parent) {
                $parent->type = $type;
                $parent->save();
                
                $children = CommonServices::find()->where(['parent_id' => $parent->id])->all();
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
        // drops foreign key for table `{{%services}}`
        $this->dropForeignKey(
            '{{%fk-common_services-parent_id}}',
            '{{%common_services}}'
        );

        // drops index for column `parent_id`
        $this->dropIndex(
            '{{%idx-common_services-parent_id}}',
            '{{%common_services}}'
        );
        
        // drops index for column `url`
        $this->dropIndex(
            '{{%idx-common_services-url}}',
            '{{%common_services}}'
        );
        
        $this->dropTable('{{%common_services}}');
    }
}

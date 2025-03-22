<?php

/* 
 * 24.11.2020
 * File: m201124_121457_create_brands_table.php
 * Encoding: UTF-8
 * Project: RMS special for Quality Motors team
 * 
 * Author: Gafuroff Alexandr 
 * E-mail: gafuroff.al@yandex.ru
 */

use yii\db\Migration;

/**
 * Handles the creation of table `{{%brands}}`.
 */
class m201124_121457_create_brands_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%brands}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100)->notNull(),
            'rus_name' => $this->string(100)->notNull(),
            'url' => $this->string(100)->notNull(),
            'header' => $this->string(180),
            'title' => $this->string(180),
            'description' => $this->string(400),
            'keywords' => $this->string(255),
            'text' => $this->text(),
            'order' => $this->integer(3)->defaultValue(0),
            'status' => $this->integer(1)->defaultValue(0),
            'update_at' => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'create_at' => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP',
            'old_id' => $this->integer(11)
        ]);
        
        // creates index for column `url`
        $this->createIndex(
            '{{%idx-brands-url}}',
            '{{%brands}}',
            'url'
        );
        
        // insert data to table {{%main_services}}        
        $brandsDataArray = include __DIR__.'/data/data_m201124_121457.php';  
        foreach($brandsDataArray as $key => $data) {
            $brandsDataArray[$key]['header'] = 'Ремонт ' . $data['name'] . ' ' . $data['rus_name'];
            $brandsDataArray[$key]['title'] = 'Ремонт ' . $data['name'] . ' ' . $data['rus_name'] . ' - автосервис ' . $data['name'];
            $brandsDataArray[$key]['description'] = '{star}{star}{star}{star}{star} Качественный ремонт ' . $data['name'] . ' ' . $data['rus_name'] . ' по доступным ценам в Москве. {check} Бесплатная диагностика. {check} Бесплатный эвакуатор. {check} Гарантия 2 года. {rocket} Ремонт ' . $data['name'] . ' узнать цены и {aclock} записаться в автосервис ' . $data['name'] . ' «Раннинг Моторс» {phone)️ +7(495)477-33-96.';
        }
        $this->batchInsert('{{%brands}}', [
            'name','rus_name','url','title','description','keywords','text','status','order','old_id','header'
        ], $brandsDataArray);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops index for column `url`
        $this->dropIndex(
            '{{%idx-brands-url}}',
            '{{%brands}}'
        );
        
        $this->dropTable('{{%brands}}');
    }
}

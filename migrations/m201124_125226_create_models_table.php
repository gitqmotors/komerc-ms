<?php

/*
 * 24.11.2020
 * File: m201124_125226_create_modelss_table.php
 * Encoding: UTF-8
 * Project: RMS special for Quality Motors team
 * 
 * Author: Gafuroff Alexandr 
 * E-mail: gafuroff.al@yandex.ru
 */

use yii\db\Migration;
use app\models\Brands;

/**
 * Handles the creation of table `{{%modelss}}`.
 */
class m201124_125226_create_models_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%models}}', [
            'id' => $this->primaryKey(),
            'brand_id' => $this->integer()->notNull(),
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
            'old_id' => $this->integer(11),
            'parent_old_id' => $this->integer(11)
        ]);
        
        // creates index for column `brand_id`
        $this->createIndex(
            '{{%idx-models-brand_id}}',
            '{{%models}}',
            'brand_id'
        );

        // add foreign key for table `{{%brands}}`
        $this->addForeignKey(
            '{{%fk-models-brand_id}}',
            '{{%models}}',
            'brand_id',
            '{{%brands}}',
            'id',
            'CASCADE'
        );
        
        // creates index for column `url`
        $this->createIndex(
            '{{%idx-models-url}}',
            '{{%models}}',
            'url'
        );
        
        $modelsDataArray = include __DIR__ . '/data/data_m201124_125226.php';
        foreach($modelsDataArray as $key => $data) {
            $brand = Brands::find()->where(['old_id' => $data['parent_old_id']])->one();
            $modelsDataArray[$key]['brand_id'] = $brand->id;  
            $modelsDataArray[$key]['header'] = 'Ремонт ' . $brand->name . ' ' . $data['name'] . ' ' . $data['rus_name'] . '';      
            $modelsDataArray[$key]['title'] = 'Ремонт ' . $brand->name . ' ' . $data['name'] . ' ' . $data['rus_name'] . ' - автосервис ' . $brand->name;
            $modelsDataArray[$key]['description'] = '{star}{star}{star}{star}{star} Качественный ремонт ' . $brand->name . ' ' . $data['name'] . ' ' . $data['rus_name'] . ' по доступным ценам в Москве. {check} Бесплатная диагностика. {check} Бесплатный эвакуатор. {check} Гарантия 2 года. {rocket} Ремонт ' . $brand->name . ' ' . $data['name'] . ' узнать цены и {aclock} записаться в автосервис ' . $brand->name . ' «Раннинг Моторс» {phone)️ +7(495)477-33-96.';
        } 
      
        $this->batchInsert('{{%models}}', [
            'name','rus_name','url','title','description','keywords','text','status','order','old_id','parent_old_id','brand_id','header'
        ], $modelsDataArray);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%brands}}`
        $this->dropForeignKey(
            '{{%fk-models-brand_id}}',
            '{{%models}}'
        );

        // drops index for column `brand_id`
        $this->dropIndex(
            '{{%idx-models-brand_id}}',
            '{{%models}}'
        );
        
        // drops index for column `url`
        $this->dropIndex(
            '{{%idx-models-url}}',
            '{{%models}}'
        );
        
        $this->dropTable('{{%models}}');
    }
}

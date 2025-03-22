<?php

/* 
 * 27.11.2020
 * File: m201127_063933_create_indep_services_table.php
 * Encoding: UTF-8
 * Project: RMS special for Quality Motors team
 * 
 * Author: Gafuroff Alexandr 
 * E-mail: gafuroff.al@yandex.ru
 */

use yii\db\Migration;
use app\models\IndependensServices;

/**
 * Handles the creation of table `{{%indep_services}}`.
 */
class m201127_063933_create_indep_services_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%indep_services}}', [
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
            'order' => $this->integer(3)->defaultValue(500),
            'update_at' => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'create_at' => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP',
            'old_id' => $this->integer(11),
            'parent_old_id' => $this->integer(11)
        ]);
        
        // creates index for column `url`
        $this->createIndex(
            '{{%idx-indep_services-url}}',
            '{{%indep_services}}',
            'url'
        );
        
        // creates index for column `parent_id`
        $this->createIndex(
            '{{%idx-indep_services-parent_id}}',
            '{{%indep_services}}',
            'parent_id'
        );

        // add foreign key for table `{{%parent}}`
        $this->addForeignKey(
            '{{%fk-indep_services-parent_id}}',
            '{{%indep_services}}',
            'parent_id',
            '{{%indep_services}}',
            'id',
            'CASCADE'
        );        
       
        $servicesData = include(__DIR__ . '/data/data_m201127_063933.php');
        foreach($servicesData as $key => $data) {
            if($data['url'] != '') {
                $this->insert('{{%indep_services}}', [
                    'name' => $data['name'],
                    'header' => $data['name'],
                    'url' => $data['url'],
                    'title' => str_replace('{CAR}', '', $data['title']),
                    'description' => str_replace('{CAR}', '', $data['description']),
                    'keywords' => str_replace('{CAR}', '', $data['keywords']),
                    'text' => str_replace('{CAR}', '', $data['text']),
                    'order' => $data['order'],
                    'old_id' => $data['old_id'],
                    'parent_old_id' => $data['parent_old_id']
                ]);
            }        
        }
        
        $independences = IndependensServices::find()->where(['!=', 'parent_old_id', '0'])->all();
        foreach($independences as $services) {
            $parent = IndependensServices::find()->where(['old_id' => $services->parent_old_id])->one();
            $this->update('{{%indep_services}}', ['parent_id' => $parent->id], ['id' => $services->id]);
        }
        
        $independences = IndependensServices::find()->all();
        foreach($independences as $service) {
            $update = false;
            if(trim($service->title) == '') {
                $service->title = $service->header . ' цена - детейлинг студия в Москве';
                $update = true;
            }
            if(trim($service->description) == '') {
                $service->description = '{star}{star}{star}{star}{star} ' . $service->header . ' по доступным ценам в Москве. {check} Студия европейского уровня. {check} Вернем вид нового автомобиля! {check} Гарантия качества. {rocket} $Название услуги$ узнать цены и {aclock} записаться в детейлинг студию «Раннинг Моторс» {phone)️ +7(499)444-14-37';
                $update = true;
            }
            if ($update) {
                $this->update('{{%indep_services}}', ['title' => $service->title, 'description' => $service->description], ['id' => $service->id]);
            }
        }

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%parent}}`
        $this->dropForeignKey(
            '{{%fk-indep_services-parent_id}}',
            '{{%indep_services}}'
        );

        // drops index for column `parent_id`
        $this->dropIndex(
            '{{%idx-indep_services-parent_id}}',
            '{{%indep_services}}'
        );
        
        // drops index for column `url`
        $this->dropIndex(
            '{{%idx-indep_services-url}}',
            '{{%indep_services}}'
        );
        
        $this->dropTable('{{%indep_services}}');
    }
}

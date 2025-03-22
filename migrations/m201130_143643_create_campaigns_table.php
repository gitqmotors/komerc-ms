<?php

/* 
 * 01.12.2020
 * File: m201130_143643_create_campaigns_table.php
 * Encoding: UTF-8
 * Project: RMS special for Quality Motors team
 * 
 * Author: Gafuroff Alexandr 
 * E-mail: gafuroff.al@yandex.ru
 */

use yii\db\Migration;

/**
 * Handles the creation of table `{{%campaigns}}`.
 */
class m201130_143643_create_campaigns_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%campaigns}}', [
            'id' => $this->primaryKey(),
            'url' => $this->string(150)->unique()->notNull(),
            'name' => $this->string(255)->notNull(),
            'header' => $this->string(255)->notNull(),
            'anons' => $this->string(420),
            'title' => $this->string(255),
            'description' => $this->string(420),
            'keywords' => $this->string(255),
            'text' => $this->text(),
            'old_price' => $this->string(35),
            'new_price' => $this->string(35),
            'order' => $this->integer(3)->defaultValue(500),            
            'date_start' => 'DATETIME NULL DEFAULT NULL',
            'date_end' => 'DATETIME NULL DEFAULT NULL',
            'status' => $this->integer(1)->defaultValue(1),
            'update_at' => 'DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'create_at' => 'DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP',
        ]);
        
        // creates index for column `url`
        $this->createIndex(
            '{{%idx-campaigns-url}}',
            '{{%campaigns}}',
            'url'
        );
        
        $campaignsDataArray = include __DIR__ . '/data/data_m201130_143643.php';
        $this->batchInsert('{{%campaigns}}', 
            ['url','name','header','anons','title','description','keywords','text','new_price','order','status'], 
            $campaignsDataArray
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops index for column `url`
        $this->dropIndex(
            '{{%idx-campaigns-url}}',
            '{{%campaigns}}'
        );
        
        $this->dropTable('{{%campaigns}}');
    }
}

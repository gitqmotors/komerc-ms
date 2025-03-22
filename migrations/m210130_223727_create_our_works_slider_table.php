<?php

/* 
 * 31.01.2020
 * File: m210130_223727_create_our_works_slider_table.php
 * Encoding: UTF-8
 * Project: RMS special for Quality Motors team
 * 
 * Author: Gafuroff Alexandr 
 * E-mail: gafuroff.al@yandex.ru
 */

use yii\db\Migration;

/**
 * Handles the creation of table `{{%our_works_slider}}`.
 */
class m210130_223727_create_our_works_slider_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%our_works_slider}}', [
            'id' => $this->primaryKey(),
            'url_page' => $this->string(255),
            'images' => $this->text(),
            'status' => $this->integer(1)->defaultValue(1),
            'update_at' => 'DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'create_at' => 'DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP'
        ]);
        
        $dataArray = include __DIR__ . '/data/data_m210130_223727.php';
        $insertData = [];
        $counter = 0;
        foreach($dataArray as $data) {
            $counter++;
            $insertData[] = [
                'url_page' => $data['url_page'],
                'images' => $data['images']
            ];
            if($counter == 100) {                
                $this->batchInsert('{{%our_works_slider}}', ['url_page', 'images'], $insertData);
                $insertData = [];
                $counter = 0;
            }
        }
        $this->batchInsert('{{%our_works_slider}}', ['url_page', 'images'], $insertData);
        
        // creates index for column `url`
        $this->createIndex(
            '{{%idx-our_works_slider-url_page}}',
            '{{%our_works_slider}}',
            'url_page'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops index for column `url`
        $this->dropIndex(
            '{{%idx-our_works_slider-url_page}}',
            '{{%our_works_slider}}'
        );
        
        $this->dropTable('{{%our_works_slider}}');
    }
}

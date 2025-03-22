<?php

/* 
 * 01.12.2020
 * File: m201201_064913_create_portfolio_table.php
 * Encoding: UTF-8
 * Project: RMS special for Quality Motors team
 * 
 * Author: Gafuroff Alexandr 
 * E-mail: gafuroff.al@yandex.ru
 */

use yii\db\Migration;

/**
 * Handles the creation of table `{{%portfolio}}`.
 */
class m201201_064913_create_portfolio_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%portfolio}}', [
            'id' => $this->primaryKey(),
            'url' => $this->string(150)->unique()->notNull(),
            'name' => $this->string(190)->notNull(),
            'anons' => $this->string(420),
            'title' => $this->string(255),
            'description' => $this->string(420),
            'keywords' => $this->string(255),
            'text' => $this->text(),
            'image' => $this->string(155),
            'gallery' => $this->string(1020),
            'before_gallery' => $this->string(1020),
            'after_gallery' => $this->string(1020),
            'date' => 'DATETIME NULL DEFAULT NULL',
            'order' => $this->integer(3)->defaultValue(500),
            'status' => $this->integer(1)->defaultValue(1),
            'update_at' => 'DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'create_at' => 'DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP',
        ]);
        
        // creates index for column `url`
        $this->createIndex(
            '{{%idx-portfolio-url}}',
            '{{%portfolio}}',
            'url'
        );
        
        $portfolioDataArray = include __DIR__ . '/data/data_m201201_064913.php';
        foreach($portfolioDataArray as $data) {
            $row = [];
            $row['url'] = $data['url'];
            $row['name'] = $data['name'];
            $row['anons'] = $data['anons'];
            $row['title'] = $data['title'] != '' ? $data['title'] : $data['name'] . ' - автосервис Раннинг Моторс';
            $row['description'] = $data['description'] != '' ? $data['description'] : $data['name'] . '. Примеры работ от автосервиса «Раннинг Моторс»';
            $row['keywords'] = $data['keywords'];
            $row['text'] = $data['text'];
            $row['image'] = $data['image'];
            $row['gallery'] = serialize($data['gallery']);
            $row['before_gallery'] = serialize($data['before_gallery']);
            $row['after_gallery'] = serialize($data['after_gallery']);
            $row['date'] = $data['date'];
            $row['order'] = $data['order'];
            $row['status']= $data['status'];
            
            $this->insert('{{%portfolio}}', $row);
        }
        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops index for column `url`
        $this->dropIndex(
            '{{%idx-portfolio-url}}',
            '{{%portfolio}}'
        );
        
        $this->dropTable('{{%portfolio}}');
    }
}

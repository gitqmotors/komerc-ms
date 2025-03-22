<?php

/* 
 * 26.11.2020
 * File: m201126_133639_create_main_pages_table.php
 * Encoding: UTF-8
 * Project: RMS special for Quality Motors team
 * 
 * Author: Gafuroff Alexandr 
 * E-mail: gafuroff.al@yandex.ru
 */

use yii\db\Migration;

/**
 * Handles the creation of table `{{%main_pages}}`.
 */
class m201126_133639_create_main_pages_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%main_pages}}', [
            'id' => $this->primaryKey(),
            'module_id' => $this->string(50)->notNull()->defaultValue('basic'),
            'controller_id' => $this->string(50)->notNull(),
            'action_id' => $this->string(50)->notNull(),
            'url' => $this->string(50),
            'name' => $this->string(150)->notNull(),
            'header' => $this->string(190),
            'title' => $this->string(255),
            'description' => $this->string(420),
            'keywords' => $this->string(255),
            'text' => $this->text(),
            'update_at' => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'create_at' => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP',
        ]);
        
        // creates index for column `module_id`
        $this->createIndex(
            '{{%idx-main_pages-module_id}}',
            '{{%main_pages}}',
            'module_id'
        );
        
        // creates index for column `controller_id`
        $this->createIndex(
            '{{%idx-main_pages-controller_id}}',
            '{{%main_pages}}',
            'controller_id'
        );
        
        // creates index for column `action_id`
        $this->createIndex(
            '{{%idx-main_pages-action_id}}',
            '{{%main_pages}}',
            'action_id'
        );
        
        // creates index for column `url`
        $this->createIndex(
            '{{%idx-main_pages-url}}',
            '{{%main_pages}}',
            'url'
        );
        
        $mainPagesData = include __DIR__ . '/data/data_m201126_133639.php';
        $this->batchInsert('{{%main_pages}}',
                ['module_id','controller_id','action_id','url','name','header','title','description','keywords','text'],
                $mainPagesData
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops index for column `module_id`
        $this->dropIndex(
            '{{%idx-main_pages-module_id}}',
            '{{%main_pages}}'
        );
        // drops index for column `controller_id`
        $this->dropIndex(
            '{{%idx-main_pages-controller_id}}',
            '{{%main_pages}}'
        );
        // drops index for column `action_id`
        $this->dropIndex(
            '{{%idx-main_pages-action_id}}',
            '{{%main_pages}}'
        );
        // drops index for column `url`
        $this->dropIndex(
            '{{%idx-main_pages-url}}',
            '{{%main_pages}}'
        );
        $this->dropTable('{{%main_pages}}');
    }
}

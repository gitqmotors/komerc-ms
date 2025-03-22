<?php

/* 
 * 01.12.2020
 * File: m201130_111629_create_pricelist_table.php
 * Encoding: UTF-8
 * Project: RMS special for Quality Motors team
 * 
 * Author: Gafuroff Alexandr 
 * E-mail: gafuroff.al@yandex.ru
 */

use yii\db\Migration;
use app\models\{IndependensServices, CommonServices, Pricelist};

/**
 * Handles the creation of table `{{%pricelist}}`.
 */
class m201130_111629_create_pricelist_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%pricelist}}', [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer(),
            'name' => $this->string(255),
            'price' => $this->integer(6)->defaultValue(0),
            'level' => $this->integer(1)->defaultValue(0),
            'status' => $this->integer(1)->defaultValue(0),
            'order' => $this->integer(3)->defaultValue(500),
            'update_at' => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'create_at' => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP',
            'old_id' => $this->integer(11),
            'parent_old_id' => $this->integer(11)
        ]);
        
        // creates index for column `parent_id`
        $this->createIndex(
            '{{%idx-pricelist-parent_id}}',
            '{{%pricelist}}',
            'parent_id'
        );

        // add foreign key for table `{{%prices}}`
        $this->addForeignKey(
            '{{%fk-pricelist-parent_id}}',
            '{{%pricelist}}',
            'parent_id',
            '{{%pricelist}}',
            'id',
            'CASCADE'
        );
        
        $dataArray = include __DIR__ . '/data/data_m201127_063933.php';
        foreach($dataArray as $data) {
            $this->insert('{{%pricelist}}', [
                'name' => $data['name'],
                'price' => $data['old_price'],
                'level' => $data['level'],
                'status' => 1,
                'order' => $data['order'],
                'old_id' => $data['old_id'],
                'parent_old_id' => $data['parent_old_id']
            ]);
        }
        
        $prices = Pricelist::find()->where(['!=', 'parent_old_id', '0'])->all();
        foreach($prices as $price) {
            $parent = Pricelist::find()->where(['old_id' => $price->parent_old_id])->one();
            $this->update('{{%pricelist}}', ['parent_id' => $parent->id], ['id' => $price->id]);
        }  
        
        $independences = IndependensServices::find()->all();
        foreach($independences as $services) {
            $price = Pricelist::find()->where(['name' => $services->name])->one();
            $this->update('{{%indep_services}}', ['price_group_id' => (!is_null($price->parent_id) ? $price->parent_id : $price->id)], ['id' => $services->id]);
        }
        
        $commons = CommonServices::find()->all();
        foreach($commons as $services) {
            $price = Pricelist::find()->where(['name' => $services->name])->one();
            $this->update('{{%common_services}}', ['price_group_id' => (!is_null($price->parent_id) ? $price->parent_id : $price->id)], ['id' => $services->id]);
        }
        
        $this->dropColumn('{{%pricelist}}', 'old_id');
        $this->dropColumn('{{%pricelist}}', 'parent_old_id');
        $this->dropColumn('{{%indep_services}}', 'old_id');
        $this->dropColumn('{{%indep_services}}', 'parent_old_id');
        $this->dropColumn('{{%common_services}}', 'old_id');
        $this->dropColumn('{{%common_services}}', 'parent_old_id');
        
        $prices = Pricelist::find()->all();
        foreach($prices as $price) {
            $this->update('{{%indep_services}}', ['price_id' => $price->id], ['name' => $price->name, 'price_group_id' => $price->parent_id]);
            $this->update('{{%common_services}}', ['price_id' => $price->id], ['name' => $price->name, 'price_group_id' => $price->parent_id]);
        }       
        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%prices}}`
        $this->dropForeignKey(
            '{{%fk-pricelist-parent_id}}',
            '{{%pricelist}}'
        );

        // drops index for column `parent_id`
        $this->dropIndex(
            '{{%idx-pricelist-parent_id}}',
            '{{%pricelist}}'
        );
        
        $this->dropTable('{{%pricelist}}');
    }
}

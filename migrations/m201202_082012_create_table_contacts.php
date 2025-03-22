<?php

/* 
 * 02.12.2020
 * File: m201202_082012_create_table_contacts.php
 * Encoding: UTF-8
 * Project: RMS special for Quality Motors team
 * 
 * Author: Gafuroff Alexandr 
 * E-mail: gafuroff.al@yandex.ru
 */

use yii\db\Migration;

/**
 * Class m201202_082012_create_table_contacts
 */
class m201202_082012_create_table_contacts extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%contacts}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100)->notNull(),
            'form_name' => $this->string(50)->notNull(),
            'directors_email' => $this->text()->notNull(),
            'address' => $this->string(100)->notNull(),
            'phone' => $this->string(20)->notNull(),
            'yandex_reach_goal' => $this->string(50),
            'mango_number_id' => $this->integer(),
            'call_tracking_id' => $this->integer(),
            'service_identifier' => $this->string(255),
            'yandex_map_path' => $this->text()->notNull(),
            'yandexnavi_path' => $this->text()->notNull(),
            'google_map_path' => $this->text()->notNull(),
        ]);
        
        //insert data to table {{%contacts}}
        $dataArray = include __DIR__.'/data/data_m201202_082012.php';
        foreach($dataArray as $data) {       
            $row = array();
            $row['name'] = $data['name'];
            $row['form_name'] = $data['form_name'];
            $row['directors_email'] = serialize($data['directors_email']);
            $row['address'] = $data['address'];
            $row['phone'] = $data['phone'];         
            $row['yandex_reach_goal'] = $data['yandex_reach_goal'];
            $row['mango_number_id'] = $data['mango_number_id'];
            $row['call_tracking_id'] = $data['call_tracking_id'];
            $row['service_identifier'] = $data['service_identifier'];
            $row['yandex_map_path'] = $data['yandex_map_path'];
            $row['yandexnavi_path'] = $data['yandexnavi_path'];  
            $row['google_map_path'] = $data['google_map_path'];  
         
            $this->insert('{{%contacts}}', $row);       
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%contacts}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201202_082012_create_table_contacts cannot be reverted.\n";

        return false;
    }
    */
}

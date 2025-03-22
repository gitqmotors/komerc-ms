<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%feedbacks}}`.
 */
class m210309_211538_create_feedbacks_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%feedbacks}}', [
            'id' => $this->primaryKey(),
            'header' => $this->string(180),
            'title' => $this->string(180),
            'description' => $this->string(400),
            'keywords' => $this->string(255),
            'url' => $this->string(100)->notNull(),
            'reviewer' => $this->string(255),
            'anons' => $this->text(),
            'text' => $this->text(),
            'image' => $this->string(255), 
            'date' => 'DATETIME NULL DEFAULT NULL',
            'active' => $this->integer(1)->defaultValue(0),
            'order' => $this->integer(3)->defaultValue(0),
            'update_at' => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'create_at' => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP'
        ]);
        
        $dataArray = include __DIR__ . '/data/data_m210309_211538.php';
        
        $this->batchInsert('{{%feedbacks}}', [
            'header','title','description','keywords','url','reviewer','anons','text','image','date','active','order'
        ], $dataArray); 
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%feedbacks}}');
    }
}

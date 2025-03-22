<?php

use yii\db\Migration;

/**
 * Class m210223_111244_ordered_brands_data
 */
class m210223_111244_ordered_brands_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $dataArray = include __DIR__ . '/data/data_m210223_111244.php';
        foreach($dataArray as $data) {
            $this->update('{{%brands}}', ['order' => $data['order']], ['name' => $data['name']]);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210223_111244_ordered_brands_data cannot be reverted.\n";
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210223_111244_ordered_brands_data cannot be reverted.\n";

        return false;
    }
    */
}

<?php

use yii\db\Migration;

/**
 * Class m210519_184322_change_imageges_in_ourworks_slider_on_mainpage
 */
class m210519_184322_change_imageges_in_ourworks_slider_on_mainpage extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->update('our_works_slider', 
                ['images' => 'main/1.jpg|main/2.jpg|main/3.jpg|main/4.jpg|main/5.jpg|main/6.jpg|main/7.jpg|main/8.jpg|main/9.jpg|main/10.jpg|main/11.jpg|main/12.jpg|main/13.jpg|main/14.jpg|main/15.jpg'], 
                ['id' => 1]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210519_184322_change_imageges_in_ourworks_slider_on_mainpage cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210519_184322_change_imageges_in_ourworks_slider_on_mainpage cannot be reverted.\n";

        return false;
    }
    */
}

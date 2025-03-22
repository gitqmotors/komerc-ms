<?php

use yii\db\Migration;

/**
 * Class m210511_170406_technical_audit
 */
class m210511_170406_technical_audit extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->update('our_works_slider', ['images' => 'rulevoe/DSC03862.jpg'], ['images' => 'rulevoe/12121-4']);
        $this->update('indep_services', [
            'description' => 'В наших автосервисах Вы гарантированно получите качественные услуги по шиномонтажу ! Разборка и сборка колеса 4x4 и микроавтобуса R20 по актуальной цене'
        ], [
            'id' => 218
        ]);       
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210511_170406_technical_audit cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210511_170406_technical_audit cannot be reverted.\n";

        return false;
    }
    */
}

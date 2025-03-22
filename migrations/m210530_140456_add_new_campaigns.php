<?php

use yii\db\Migration;

/**
 * Class m210530_140456_add_new_campaigns
 */
class m210530_140456_add_new_campaigns extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->update('campaigns', ['status' => 0], ['id' => 11]);
        
        $this->insert('campaigns', [
            'url' => 'zapravka-avtokondicionera',
            'name' => 'Заправка автокондиционера',
            'header' => 'Заправка автокондиционера',
            'anons' => 'Диагностика и заправка кондиционера BRAND MODEL',
            'title' => 'Заправка автокондиционера - акции от автосервиса «РАННИНГ МОТОРС»',
            'description' => 'Заправка автокондиционера. Акции и скидки от Автосервис «РАННИНГ МОТОРС» - Замена тормозных колодок и дисков',
            'text' => '<p>Диагностика и заправка кондиционера</p>',
            'new_price' => '1700',
            'order' => 9,
            'status' => 1,
        ]);
        
        $this->update('pricelist', ['price' => '1700'], ['id' => 192]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210530_140456_add_new_campaigns cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210530_140456_add_new_campaigns cannot be reverted.\n";

        return false;
    }
    */
}

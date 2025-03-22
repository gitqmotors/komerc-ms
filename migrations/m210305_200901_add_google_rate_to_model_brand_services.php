<?php

use yii\db\Migration;
use app\models\Brands;
use app\models\Models;
use app\models\IndependensServices;
use app\models\CommonServices;

/**
 * Class m210305_200901_add_google_rate_to_model_brand_services
 */
class m210305_200901_add_google_rate_to_model_brand_services extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%brands}}', 'g_rate', $this->float(2,1)->after("status"));
        $this->addColumn('{{%brands}}', 'g_feeds', $this->integer(5)->defaultValue(0)->after("g_rate"));
        $brands = Brands::find()->asArray()->all();
        foreach($brands as $data) {
            $this->update('{{%brands}}', ['g_rate' => '4.'.rand(6, 9), 'g_feeds' => rand(7, 30)], ['id' => $data['id']]);
        }        
        
        $this->addColumn('{{%models}}', 'g_rate', $this->float(2,1)->after("status"));
        $this->addColumn('{{%models}}', 'g_feeds', $this->integer(5)->defaultValue(0)->after("g_rate"));
        $models = Models::find()->asArray()->all();
        foreach($models as $data) {
            $this->update('{{%models}}', ['g_rate' => '4.'.rand(6, 9), 'g_feeds' => rand(7, 30)], ['id' => $data['id']]);
        }
        
        $this->addColumn('{{%indep_services}}', 'g_rate', $this->float(2,1)->after("order"));
        $this->addColumn('{{%indep_services}}', 'g_feeds', $this->integer(5)->defaultValue(0)->after("g_rate"));
        $services = IndependensServices::find()->asArray()->all();
        foreach($services as $data) {
            $this->update('{{%indep_services}}', ['g_rate' => '4.'.rand(6, 9), 'g_feeds' => rand(7, 30)], ['id' => $data['id']]);
        }
        
        $this->addColumn('{{%common_services}}', 'g_rate', $this->float(2,1)->after("order"));
        $this->addColumn('{{%common_services}}', 'g_feeds', $this->integer(5)->defaultValue(0)->after("g_rate"));
        $mainservices = CommonServices::find()->asArray()->all();
        foreach($mainservices as $data) {
            $this->update('{{%common_services}}', ['g_rate' => '4.'.rand(6, 9), 'g_feeds' => rand(7, 30)], ['id' => $data['id']]);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210305_200901_add_google_rate_to_model_brand_services cannot be reverted.\n";
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210305_200901_add_google_rate_to_model_brand_services cannot be reverted.\n";

        return false;
    }
    */
}

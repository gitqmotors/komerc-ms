<?php


namespace app\blocks\Modal;

use app\blocks\Block;
use app\models\Contacts;


class ModalFormAlternative extends Block
{
    /**
     * @var boolean
     */
    public $detailing;
    
    /**
     * {@inheritdoc}
     */
    public function run()
    {
        $query = Contacts::find()
            ->select('form_name')
            ->indexBy('service_identifier');
        if ($this->detailing) {
            $query->where(['!=', 'service_identifier', 'kalugskaya']);
        }        
        $services = $query->column();
        $json = \yii\helpers\Json::encode($services);
        return $this->render(compact('json'), 'block_alternative');
    }

}
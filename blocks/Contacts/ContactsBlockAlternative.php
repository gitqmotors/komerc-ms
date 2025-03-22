<?php


namespace app\blocks\Contacts;

use Yii;
use app\blocks\Block;
use app\models\Contacts;

class ContactsBlockAlternative extends Block
{
    /**
     * @var app\models\Contacts
     */
    public $contacts;
    /**
     * @var boolean
     */

    public $detailing;

    public function init()
    {
        parent::init();
        if(isset(Yii::$app->controller->contacts) AND !is_null(Yii::$app->controller->contacts) AND is_null($this->contacts)) {
            $this->contacts = Yii::$app->controller->contacts;
        }
        if(is_null($this->contacts)) {
            $this->contacts = Contacts::find()->all();
        }
    }

    public function run()
    {
        $items = '';
        foreach($this->contacts as $item) {
            if ($this->detailing && $item->service_identifier == 'kalugskaya') {
                continue;
            }
            $items .= $this->getItem($item, [], 'item_no_phone');
        }
        return $this->render([
            'items' => $items,
            'detailing' => $this->detailing,
        ], 'block_one_phone');
    }

}
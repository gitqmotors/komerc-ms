<?php


namespace app\widgets\Contacts;
use Yii;
use app\widgets\AppWidget;

class ContactsWidgetAlternative extends AppWidget
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
            $items .= $this->getItem($item, [], 'item_alternative');
        }
        return $this->render(compact('items'));
    }

}
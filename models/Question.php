<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "question".
 *
 * @property int $id
 * @property int|null $brand_id
 * @property int|null $model_id
 * @property string|null $question
 * @property string|null $answer
 * @property int|null $order_id
 * @property int|null $status
 */
class Question extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'question';
    }

}

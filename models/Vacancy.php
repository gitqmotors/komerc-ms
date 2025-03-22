<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vacancy".
 *
 * @property int $id
 * @property string|null $url
 * @property string|null $title
 * @property string|null $keywords
 * @property string|null $mini_description
 * @property string|null $description
 * @property int|null $position
 * @property int|null $status
 * @property string $update_at
 * @property string $create_at
 */
class Vacancy extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'vacancy';
    }

}

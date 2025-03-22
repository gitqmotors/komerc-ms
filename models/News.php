<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "news".
 *
 * @property int $id
 * @property string|null $header
 * @property string|null $title
 * @property string|null $description
 * @property string|null $keywords
 * @property string $url
 * @property string|null $anons
 * @property string|null $text
 * @property string|null $image
 * @property string|null $date
 * @property int|null $active
 * @property int|null $order
 * @property string $update_at
 * @property string $create_at
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['url'], 'required'],
            [['anons', 'text'], 'string'],
            [['date'], 'safe'],
            [['active', 'order'], 'integer'],
            [['header', 'title'], 'string', 'max' => 180],
            [['description'], 'string', 'max' => 400],
            [['keywords', 'image'], 'string', 'max' => 255],
            [['url'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'header' => 'Header',
            'title' => 'Title',
            'description' => 'Description',
            'keywords' => 'Keywords',
            'url' => 'Url',
            'anons' => 'Anons',
            'text' => 'Text',
            'image' => 'Image',
            'date' => 'Date',
            'active' => 'Active',
            'order' => 'Order',
            'update_at' => 'Update At',
            'create_at' => 'Create At',
        ];
    }
}

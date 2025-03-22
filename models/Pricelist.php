<?php

/*
 * 30.11.2020
 * File: Pricelist.php
 * Encoding: UTF-8
 * Project: RMS special for Quality Motors team
 * 
 * Author: Gafuroff Alexandr 
 * E-mail: gafuroff.al@yandex.ru
 */

namespace app\models;

use yii\db\ActiveQuery;

/**
 * Description of Pricelist
 *
 * @author Александр
 */
class Pricelist extends AppActiveRecord
{
    /**
     * @var array
     */
    public $children = [];
    /**
     * @var string|null
     */
    public $href;
    // Коэффициент корректировки цен
    public const MARGIN = 1.375;

    public static function tableName(): string
    {
        return 'pricelist';
    }

    public function insertChild($child, $first = false): void
    {
        if ($first) {
            array_unshift($this->children, $child);
        } else {
            $this->children[] = $child;
        }
    }

    public function getIndepservice()
    {
        return $this->hasOne(IndependensServices::class, ['price_id' => 'id']);
    }

    public function getCommonservice()
    {
        return $this->hasOne(CommonServices::class, ['price_id' => 'id']);
    }

    public function getPrice()
    {
        $price = $this->getAttribute('price') ?? 0;

        if ($price > 0) {
            $price = $price * self::MARGIN;
            // Округление цены, чтобы избежать таких значений, как 399 или 413
            $price = ceil($price / 10) * 10;
        }

        return $price;
    }
}

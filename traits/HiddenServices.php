<?php

namespace app\traits;

use DateTimeImmutable;

/*
 * Новые услуги должны были быть доступными только для марок!
 */
trait HiddenServices
{
    public function isHiddenService(): bool
    {
        static $createdAt;

        if ($createdAt === null) {
            $createdAt = (new DateTimeImmutable('2023-08-22'))->format('Y-m-d H:i:s');
        }

        return $this->getAttribute('update_at') == $createdAt;
    }
}
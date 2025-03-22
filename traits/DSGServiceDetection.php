<?php

namespace app\traits;

// Определяет услуги, связанные с DSG трансмиссией
trait DSGServiceDetection
{
    public function isDSG(): bool
    {
        $serviceUrlList = [
            'remont-korobki-dsg',
            'diagnostika-dsg',
            'zamena-sceplenia-dsg'
        ];

        $currentUrl = $this->getAttribute('url');

        return in_array($currentUrl, $serviceUrlList);
    }
}
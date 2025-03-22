<?php

/*
 * 27.03.2020
 * File: google_schema.php
 * Encoding: UTF-8
 * Project: tokyogarage-yii2.loc
 * 
 * Author: Gafuroff Alexandr 
 * E-mail: gafuroff.al@yandex.ru
 */

use yii\helpers\Url;

/** @var array $breadcrumbs */

$json = [
    '@context'        => 'https://schema.org/',
    '@type'           => 'BreadcrumbList',
    'itemListElement' => [
        [
            '@type'    => 'ListItem',
            'position' => 1,
            'item'     => [
                '@id'  => Url::base(true),
                'name' => '📍 Раннинг Моторс'
            ]
        ]
    ],
];

foreach ($breadcrumbs as $k => $breadcrumb) {
    $i = $k + 2;

    // Для четных записей зеленая галочка, для нечетных - серая
    $pic = ($i % 2 === 0) ? '✅' : '☑️';

    if (isset($breadcrumb['url'])) {
        $json['itemListElement'][] = [
            '@type'    => 'ListItem',
            'position' => $i,
            'item'     => [
                '@id'  => Url::base(true) . $breadcrumb['url'],
                'name' => $pic . ' ' . $breadcrumb['label']
            ],
        ];
    } else {
        $json['itemListElement'][] = [
            '@type'    => 'ListItem',
            'position' => $i,
            'item'     => [
                '@id'  => Url::base(true) . Yii::$app->request->url,
                'name' => $pic . ' ' . $breadcrumb
            ],
        ];
    }
}
//\yii\helpers\Json::encode()
$jsonFlags = \JSON_NUMERIC_CHECK
    | \JSON_UNESCAPED_UNICODE
    | \JSON_PRESERVE_ZERO_FRACTION
    | \JSON_PRETTY_PRINT
    | \JSON_UNESCAPED_SLASHES
;
?>

<script type="application/ld+json">
<?php echo json_encode($json, $jsonFlags); ?>
</script>

<?php

/* 
 * 27.03.2020
 * File: shema_org.php
 * Encoding: UTF-8
 * Project: tokyogarage-yii2.loc
 * 
 * Author: Gafuroff Alexandr 
 * E-mail: gafuroff.al@yandex.ru
 */

use yii\helpers\Url;

?>
<meta property="schema:name" content="<?= $seo['title']; ?>">
        <meta property="schema:description" content="<?= $seo['description']; ?>">
<?php /*
        <script type="application/ld+json">
            {
              "@context" : "https://schema.org",
              "@type" : "LocalBusiness",
              "name" : "Токио Сервис",
              "image" : "<?= Url::base(true); ?>/images/static/logo.png",
              "telephone" : "+7 (495) 374-75-88",
              "email" : "service@tokyogarage.ru",
              "address" : {
                "@type" : "PostalAddress",
                "addressLocality" : "Москва",
                "streetAddress" : "Научный проезд 14а с. 5",
                "addressCountry" : "Россия"
              },
              "sameAs" : [ "https://www.instagram.com/tokyo_servis/", "https://www.facebook.com/groups/747666292001245/", "https://vk.com/tokyogarageru" ],
              "openingHours": "Пн-Вс 09:00-21:00",
              "paymentAccepted": "Оплата наличными, картой, рассрочка",
              "priceRange": "1200-1600 нормочас",
              "url" : "<?= Url::base(true); ?>",
              "aggregateRating" : {
                "@type" : "AggregateRating",
                    "ratingValue" : "4,792",
                "bestRating" : "5",
                "worstRating" : "4",
                "ratingCount" : "43"
                      }
            }
        </script>
*/ ?>
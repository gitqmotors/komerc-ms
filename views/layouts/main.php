<?php

/*
 * 23.11.2020
 * File: main.php
 * Encoding: UTF-8
 * Project: RMS special for Quality Motors team
 *
 * Author: Gafuroff Alexandr
 * E-mail: gafuroff.al@yandex.ru
 */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\helpers\Url;
use app\assets\AppAsset;
use app\widgets\Contacts\ContactsWidget;
use app\widgets\DropdownServices\DropdownServicesWidget;
use app\widgets\FooterServices\FooterServicesWidget;
use app\widgets\Mango\MangoWidget;
use app\blocks\Modal\ModalForm;
use app\helpers\Subdomains;

AppAsset::register($this);

$this->registerCss(
    <<<'CSS'
.info-text-wrap .info-text button:after {
    content: "Заказать";
}
.remontblock .remontblock-btn:after {
    content: 'Показать все';
}
.block1-utpwrap {
    text-align: center;
}
@media (max-width: 991px) {
    .block1-utpwrap {
        text-align: left;
    }
}
CSS
);

$baseUrl = Url::home(true);
$currentUrl = Url::current([], true);
$imageLogoUrl = Url::to('img/logo.png', true);

$productSKU = md5($currentUrl);

$pageTitle = Html::encode($this->title);
$pageDescription = Html::encode(Yii::$app->seo::$description);

// Страница брендов и услуг брендов
$isBrandService = (function () use ($currentUrl): bool {
    foreach (['remont-mercedes-benz', 'servis-bmw', 'remont-volkswagen'] as $subdomain) {
        if (str_contains($currentUrl, $subdomain)) {
            return true;
        }
    }

    $currentRoute = Yii::$app->controller->getRoute();

    return in_array($currentRoute, ['brands/item', 'brands/service']);
})();
// Страница моделей и услуг моделей
$isModelService = (function (): bool {
    $currentRoute = Yii::$app->controller->getRoute();

    return in_array($currentRoute, ['model/index', 'model/service']);
})();
// Страница общих услуг
$isService = (function (): bool {
    $currentRoute = Yii::$app->controller->getRoute();

    return in_array($currentRoute, ['service/item', 'site/pricelist']);
})();
?>
<?php $this->beginPage() ?>
<!doctype html>
<html lang="<?= Yii::$app->language; ?>">
    <head>
        <meta charset="<?= Yii::$app->charset; ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php $this->registerCsrfMetaTags(); ?>
        <title><?php echo $pageTitle; ?></title>
        <?php Yii::$app->seo->canonicalMeta($this->params); ?>
        <?php /* Yii::$app->seo->ampMeta($this->params);*/ ?>

        <link rel="preload" href="/css/style.min.css.gz" as="style">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">

        <?php $this->head(); ?>

        <!--link rel="apple-touch-icon-precomposed" sizes="57x57" href="/img/favicons/apple-touch-icon-57x57.png" />
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/img/favicons/apple-touch-icon-114x114.png" />
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/img/favicons/apple-touch-icon-72x72.png" />
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/img/favicons/apple-touch-icon-144x144.png" />
        <link rel="apple-touch-icon-precomposed" sizes="60x60" href="/img/favicons/apple-touch-icon-60x60.png" />
        <link rel="apple-touch-icon-precomposed" sizes="120x120" href="/img/favicons/apple-touch-icon-120x120.png" />
        <link rel="apple-touch-icon-precomposed" sizes="76x76" href="/img/favicons/apple-touch-icon-76x76.png" />
        <link rel="apple-touch-icon-precomposed" sizes="152x152" href="/img/favicons/apple-touch-icon-152x152.png" />
        <link rel="icon" type="image/png" href="/img/favicons/favicon-196x196.png" sizes="196x196" />
        <link rel="icon" type="image/png" href="/img/favicons/favicon-96x96.png" sizes="96x96" />
        <link rel="icon" type="image/png" href="/img/favicons/favicon-32x32.png" sizes="32x32" />
        <link rel="icon" type="image/png" href="/img/favicons/favicon-16x16.png" sizes="16x16" />
        <link rel="icon" type="image/png" href="/img/favicons/favicon-128.png" sizes="128x128" />

        <meta name="application-name" content="&nbsp;"/>
        <meta name="msapplication-TileColor" content="#FFFFFF" />
        <meta name="msapplication-TileImage" content="/img/favicons/mstile-144x144.png" />
        <meta name="msapplication-square70x70logo" content="/img/favicons/mstile-70x70.png" />
        <meta name="msapplication-square150x150logo" content="/img/favicons/mstile-150x150.png" />
        <meta name="msapplication-wide310x150logo" content="/img/favicons/mstile-310x150.png" />
        <meta name="msapplication-square310x310logo" content="/img/favicons/mstile-310x310.png" />

        <link rel="icon" type="image/x-icon" href="/favicon.ico">
        <link rel="icon" type="image/svg-xml" href="/favicon.svg"-->

        <!-- Open Graph Meta Start -->
        <?=Yii::$app->seo->renderOGMeta(); ?>
        <!-- Open Graph Meta End -->

        <!-- Shema Org Start -->
        <?= Yii::$app->seo->renderShemaMeta(); ?>
        <?= Yii::$app->seo->breadcrumbShema($this->params); ?>
        <!-- Shema Org End -->

        <!-- SCHEMA -->
        <?php if($isBrandService || $isModelService || $isService): ?>
            <script type="application/ld+json">
                {
                    "@context": "https://schema.org",
                    "@type": "Product",
                    "aggregateRating": {
                        "@type": "AggregateRating",
                        "ratingValue": "4.8",
                        "reviewCount": "53"
                    },
                    "name": "<?php echo $pageTitle; ?>",
                    "description": "<?php echo $pageDescription; ?>",
                    "sku": "<?php echo $productSKU; ?>",
                    "url": "<?php echo $currentUrl; ?>",
                    "image": "<?php echo $imageLogoUrl; ?>",
                    "offers": {
                        "@type": "AggregateOffer",
                        "url": "<?php echo $currentUrl; ?>",
                        "availability": "https://schema.org/InStock",
                        "lowPrice": "1000",
                        "priceCurrency": "RUB"
                    },
                    "review": [
                        {
                            "@type": "Review",
                            "reviewRating": {
                                "@type": "Rating",
                                "bestRating": "5",
                                "ratingValue": "5",
                                "worstRating": "1"
                            },
                            "author": {
                                "@type": "Person",
                                "name": "Артем"
                            }
                        },
                        {
                            "@type": "Review",
                            "reviewRating": {
                                "@type": "Rating",
                                "bestRating": "5",
                                "ratingValue": "5",
                                "worstRating": "1"
                            },
                            "author": {
                                "@type": "Person",
                                "name": "Мария"
                            }
                        },
                        {
                            "@type": "Review",
                            "reviewRating": {
                                "@type": "Rating",
                                "bestRating": "5",
                                "ratingValue": "5",
                                "worstRating": "1"
                            },
                            "author": {
                                "@type": "Person",
                                "name": "Андрей"
                            }
                        }
                    ]
                }
            </script>
            <script type="application/ld+json">
                {
                    "@context": "https://schema.org",
                    "@type": "LocalBusiness",
                    "name": "Раннинг Моторс",
                    "image": "<?php echo $imageLogoUrl; ?>",
                    "telephone": "+7(495)477-33-96",
                    "email": "director@r-ms.ru",
                    "address": {
                        "@type": "PostalAddress",
                        "addressLocality": "Москва",
                        "streetAddress": "Севастопольский пр. 95 б, стр 3",
                        "addressCountry": "Россия"
                    },
                    "sameAs": [
                        "https://vk.com/r_ms_company"
                    ],
                    "openingHours": "Пн-Вс 09:00-21:00",
                    "paymentAccepted": "Оплата наличными, картой, рассрочка",
                    "priceRange": "500-100000 RUB",
                    "url": "<?php echo $currentUrl; ?>",
                    "aggregateRating": {
                        "@type": "AggregateRating",
                        "ratingValue": "4.8",
                        "bestRating": "5",
                        "worstRating": "1",
                        "ratingCount": "53"
                    }
                }
            </script>
            <script type="application/ld+json">
                {
                    "@context": "https://schema.org",
                    "@type": "Organization",
                    "url": "<?php echo $currentUrl; ?>",
                    "name": "<?php echo $pageTitle; ?>",
                    "email": "director@r-ms.ru",
                    "logo": "<?php echo $imageLogoUrl; ?>",
                    "description": "<?php echo $pageDescription; ?>",
                    "address": {
                        "@type": "PostalAddress",
                        "addressCountry": "RUS",
                        "addressRegion": "Московская область",
                        "addressLocality": "Москва",
                        "postalCode": "117461",
                        "streetAddress": "Севастопольский пр. 95 б, стр 3"
                    },
                    "aggregateRating": {
                        "@type": "AggregateRating",
                        "ratingValue": "4.8",
                        "reviewCount": "53"
                    },
                    "contactPoint": [
                        {
                            "@type": "ContactPoint",
                            "telephone": "+7(495)477-33-96",
                            "contactType": "customer service"
                        },
                        {
                            "@type": "ContactPoint",
                            "telephone": "+7(499)490-27-73",
                            "contactType": "customer service"
                        }
                    ]
                }
            </script>
        <?php endif; ?>
        <!-- SCHEMA END -->

        <!--LiveInternet counter-->
        <script>
            document.write("<a href='//www.liveinternet.ru/click' "+
            "target=_blank class='liveinternet'><img src='//counter.yadro.ru/hit?t45.1;r"+
            escape(document.referrer)+((typeof(screen)=="undefined")?"":
            ";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?
            screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+
            ";"+Math.random()+
            "' alt='' title='LiveInternet' "+
            "border='0' width='1' height='1'><\/a>");
        </script>
        <!--/LiveInternet-->

    </head>
    <body>
        <!-- Yandex.Metrika counter -->
        <script>
            (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)}; m[i].l=1*new Date(); for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }} k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)}) (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym"); ym(38431175, "init", { clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true, trackHash:true, ecommerce:"dataLayer", triggerEvent: true });
        </script>
        <noscript><div><img src="https://mc.yandex.ru/watch/38431175" style="position:absolute; left:-9999px;" alt=""></div></noscript>
        <!-- /Yandex.Metrika counter -->
        <?php if ($isBrandService): ?>
            <script type="application/ld+json">
                {
                    "@context": "http://schema.org",
                    "@type": "Event",
                    "eventAttendanceMode": "OfflineEventAttendanceMode",
                    "eventStatus": "https://schema.org/EventScheduled",
                    "name": "🏆 Специализированный автосервис",
                    "description": "Раннинг Моторс - это сеть профильных автосервисов по ремонту и облсуживанию авто в Москве",
                    "url": "<?php echo $currentUrl; ?>",
                    "startDate": "2023-08-03 00:00:00",
                    "endDate": "2024-08-03 23:59:59",
                    "image": "<?php echo $imageLogoUrl; ?>",
                    "performer": "Раннинг Моторс",
                    "location": {
                        "@type": "Place",
                        "name": "Раннинг Моторс",
                        "address": {
                            "@type": "PostalAddress",
                            "addressLocality": "Москва",
                            "addressRegion": "Московская область",
                            "streetAddress": "Севастопольский пр-т, 95Б с.3"
                        }
                    },
                    "offers": {
                        "@type": "Offer",
                        "availability": "https://schema.org/InStock",
                        "price": "1800",
                        "priceCurrency": "RUB",
                        "url": "<?php echo $currentUrl; ?>",
                        "validFrom": "2023-08-03 00:00:00"
                    },
                    "organizer": {
                        "@type": "Organization",
                        "name": "Раннинг Моторс",
                        "url": "<?php echo $baseUrl; ?>"
                    }
                }
            </script>
            <script type="application/ld+json">
                {
                    "@context": "http://schema.org",
                    "@type": "Event",
                    "eventAttendanceMode": "OfflineEventAttendanceMode",
                    "eventStatus": "https://schema.org/EventScheduled",
                    "name": "🔥 Озвучиваем стоимость до начала работ",
                    "description": "После диагностики, озвучим стоимость ремонта до начала всех работ.",
                    "url": "<?php echo $currentUrl; ?>",
                    "startDate": "2023-08-03 00:00:00",
                    "endDate": "2024-08-03 23:59:59",
                    "image": "<?php echo $imageLogoUrl; ?>",
                    "performer": "Раннинг Моторс",
                    "location": {
                        "@type": "Place",
                        "name": "Раннинг Моторс",
                        "address": {
                            "@type": "PostalAddress",
                            "addressLocality": "Москва",
                            "addressRegion": "Московская область",
                            "streetAddress": "Севастопольский пр-т, 95Б с.3"
                        }
                    },
                    "offers": {
                        "@type": "Offer",
                        "availability": "https://schema.org/InStock",
                        "price": "1800",
                        "priceCurrency": "RUB",
                        "url": "<?php echo $currentUrl; ?>",
                        "validFrom": "2023-08-03 00:00:00"
                    },
                    "organizer": {
                        "@type": "Organization",
                        "name": "Раннинг Моторс",
                        "url": "<?php echo $baseUrl; ?>"
                    }
                }
            </script>
            <script type="application/ld+json">
                {   "@context": "http://schema.org",
                    "@type": "Organization",
                    "address": {
                        "@type": "PostalAddress",
                        "addressLocality" : "Москва",
                        "addressRegion": "Московская область",
                        "streetAddress": "Севастопольский пр-т, 95Б с.3"
                    },
                    "email": "service@r-ms.ru",
                    "name" : "Раннинг Моторс, ремонт и обслуживание авто",
                    "telephone" : "+7 (499) 444-14-37"
                }
            </script>
        <?php endif; ?>

        <?php $this->beginBody(); ?>

        <!--Шапка начало-->
        <div class="header">
            <div class="container container2">
                <div class="row">
                    <div class="col-md-2 col-3 header-logo">
                        <a href="<?= Yii::$app->homeUrl; ?>">
                            <img src="<?php echo $imageLogoUrl; ?>" alt="RMS logo">
                        </a>
                    </div>
                    <div class="col-lg-7 col-xl-8 col-md-9 col-sm-9 header-center">

                        <div class="header-center-menu accordion">
                            <div class="mobmenu-close-wrap">
                                <div class="mobmenu-close"><img  src="/img/icon/close-black.svg" alt="X"></div>
                            </div>
                            <div class="punkt vipbtn   accordion_item">

                                <span class="vipbtn-ssil title_block">Услуги</span>
                                <?= DropdownServicesWidget::widget(); ?>
                            </div>
                            <div class="punkt"><a href="<?= Url::to(['/pricelist']); ?>">Цены</a></div>
                            <div class="punkt"><a href="<?= Url::to(['/spec']); ?>">Акции</a></div>

                            <?php if (!Subdomains::getStatus()): ?>
                               <div class="punkt"><a href="<?= Url::to(['/gallery']); ?>">Портфолио</a></div>
                            <?php endif; ?>

                            <div class="punkt"><a href="<?= Url::to(['/vacancy']); ?>">Вакансии</a></div>
                            <div class="punkt"><a href="<?= Url::to(['/company']); ?>">О нас</a></div>
                            <div class="punkt modal-form-zaloba"><a href="#">Пожаловаться руководству</a></div>
                            <div class="punkt"><a href="<?= Url::to(['/contacts']); ?>">Контакты</a></div>
                            <?php //<div class="punkt punkt-phone"><a href="tel:74994441437">8 (499) 444-14-37</a></div> ?>

                            <div class="block1-btnwrap block1-btnwrap-underprice d-sm-none">
                                <div class="mbtn mbtnot modal-form-open" data-name="Записаться" data-type="diagnostic">Записаться</div>
                                <div class="mbtn mbtnot modal-form-open" data-name="Получить консультацию" data-type="consultation">Получить консультацию</div>
                                <div class="mbtn mbtnot modal-form-open" data-name="Заявка на эвакуатор" data-type="evacuator">Заявка на эвакуатор</div>
                            </div>

                            <a href="#" class="punkt punkt-phone mbtn mbtng modal-form-open" data-name="Заказать звонок" data-type="consultation">Заказать звонок</a>
                        </div>
                        <?= ContactsWidget::widget(['detailing' => isset($this->params['detailing'])]); ?>
                    </div>
                    <div class="col-xl-2 col-lg-3 col-md-3 col-7 header-phones">
                        <div class="header-center-schedule">Ежедневно с 08:00 до 22:00</div>
                        <div class="header-center-schedule mt-1 mt-sm-0" style="font-size: larger"><a href="tel:88003331298">8 (800) 333-12-98</a></div>
                        <?php //<a href="tel:74994441437" class="header-phones-phone"><span>8 (499) 444-14-37</span></a> ?>
                        <a href="#" class="mbtn mbtng modal-form-open" data-name="Заказать звонок" data-type="consultation" tabindex="0">Заказать звонок</a>
                        <div class="addr-open text-center"><span>Выбрать сервис</span></div>
                    </div>
                    <div class="col-md-1 col-sm-2 col-2  mobmenu-open"><img src="/img/icon/menubtn.svg" alt="*"></div>
                    <div class="menu-ten"></div>
                </div>
            </div>
        </div>
        <!--Конец Шапка -->

        <!--Плашка для жалобы-->
        <div class="d-none d-sm-block complaint-button" id="myShowBlock" data-type="complaint-new">
            <div class="complaint-button-wrapper">
                <a class="modal-form-zaloba" href="#" style="cursor: pointer; padding: 16px;">
                    <i class="fa fa-envelope fa-lg"></i>
                    Пожаловаться руководству
                </a>
            </div>
        </div>
        <!--Конец плашка для жалобы-->

        <?= Alert::widget() ?>
        <?= $content ?>
        <!--Подвал начало-->
        <div class="footer">
            <div class="container container2">
                <div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="footer-logo"><a href="<?= Yii::$app->homeUrl; ?>"><img src="<?php echo $imageLogoUrl; ?>" alt="RMS logo"></a></div>
                        <div class="footer-copyright">
                            &copy; <?= date('Y'); ?> Автосервис <?php echo $this->params['brandName'] ?? ''; ?> Раннинг Моторс - сеть специализированных сервисов по ремонт и обслуживанию <?php echo isset($this->params['modelNameRus']) ? $this->params['brandNameRus'] . ' ' . $this->params['modelNameRus'] : ''; ?> в Москве<br>
                        </div>
                        <div class="mt-2">
                            Данный интернет-ресурс (в том числе указанные цены на услуги) носит исключительно ознакомительный характер. И ни при каких условиях не является публичной офертой.
                        </div>
                    </div>
                    <?= FooterServicesWidget::widget(); ?>
                </div>
            </div>
        </div>
        <!--Конец Подвала -->

        <?= MangoWidget::widget(); ?>

        <?= ModalForm::block(['detailing' => isset($this->params['detailing'])]); ?>

        <script type="text/javascript">var __cs=__cs||[];__cs.push(["setCsAccount","1ovq5_22PNk11r3mdTITRF8GN1i6ssNt"]);</script>
        <script type="text/javascript" async src="https://app.comagic.ru/static/cs.min.js"></script>
        <?php $this->endBody(); ?>
        <script>
            var lazyLoadInstance = new LazyLoad({
                elements_selector: ".lazy"
            });
        </script>
    </body>
</html>
<?php $this->endPage(); ?>

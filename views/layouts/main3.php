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
?>
<?php $this->beginPage() ?>
<!doctype html>
<html lang="<?= Yii::$app->language; ?>">
    <head>
        <meta charset="<?= Yii::$app->charset; ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php $this->registerCsrfMetaTags(); ?>
        <title><?= Html::encode($this->title); ?></title>
        <?php Yii::$app->seo->canonicalMeta($this->params); ?>
        <?php /* Yii::$app->seo->ampMeta($this->params);*/ ?>
        
        <link rel="preload" href="/css/style.min.css.gz" as="style">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css" />
        
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
	<script type="application/ld+json">
		{
			"@context": "https://schema.org",
			"@type": "LocalBusiness",
			"name": "Раннинг Моторс",
			"image": "https://r-ms.ru/img/logo.png",
			"telephone": "+7(495)477-33-96",
			"email": "director@r-ms.ru",
			"address": {
				"@type": "PostalAddress",
				"addressLocality": "Москва",
				"streetAddress": "Научный проезд 14а с. 7",
				"addressCountry": "Россия"
			},
			"sameAs": ["https://vk.com/r_ms_company"],
			"openingHours": "Пн-Вс 09:00-21:00",
			"paymentAccepted": "Оплата наличными, картой, рассрочка",
			"priceRange": "1200-1600 нормочас",
			"url": "https://r-ms.ru/",
			"aggregateRating": {
				"@type": "AggregateRating",
				"ratingValue": "4,923",
				"bestRating": "5",
				"worstRating": "4",
				"ratingCount": "41"
			}
		}
	</script>
	<script type="application/ld+json">
		{
			"@context": "http://schema.org",
			"@type": "BreadcrumbList",
			"itemListElement": [{
					"@type": "ListItem",
					"position": 1,
					"item": {
						"@id": "https://r-ms.ru/",
						"name": "&#128293; Раннинг Моторс"
					}
				}			]
		}
	</script>
	<!-- SCHEMA END -->
        
        <!-- Yandex.Metrika counter -->
        <script>
            (function(d, w, c) {
                (w[c] = w[c] || []).push(function() {
                    try {
                        w.yaCounter38431175 = new Ya.Metrika({
                            id: 38431175,
                            clickmap: true,
                            trackLinks: true,
                            accurateTrackBounce: true,
                            webvisor: true,
                            trackHash: true,
                            ecommerce: "dataLayer"
                        });
                    } catch (e) {}
                });
                var n = d.getElementsByTagName("script")[0],
                    s = d.createElement("script"),
                    f = function() {
                        n.parentNode.insertBefore(s, n);
                    };
                s.type = "text/javascript";
                s.async = true;
                s.src = "https://mc.yandex.ru/metrika/watch.js";
                if (w.opera == "[object Opera]") {
                    d.addEventListener("DOMContentLoaded", f, false);
                } else {
                    f();
                }
            })(document, window, "yandex_metrika_callbacks");
        </script>
	<!-- /Yandex.Metrika counter -->
        
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
        <?php $this->beginBody(); ?>
        
        <!--Шапка начало-->
        <div class="header">
            <div class="container container2">
                <div class="row">
                    <div class="col-md-2 col-3 header-logo">
                        <a href="<?= Yii::$app->homeUrl; ?>">
                            <img src="/img/logo.png" alt="*">
                        </a>
                    </div>
                    <div class="col-lg-7 col-xl-8 col-md-9 col-sm-9 header-center">

                        <div class="header-center-menu accordion">
                            <div class="mobmenu-close-wrap">
                                <div class="mobmenu-close"><img  src="/img/icon/close-black.svg" alt="*"></div>
                            </div>
                            <div class="punkt vipbtn   accordion_item">

                                <span class="vipbtn-ssil title_block">Услуги</span>
                                <?= DropdownServicesWidget::widget(); ?>
                            </div>
                            <div class="punkt"><a href="<?= Url::to(['/pricelist']); ?>">Цены</a></div>
                            <div class="punkt"><a href="<?= Url::to(['/spec']); ?>">Акции</a></div>

                            <?php
                            if (Subdomains::getStatus() == false){  ?>
                                                       <div class="punkt"><a href="<?= Url::to(['/gallery']); ?>">Портфолио</a></div>
                            <?php } ?>

                            <div class="punkt"><a href="<?= Url::to(['/vacancy']); ?>">Вакансии</a></div>
                            <div class="punkt"><a href="<?= Url::to(['/company']); ?>">О нас</a></div>
                            <div class="punkt modal-form-zaloba"><a href="#">Пожаловаться руководству</a></div>
                            <div class="punkt"><a href="<?= Url::to(['/contacts']); ?>">Контакты</a></div>
                            <?php //<div class="punkt punkt-phone"><a href="tel:74994441437">8 (499) 444-14-37</a></div> ?>
                            <a href="#" class="punkt punkt-phone mbtn mbtng modal-form-open" data-name="Заказать звонок" data-type="consultation">Заказать звонок</a>
                        </div>
                        <?= ContactsWidget::widget(['detailing' => isset($this->params['detailing'])]); ?>
                    </div>
                    <div class="col-xl-2 col-lg-3 col-md-3 col-7 header-phones">
                        <div class="header-center-schedule">Время работы: с 08:00 до 22:00</div>
                        <div class="header-center-schedule">Ежедневно, без выходных.</div>
                        <?php //<a href="tel:74994441437" class="header-phones-phone"><span>8 (499) 444-14-37</span></a> ?>
                        <a href="#" class="mbtn mbtng modal-form-open" data-name="Заказать звонок" data-type="consultation" tabindex="0">Заказать звонок</a>
                        <div class="addr-open"><span>Выбрать сервис</span></div>
                    </div>
                    <div class="col-md-1 col-sm-2 col-2  mobmenu-open"><img src="/img/icon/menubtn.svg" alt="*"></div>
                    <div class="menu-ten"></div>
                </div>
            </div>
        </div>
        <!--Конец Шапка -->

        <!--Плашка для жалобы-->
<!--        <div class="complaint-button open_modal_claim mobile_hide" id="myShowBlock" data-type="complaint-new">-->
<!--            <div class="complaint-button-wrapper">-->
<!--                <a class="modal-form-zaloba" href="#" style="cursor: pointer; padding: 16px;">-->
<!--                    <i class="fa fa-envelope fa-lg"></i>-->
<!--                    Пожаловаться руководству-->
<!--                </a>-->
<!--            </div>-->
<!--        </div>-->
        <!--Конец плашка для жалобы-->
        
        <?= Alert::widget() ?>
        <?= $content ?>
        
        <!--Подвал начало-->
        <div class="footer">
            <div class="container container2">
                <div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="footer-logo"><a href="<?= Yii::$app->homeUrl; ?>"><img src="/img/logo.png" alt="*"></a></div>
                        <div class="solo-punkt"><a href="/vacancy/">Вакансии</a></div>
                        <div class="footer-copyright">
                            © <?= date('Y'); ?> Автосервис RMS. <br>
                            Все права защищены.
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
<?php

/**
 * @var string $url
 * @var string $imageSrc
 * @var string $header
 * @var int    $hide_url_price_list
 */

$imageAlt = explode('/', $imageSrc);
$imageAlt = array_filter($imageAlt);
$imageAlt = implode(' ', $imageAlt);
?>
<div class="remontblock block">
    <div class="container container2">
        <h2 class="zag"><?= $header; ?></h2>
        <div class="row myrow">
            <div class="remontblock-img col-xl-3 ">
                <img class="lazy" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="/uploads/images/cars/<?= $imageSrc; ?>/big.png" alt="<?php echo $imageAlt; ?>">
                <a href="#" class="mbtn mbtng modal-form-open" data-name="Запись на ремонт / ТО" data-type="repaire">Записаться в автосервис</a>
            </div>
            <div class="col-xl-3 col-lg-4  remontblock-swrap remontblock-swrap-b1">
                <a href="<?= $url; ?>/tehnicheskoe_obsluzhivanie/" class="beto">Техническое обслуживание</a>
                <a href="<?= $url; ?>/remont_transmissii/" class="betransmissia">Ремонт трансмиссии</a>
                <a href="<?= $url; ?>/remont_dvigatelia/" class="bedvigatel">Ремонт двигателя</a>
                <a href="<?= $url; ?>/remont_elektrooborudovaniia/" class="beacum">Ремонт электрооборудования</a>
                <a href="<?= $url; ?>/remont_rulevogo_upravleniia/" class="berul">Ремонт рулевого управления</a>
                <a href="<?= $url; ?>/moika_himchistka_polirovka_avtomobilia/" class="bepolirovka">Мойка, химчистка, полировка</a>
                <a href="<?= $url; ?>/remont_kondicionera/" class="becondicioner d-none d-sm-block">Ремонт автокондионеров</a>
                <a href="<?= $url; ?>/remont_sistemy_ohlazhdeniia/" class="besysohl d-none d-sm-block">Ремонт ситемы охлаждения</a>
                <?php if ($hide_url_price_list > 0): ?>
                    <a href="<?= $url; ?>/shinomontazh/" class="bemontag d-none d-sm-block">Услуги по шиномонтажу</a>
                    <a href="<?= $url; ?>/zapchasti/" class="bezapchasty d-none d-sm-block">Запчасти</a>
                <?php endif; ?>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 remontblock-swrap remontblock-swrap-b2">
                <a href="<?= $url; ?>/diagnostika_avtomobilia/" class="bediagnostika d-none d-sm-block">Диагностика</a>
                <a href="<?= $url; ?>/remont_akpp/" class="beacpp d-none d-sm-block">Ремонт АКПП</a>
                <a href="<?= $url; ?>/kuzovnoi_remont/" class="bekuzov d-none d-sm-block">Кузовной ремонт</a>
                <a href="<?= $url; ?>/remont_hodovoi_chasti_podveski_avtomobilia/" class="behodovoi d-none d-sm-block">Ремонт ходовой</a>
                <a href="<?= $url; ?>/remont_tormoznoi_sistemy/" class="betormoz d-none d-sm-block">Ремонт торомозной системы</a>
                <a href="<?= $url; ?>/pokraska_avtomobilia/" class="bepokraska d-none d-sm-block">Покраска автомобиля</a>
                <a href="<?= $url; ?>/remont_toplivnoi__sistemy/" class="bebak d-none d-sm-block">Ремонт топливной системы</a>
                <a href="<?= $url; ?>/remont_vyhlopnoi__sistemy/" class="bevihlop d-none d-sm-block">Ремонт выхлопной системы</a>
                <a href="<?= $url; ?>/argonnaia_svarka/" class="bewelding d-none d-sm-block">Аргонная сварка авто</a>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 remontblock-swrap remontblock-swrap-b3">
                <a href="#" class="bephoto modal-form-open" data-name="Оценить стоимость ремонта по фото" data-type="photo">Оценить стоимость ремонта по фото</a>
                <a href="#" class="becalc modal-form-open" data-name="Рассчитать стоимость работы" data-type="calculate">Рассчитать стоимость работы</a>
                <a href="#" class="bezapchastyrd modal-form-open" data-name="Заказать запчасти" data-type="zapchast">Заказать запчасти</a>
                <a href="#" class="bediagnost modal-form-open" data-name="Записаться на диагностику" data-type="diagnostic">Записаться на диагностику</a>
                <a href="#" class="becons modal-form-open" data-name="Получить консультацию" data-type="consultation">Получить консультацию</a>
                <a href="#" class="becons modal-form-zaloba" data-name="ОСТАВИТЬ ЖАЛОБУ" data-type="consultation">Оставить жалобу</a>
            </div>
        </div>
    </div>
    <div class="text-center d-sm-none">
        <div class="remontblock-btn mbtn mbtn2 mbtn2g"></div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        let remontblockBtn = $('.remontblock .remontblock-btn');

        remontblockBtn.click(function (event) {
            $('.remontblock-swrap a.d-none').toggleClass('d-none').slideDown(500);
            remontblockBtn.slideToggle(100);
        });
    });
</script>
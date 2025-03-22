<?php

/** @var bool $detailing */
/** @var int $mdSize */
/** @var int $lgSize */
/** @var string $items */
/** @var string $header */

?>
<div class="block cartablock">
    <?php if ($_SERVER['REQUEST_URI'] == "/ng_text/"): ?>
        <div style="max-width: 310px;margin: 0 auto;">
            <p><strong>График работы:</strong> Ежедневно с 8:00 до 22:00</p>
            <p><strong>График работы в новогодние праздники:</strong></p>
            <ul>
                <li>31 декабря до последнего клиента;</li>
                <li>1 января выходной, 2 января рабочий день.</li>
            </ul>
        </div>
    <?php endif; ?>
    <div class="container d-block">
        <h2 class="zag"><?= $header; ?></h2>
        <div class="d-flex justify-content-around flex-wrap">
            <?= $items; ?>
        </div>
    </div>
    <div class="cartablock-carta">
        <div class="ymap-container">
            <div class="loader loader-default"></div>
            <div id="map-yandex" data-detailing="<?= $detailing ?>"></div>
        </div>
    </div>
</div>

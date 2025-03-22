<?php

/**
 * @var string $itemsSlider
 * @var string $itemsPanel
 * @var string $header
 */
?>
<?php if (!empty($itemsSlider)): ?>
    <div class="block markiblock">
        <div class="container">
            <h2 class="zag"><?= $header; ?></h2>
            <div class="markiblock-slider">
                <?= $itemsSlider; ?>
            </div>
            <div class="markiblock-spis">
                <div class="row">
                    <?= $itemsPanel; ?>
                </div>
            </div>
            <div class="btn-wrap">
                <div class="markiblock-btn mbtn mbtn2">
                    <span class="markiblock-btn-s1">Показать все</span>
                    <span class="markiblock-btn-s2">Скрыть все</span>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
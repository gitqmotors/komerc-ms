<?php

use app\models\Models;

/**
 * @var Models $item
 * @var array  $params
 */
?>
<div class="col-lg-2 col-sm-3 col-6">
    <a href="/<?= $item->url; ?>/" class="markiblock-card">
        <span class="markiblock-card-img"><img class="lazy" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo $params['imageUrl']; ?>" alt="<?= $item->name; ?>"></span>
        <span class="markiblock-card-zag"><?php echo $item->brand->name; ?> <?= $item->name; ?></span>
    </a>
</div>
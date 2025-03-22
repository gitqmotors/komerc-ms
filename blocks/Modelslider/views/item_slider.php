<?php

use app\models\Models;

/**
 * @var Models $item
 * @var array  $params
 */
?>
<a href="/<?= $item->url; ?>/" class="markiblock-card">
    <span class="markiblock-card-img"><img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-lazy="<?php echo $params['imageUrl']; ?>" alt="<?= $item->name; ?>"></span>
    <span class="markiblock-card-zag"><?php echo $item->brand->name; ?> <?= $item->name; ?></span>
</a>
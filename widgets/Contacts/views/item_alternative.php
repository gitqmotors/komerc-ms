<?php

?>

<div class="header-center-addrw-text" <?php if($item->name == 'Калужская'):?> style="order: 4" <?php endif;?>>
    <div class="header-center-addrw-close"></div>
    <div class="header-center-addrw-text-zag"><?= $item->name; ?></div>
    <span><?= $item->address; ?></span>
    <?php if($item->name == 'Дмитровка'):?>
    <a href="tel:+74995048895">+7 (499) 504-88-95</a>
    <?php endif;?>
</div>

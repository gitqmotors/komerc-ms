<?php

use yii\helpers\Url;

?>
<?php if(Yii::$app->controller->id === 'brands' or Yii::$app->controller->id === 'model'):?>
    <meta property="og:type" content="website">
    <meta property="og:image" content="<?= Url::base(true); ?>/img/logo.png">
    <meta property="og:keywords" content="<?= $seo['keywords']; ?>">
    <meta property="og:url" content="<?= Url::base(true); ?><?= Yii::$app->request->url; ?>">
<?php else:?>
    <meta property="og:type" content="website">
    <meta property="og:image" content="<?= Url::base(true); ?>/img/logo.png">
    <meta property="og:title" content="<?= $seo['title']; ?>">
    <meta property="og:keywords" content="<?= $seo['keywords']; ?>">
    <meta property="og:description" content="<?= $seo['description']; ?>">
    <meta property="og:url" content="<?= Url::base(true); ?><?= Yii::$app->request->url; ?>">
<?php endif; ?>

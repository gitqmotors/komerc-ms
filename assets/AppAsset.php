<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    
    public $baseUrl = '@web';
    
    public $css = [
        'css/style.min.css',
        'css/libs/jquery.fancybox.min.css',
        'css/custom.css',
        'css/seofilter.css',
    ];
    
    public $js = [
        'js/main.min.js',
        'js/custom.js',
    ];
    
    public $depends = [
        //'yii\web\YiiAsset',
        //'yii\web\JqueryAsset',
    ];
}

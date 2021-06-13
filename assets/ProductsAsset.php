<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Class ProductsAsset
 * @package app\assets
 */
class ProductsAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $js = [
        'js/products.js'
    ];

    public $depends = [
        AppAsset::class
    ];
}
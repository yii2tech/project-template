<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Frontend main asset.
 *
 * @package app\assets
 */
class BackendAsset extends AssetBundle
{
    /**
     * {@inheritdoc}
     */
    public $basePath = '@webroot';
    /**
     * {@inheritdoc}
     */
    public $baseUrl = '@web';
    /**
     * {@inheritdoc}
     */
    public $css = [
        'css/backend/main.css',
    ];
    /**
     * {@inheritdoc}
     */
    public $js = [
    ];
    /**
     * {@inheritdoc}
     */
    public $depends = [
        \yii\web\YiiAsset::class,
        \yii\bootstrap\BootstrapAsset::class,
    ];
}
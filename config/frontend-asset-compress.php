<?php
/**
 * Configuration file for the "yii asset" console command.
 * This file should be used for "frontend" assets compression.
 */

// In the console environment, some path aliases may not exist. Please define these:
Yii::setAlias('@webroot', __DIR__ . '/../web');
Yii::setAlias('@web', Yii::$app->getUrlManager()->getBaseUrl());

// Asset Manager :
$webConfig = require __DIR__ . '/web.php';
$assetManager = array_merge(
    $webConfig['components']['assetManager'],
    [
        'basePath' => '@webroot/assets',
        'baseUrl' => '@web/assets',
    ]
);

// JS Compressor :
// @see https://developers.google.com/closure/compiler/
if (file_exists(dirname(__DIR__) . '/compiler.jar')) {
    $jsCompressor = 'java -jar ' . escapeshellarg(dirname(__DIR__) . '/compiler.jar') . ' --warning_level QUIET --js {from} --js_output_file {to}';
} else {
    $jsCompressor = 'cp {from} {to}';
}

// CSS Compressor :
// @see https://github.com/yui/yuicompressor/releases
if (file_exists(dirname(__DIR__) . '/yuicompressor.jar')) {
    $cssCompressor = 'java -jar ' . escapeshellarg(dirname(__DIR__) . '/yuicompressor.jar') . ' --type css {from} -o {to}';
} else {
    $cssCompressor = 'cp {from} {to}';
}

return [
    // Adjust command/callback for JavaScript files compressing:
    'jsCompressor' => $jsCompressor,
    // Adjust command/callback for CSS files compressing:
    'cssCompressor' => $cssCompressor,
    // Whether to delete asset source after compression:
    'deleteSource' => false,
    // The list of asset bundles to compress:
    'bundles' => [
        // base :
        yii\web\YiiAsset::class,
        yii\web\JqueryAsset::class,
        yii\validators\ValidationAsset::class,
        // application :
        app\assets\FrontendAsset::class,
        // widgets :
        yii\widgets\ActiveFormAsset::class,
        //yii\grid\GridViewAsset::class,
    ],
    // Asset bundle for compression output:
    'targets' => [
        'all' => [
            'class' => yii\web\AssetBundle::class,
            'basePath' => '@webroot/assets',
            'baseUrl' => '@web/assets',
            'js' => 'all-{hash}.js',
            'css' => 'all-{hash}.css',
        ],
    ],
    // Asset manager configuration:
    'assetManager' => $assetManager,
];
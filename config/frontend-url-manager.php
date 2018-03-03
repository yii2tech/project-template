<?php
/**
 * Configuration file for the "frontend" URL manager
 */

return [
    '__class' => yii\web\UrlManager::class,
    'baseUrl' => isset($baseUrl) ? $baseUrl : null,
    'hostInfo' => isset($hostInfo) ? $hostInfo : null,
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'rules' => [
        '/' => 'site/index',
        '<action:about|howitworks>' => 'site/<action>',
        '<action:login|logout|request-password-reset|reset-password>' => 'auth/<action>',
        '<controller:[\w-]+>' => '<controller>/index',
        '<controller:[\w-]+>/<action:[\w-]+>/<id:\d+>' => '<controller>/<action>',
        'robots.txt' => 'site/robots',
    ],
];
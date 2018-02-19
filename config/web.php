<?php
/**
 * Configuration file for the web applications
 */

return yii\helpers\ArrayHelper::merge(
    require __DIR__ . '/main.php',
    [
        'components' => [
            'request' => [
                'enableCookieValidation' => false,
                // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
                'cookieValidationKey' => '',
            ],
            'assetManager' => [
                'appendTimestamp' => true,
            ],
            'session' => [
                'class' => yii\web\Session::class
            ],
            'user' => [
                'as authLog' => [
                    'class' => yii2tech\authlog\AuthLogWebUserBehavior::class
                ],
            ],
            'errorHandler' => [
                'errorAction' => 'site/error',
            ],
        ],
    ]
);
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
                '__class' => yii\web\Session::class
            ],
            'user' => [
                'as authLog' => [
                    '__class' => yii2tech\authlog\AuthLogWebUserBehavior::class
                ],
            ],
            'errorHandler' => [
                'errorAction' => 'site/error',
            ],
        ],
    ]
);
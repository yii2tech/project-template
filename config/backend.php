<?php
/**
 * Configuration file for the "backend" (web/admin.php) web application
 */

return yii\helpers\ArrayHelper::merge(
    require __DIR__ . '/web.php',
    [
        'controllerNamespace' => 'app\controllers\backend',
        'viewPath' => '@app/views/backend',
        'components' => [
            'session' => [
                'name' => 'MyProjectAdminSession'
            ],
            'user' => [
                'identityClass' => app\models\db\Admin::class,
                'idParam' => '__adminId',
                'identityCookie' => ['name' => 'MyProjectAdminIdentity', 'httpOnly' => true],
                'enableAutoLogin' => false,
            ],
            'assetManager' => [
                'bundles' => file_exists(__DIR__ . '/backend-assets.php') ? require __DIR__ . '/backend-assets.php' : []
            ],
            'urlManager' => require __DIR__ . '/backend-url-manager.php',
            'frontendUrlManager' => require __DIR__ . '/frontend-url-manager.php',
        ],
    ]
);
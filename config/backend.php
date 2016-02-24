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
                'identityClass' => 'app\models\db\Admin',
                'idParam' => '__adminId',
                'enableAutoLogin' => false,
            ],
            'urlManager' => require __DIR__ . '/backend-url-manager.php',
            'frontendUrlManager' => require __DIR__ . '/frontend-url-manager.php',
        ],
    ]
);
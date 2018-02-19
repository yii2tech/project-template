<?php
/**
 * Configuration file for the console application.
 */

Yii::setAlias('@tests', dirname(__DIR__) . '/tests');

return yii\helpers\ArrayHelper::merge(
    require __DIR__ . '/main.php',
    [
        'controllerNamespace' => 'app\controllers\console',
        'controllerMap' => [
            'migrate' => [
                'class' => yii\console\controllers\MigrateController::class,
                'migrationNamespaces' => [
                    'app\migrations',
                ],
                'migrationPath' => null,
            ],
            'self-update' => [
                'class' => yii2tech\selfupdate\SelfUpdateController::class,
                'configFile' => '@app/config/self-update.php',
            ],
        ],
        'components' => [
            'urlManager' => require __DIR__ . '/frontend-url-manager.php',
            'backendUrlManager' => require __DIR__ . '/backend-url-manager.php',
        ],
    ]
);

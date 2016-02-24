<?php
/**
 * Configuration file for the console application.
 */

Yii::setAlias('@tests', dirname(__DIR__) . '/tests');

return yii\helpers\ArrayHelper::merge(
    require __DIR__ . '/main.php',
    [
        'bootstrap' => ['gii'],
        'controllerNamespace' => 'app\controllers\console',
        'controllerMap' => [
            'self-update' => [
                'class' => 'yii2tech\selfupdate\SelfUpdateController',
                'configFile' => '@app/config/self-update.php',
            ],
        ],
        'modules' => [
            'gii' => [
                'class' => 'yii\gii\Module',
            ],
        ],
    ]
);

<?php
/**
 * Application configuration for console unit tests
 */
return yii\helpers\ArrayHelper::merge(
    require(__DIR__ . '/../../../../config/console.php'),
    require(dirname(__DIR__) . '/config.php'),
    //require(dirname(__DIR__) . '/config-local.php'),
    require(dirname(__DIR__) . '/unit.php'),
    [
    ]
);

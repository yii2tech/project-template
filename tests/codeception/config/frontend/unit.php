<?php
/**
 * Application configuration for frontend unit tests
 */
return yii\helpers\ArrayHelper::merge(
    require(__DIR__ . '/../../../../config/frontend-test.php'),
    require(dirname(__DIR__) . '/config.php'),
    require(dirname(__DIR__) . '/unit.php'),
    require(__DIR__ . '/config.php'),
    [

    ]
);
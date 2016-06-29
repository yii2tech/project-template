<?php

/**
 * Application configuration for backend unit tests
 */
return yii\helpers\ArrayHelper::merge(
    require(__DIR__ . '/../../../../config/backend-test.php'),
    require(dirname(__DIR__) . '/config.php'),
    require(dirname(__DIR__) . '/unit.php'),
    require(__DIR__ . '/config.php'),
    [

    ]
);

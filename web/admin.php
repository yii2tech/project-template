<?php

$localConfig = require(__DIR__ . '/../config/local.php');

require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');

$config = require(__DIR__ . '/../config/backend.php');

(new yii\web\Application($config))->run();

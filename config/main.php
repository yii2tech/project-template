<?php
/**
 * Main configuration file
 */

return yii\helpers\ArrayHelper::merge(
    [
        'id' => 'my-project',
        'name' => 'MyProject',
        'basePath' => dirname(__DIR__),
        'bootstrap' => ['log'],
        'components' => [
            'cache' => [
                'class' => 'yii\caching\FileCache',
                'keyPrefix' => sha1(__FILE__),
            ],
            'mailer' => [
                'class' => 'yii\swiftmailer\Mailer',
            ],
            'log' => [
                'traceLevel' => YII_DEBUG ? 3 : 0,
                'targets' => [
                    [
                        'class' => 'yii\log\FileTarget',
                        'levels' => ['error', 'warning'],
                    ],
                ],
            ],
            'mutex' => [
                'class' => 'yii\mutex\FileMutex'
            ],
            'db' => [
                'class' => 'yii\db\Connection',
                'dsn' => 'mysql:host=localhost;dbname=myproject',
                'username' => 'root',
                'password' => '',
                'charset' => 'utf8',
                'enableSchemaCache' => YII_ENV !== 'dev',
            ],
            'filedb' => [
                'class' => 'yii2tech\filedb\Connection',
                'path' => '@app/models/filedb/data',
            ],
            'i18n' => [
                'translations' => [
                    'yii2tech-admin' => [
                        'class' => 'yii\i18n\PhpMessageSource',
                        'basePath' => '@yii2tech/admin/messages',
                    ],
                    '*' => [
                        'class' => 'yii\i18n\PhpMessageSource',
                        'forceTranslation' => true,
                    ],
                ],
            ],
        ],
        'params' => require(__DIR__ . '/params.php'),
    ],
    isset($localConfig) ? $localConfig : require(__DIR__ . '/local.php')
);
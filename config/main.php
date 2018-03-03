<?php
/**
 * Main configuration file
 */

return yii\helpers\ArrayHelper::merge(
    [
        'id' => 'my-project',
        'name' => 'MyProject',
        'basePath' => dirname(__DIR__),
        'bootstrap' => [
            'configManager',
        ],
        'aliases' => [
            '@bower' => '@vendor/bower-asset',
            '@npm' => '@vendor/npm-asset',
        ],
        'logger' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    '__class' => yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'components' => [
            'cache' => [
                '__class' => yii\caching\Cache::class,
                'handler' => [
                    '__class' => yii\caching\FileCache::class,
                    'keyPrefix' => sha1(__FILE__),
                ],
            ],
            'mailer' => [
                '__class' => yii\swiftmailer\Mailer::class,
            ],
            'mutex' => [
                '__class' => yii\mutex\FileMutex::class
            ],
            'db' => [
                '__class' => yii\db\Connection::class,
                'dsn' => 'mysql:host=localhost;dbname=myproject',
                'username' => 'root',
                'password' => '',
                'charset' => 'utf8',
                'enableSchemaCache' => YII_ENV !== 'dev',
            ],
            'filedb' => [
                '__class' => yii2tech\filedb\Connection::class,
                'path' => '@app/models/filedb/data',
            ],
            'configManager' => [
                '__class' => yii2tech\config\Manager::class,
                'storage' => [
                    '__class' => yii2tech\config\StorageDb::class,
                    'table' => 'AppConfig',
                ],
                'items' => [
                    'appName' => [
                        'path' => 'name',
                        'label' => 'Application Name',
                        'rules' => [
                            ['required']
                        ],
                    ],
                    'appEmail' => [
                        //'path' => 'params.appEmail',
                        'label' => 'Application Email',
                        'rules' => [
                            ['required'],
                            ['email'],
                        ],
                    ],
                ],
            ],
            'i18n' => [
                'translations' => [
                    'yii2tech-admin' => [
                        '__class' => yii\i18n\PhpMessageSource::class,
                        'basePath' => '@yii2tech/admin/messages',
                    ],
                    '*' => [
                        '__class' => yii\i18n\PhpMessageSource::class,
                        //'forceTranslation' => true,
                    ],
                ],
            ],
        ],
        'params' => require(__DIR__ . '/params.php'),
    ],
    isset($localConfig) ? $localConfig : require(__DIR__ . '/local.php')
);
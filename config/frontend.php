<?php
/**
 * Configuration file for the "frontend" (web/index.php) web application
 */

return yii\helpers\ArrayHelper::merge(
    require __DIR__ . '/web.php',
    [
        'controllerNamespace' => 'app\controllers\frontend',
        'viewPath' => '@app/views/frontend',
        'components' => [
            'session' => [
                'name' => 'MyProjectSession'
            ],
            'user' => [
                'identityClass' => app\models\db\User::class,
                'loginUrl' => ['auth/login'],
                'identityCookie' => ['name' => 'MyProjectIdentity', 'httpOnly' => true],
                'enableAutoLogin' => true,
            ],
            'assetManager' => [
                'bundles' => file_exists(__DIR__ . '/frontend-assets.php') ? require __DIR__ . '/frontend-assets.php' : []
            ],
            'urlManager' => require __DIR__ . '/frontend-url-manager.php',
            'backendUrlManager' => function() {
                /* @var $urlManager yii\web\UrlManager */
                $urlManager = Yii::createObject(require __DIR__ . '/backend-url-manager.php');
                $urlManager->setScriptUrl(str_replace('index.php', 'admin.php', $urlManager->getScriptUrl()));
                return $urlManager;
            },
        ],
    ]
);
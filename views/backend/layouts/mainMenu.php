<?php
/* @var $this \yii\web\View */

use yii2tech\admin\widgets\Nav;
use yii\bootstrap\NavBar;

$webUser = Yii::$app->user;

NavBar::begin([
    'id' => 'header-nav-bar',
    'brandLabel' => Yii::$app->name,
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => 'navbar-inverse navbar-fixed-top',
    ],
    'innerContainerOptions' => [
        'class' => 'container-fluid'
    ],
]);

if (!$webUser->isGuest) {
    echo Nav::widget([
        'id' => 'header-main-menu',
        'options' => ['class' => 'navbar-nav'],
        'items' => [
            [
                'label' => Yii::t('admin', 'Users'),
                'icon' => 'user',
                'items' => [
                    [
                        'label' => Yii::t('admin', 'Users'),
                        'icon' => 'user',
                        'url' => ['/user/index'],
                    ],
                    [
                        'label' => Yii::t('admin', 'Administrators'),
                        'icon' => 'user',
                        'url' => ['/admin/index'],
                    ],
                ],
            ],
            [
                'label' => Yii::t('admin', 'Logs'),
                'icon' => 'list',
                'items' => [
                    [
                        'label' => Yii::t('admin', 'User Auth Logs'),
                        'icon' => 'user',
                        'url' => ['/user-auth-log/index'],
                    ],
                    [
                        'label' => Yii::t('admin', 'Administrator Auth Logs'),
                        'icon' => 'user',
                        'url' => ['/admin-auth-log/index'],
                    ],
                ],
            ],
        ],
    ]);
}

$menuItems = [
    ['label' => Yii::t('yii', 'Home'), 'url' => Yii::$app->request->getBaseUrl() . '/', 'icon' => 'home'],
];
if ($webUser->isGuest) {
    $menuItems[] = ['label' => Yii::t('admin', 'Login'), 'url' => ['/site/login'], 'icon' => 'log-in'];
} else {
    $menuItems[] = [
        'label' => $webUser->identity->username,
        'items' => [
            [
                'label' => Yii::t('admin', 'Profile'),
                'url' => ['/admin/update', 'id' => $webUser->id],
                'icon' => 'pencil'
            ],
            [
                'label' => Yii::t('admin', 'Logout'),
                'url' => ['/site/logout'],
                'linkOptions' => ['data-method' => 'post'],
                'icon' => 'log-out',
            ],
        ],

    ];
}
echo Nav::widget([
    'id' => 'header-common-menu',
    'options' => ['class' => 'navbar-nav navbar-right'],
    'items' => $menuItems,
]);
NavBar::end();
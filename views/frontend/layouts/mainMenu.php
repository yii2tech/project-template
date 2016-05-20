<?php

use yii\bootstrap\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;

/* @var $this \yii\web\View */

$webUser = Yii::$app->user;

NavBar::begin([
    'id' => 'header',
    'brandLabel' => Yii::$app->name,
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => 'navbar-inverse navbar-fixed-top',
    ],
]);

$menuItems = [
    ['label' => Yii::t('menu', 'About'), 'url' => ['/site/about']],
    ['label' => Yii::t('menu', 'F.A.Q.'), 'url' => ['/help/faq']],
    ['label' => Yii::t('menu', 'Contact'), 'url' => ['/help/contact']],
];
if ($webUser->isGuest) {
    $menuItems[] = ['label' => Yii::t('menu', 'Signup'), 'url' => ['/signup/index']];
    $menuItems[] = ['label' => Yii::t('menu', 'Login'), 'url' => ['/auth/login']];
} else {
    $menuItems[] = ['label' => Yii::t('menu', 'Account'), 'url' => ['/account/index']];
    $menuItems[] = '<li>'
        . Html::beginForm(['/auth/logout'], 'post')
        . Html::submitButton(
            'Logout (' . $webUser->identity->username . ')',
            ['class' => 'btn btn-link']
        )
        . Html::endForm()
        . '</li>';
}

echo Nav::widget([
    'id' => 'header-menu',
    'options' => ['class' => 'navbar-nav navbar-right'],
    'items' => $menuItems,
]);
NavBar::end();
?>
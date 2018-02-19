<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user app\models\db\User */
/* @var $urlManager yii\web\UrlManager */

$urlManager = Yii::$app->has('frontendUrlManager') ? Yii::$app->get('frontendUrlManager') : Yii::$app->urlManager;

$contactLink = $urlManager->createAbsoluteUrl(['/help/contact']);
?>
<div>
    <p><?= Yii::t('common', 'Hello {name}', ['name' => Html::encode($user->username)]) ?></p>
    <p><?= Yii::t('auth', 'Your account at {appName} has been suspended', ['appName' => Yii::$app->name]) ?></p>

    <p><?= Yii::t('auth', 'Your account credentials:') ?></p>
    <p><?= $user->getAttributeLabel('id') ?>: <?= $user->id ?></p>
    <p><?= $user->getAttributeLabel('username') ?>: <?= $user->username ?></p>

    <p><?= Yii::t('auth', 'Please contact {appName} administrator for account reactivation:') ?></p>
    <p><?= Html::a(Html::encode($contactLink), $contactLink) ?></p>
</div>
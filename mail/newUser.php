<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user app\models\db\User */
/* @var $urlManager yii\web\UrlManager */

$urlManager = Yii::$app->has('frontendUrlManager') ? Yii::$app->get('frontendUrlManager') : Yii::$app->urlManager;

$loginLink = $urlManager->createAbsoluteUrl(['/auth/login']);
?>
<div>
    <p><?= Yii::t('common', 'Hello {name}', ['name' => Html::encode($user->username)]) ?></p>
    <p><?= Yii::t('user', 'Your account at {appName} has been created', ['appName' => Yii::$app->name]) ?></p>

    <p><?= Yii::t('user', 'Your account credentials:') ?></p>
    <p><?= $user->getAttributeLabel('username') ?>: <?= $user->username ?></p>
    <p><?= $user->getAttributeLabel('password') ?>: <?= $user->password ?></p>

    <p><?= Yii::t('user', 'Follow the link below to log in {appName}:', ['appName' => Yii::$app->name]) ?></p>

    <p><?= Html::a(Html::encode($loginLink), $loginLink) ?></p>
</div>
<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user app\models\db\User */
/* @var $urlManager yii\web\UrlManager */

$urlManager = Yii::$app->has('frontendUrlManager') ? Yii::$app->get('frontendUrlManager') : Yii::$app->urlManager;

$resetLink = $urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->passwordResetToken]);
?>
<div class="password-reset">
    <p><?= Yii::t('common', 'Hello {name}', ['name' => Html::encode($user->username)]) ?></p>

    <p><?= Yii::t('user', 'Follow the link below to reset your password:') ?></p>

    <p><?= Html::a(Html::encode($resetLink), $resetLink) ?></p>
</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $admin app\models\db\Admin */
/* @var $urlManager yii\web\UrlManager */

$urlManager = Yii::$app->has('backendUrlManager') ? Yii::$app->get('backendUrlManager') : Yii::$app->urlManager;

$adminDashboardLink = $urlManager->createAbsoluteUrl(['/site/index']);
?>
<div>
    <p><?= Yii::t('common', 'Hello {name}', ['name' => Html::encode($admin->username)]) ?></p>
    <p><?= Yii::t('admin', 'Your administration account at {appName} has been created', ['appName' => Yii::$app->name]) ?></p>

    <p><?= Yii::t('admin', 'Your account credentials:') ?></p>
    <p><?= $admin->getAttributeLabel('username') ?>: <?= $admin->username ?></p>
    <p><?= $admin->getAttributeLabel('password') ?>: <?= $admin->password ?></p>

    <p><?= Yii::t('admin', 'Follow the link below to access {appName} administration panel:', ['appName' => Yii::$app->name]) ?></p>

    <p><?= Html::a(Html::encode($adminDashboardLink), $adminDashboardLink) ?></p>
</div>
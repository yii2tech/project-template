<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $admin app\models\db\Admin */
?>
<div>
    <p><?= Yii::t('common', 'Hello {name}', ['name' => Html::encode($admin->username)]) ?></p>
    <p><?= Yii::t('admin', 'Your administration account at {appName} has been suspended', ['appName' => Yii::$app->name]) ?></p>

    <p><?= Yii::t('admin', 'Your account credentials:') ?></p>
    <p><?= $admin->getAttributeLabel('id') ?>: <?= $admin->id ?></p>
    <p><?= $admin->getAttributeLabel('username') ?>: <?= Html::encode($admin->username) ?></p>

    <p><?= Yii::t('admin', 'Please contact to another {appName} administrator for account reactivation.', ['appName' => Yii::$app->name]) ?></p>
</div>
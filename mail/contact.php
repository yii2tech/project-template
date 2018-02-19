<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $form app\models\frontend\ContactForm */

$formatter = Yii::$app->formatter;
?>
<div>
    <p><?= Yii::t('help', 'There is new contact inquiry at {appName}', ['appName' => Yii::$app->name]) ?></p>

    <p><?= Yii::t('common', 'Name') ?>: <?= Html::encode($form->name) ?></p>
    <p><?= Yii::t('common', 'Email') ?>: <?= $formatter->asEmail($form->email) ?></p>
    <p><?= Yii::t('common', 'Subject') ?>: <?= Html::encode($form->subject) ?></p>
    <p><?= Yii::t('common', 'Body') ?>: <?= $formatter->asNtext($form->body) ?></p>
</div>
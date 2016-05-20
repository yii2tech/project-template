<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\db\User */

$this->title = Yii::t('user', 'Dashboard of {appName}', ['appName' => Yii::$app->name]);
$this->params['breadcrumbs'][] = Yii::t('user', 'Dashboard');
?>
<div class="account-index">

    <div class="jumbotron">
        <h1><?= Yii::t('user', 'Dashboard') ?></h1>

        <p class="lead">Welcome to your account.</p>
    </div>

    <div class="body-content">

        <p>This is a logged in user dashboard</p>

    </div>
</div>
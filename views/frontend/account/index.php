<?php

/* @var $this yii\web\View */
use yii\helpers\Html;

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

        <div class="row">
            <div class="col-lg-4">
                <h2>Edit Profile</h2>

                <p>Edit your profile.</p>

                <p><?= Html::a('Edit Profile', ['profile'], ['class' => 'btn btn-default']) ?></p>
            </div>
            <div class="col-lg-4">
                <h2>Change Password</h2>

                <p>Change your password.</p>

                <p><?= Html::a('Change Password', ['password'], ['class' => 'btn btn-default']) ?></p>
            </div>
        </div>

    </div>
</div>
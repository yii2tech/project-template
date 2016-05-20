<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\frontend\LoginForm */

use yii\captcha\Captcha;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('auth', 'Log in {appName}', ['appName' => Yii::$app->name]);
$this->params['breadcrumbs'][] = Yii::t('auth', 'Login');
?>
<div class="auth-login">
    <h1><?= Yii::t('auth', 'Login') ?></h1>

    <p><?= Yii::t('auth', 'Please fill out the following fields to login:') ?></p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'password')->passwordInput() ?>

            <?php if (Yii::$app->user->enableAutoLogin) : ?>
                <?= $form->field($model, 'rememberMe')->checkbox() ?>
            <?php endif; ?>

            <?php if ($model->isVerifyRobotRequired) : ?>
                <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                    'template' => '{image}{input}',
                ]) ?>
            <?php endif; ?>

            <div style="color:#999;margin:1em 0">
                <?= Html::a(Yii::t('auth', 'Reset Password'), ['/auth/request-password-reset']) ?>
            </div>

            <div class="form-group">
                <?= Html::submitButton(Yii::t('auth', 'Login'), ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
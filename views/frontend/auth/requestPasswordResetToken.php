<?php
/**
 * @see \app\controllers\frontend\AuthController::actionRequestPasswordReset()
 */

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\frontend\PasswordResetRequestForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('auth', '{appName} - Request password reset', ['appName' => Yii::$app->name]);
$this->params['breadcrumbs'][] = Yii::t('auth', 'Request password reset');
?>
<div class="auth-request-password-reset">
    <h1><?= Yii::t('auth', 'Request password reset') ?></h1>

    <p><?= Yii::t('auth', 'Please fill out your email. A link to reset password will be sent there.') ?></p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>

            <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

            <div class="form-group">
                <?= Html::submitButton('Send', ['class' => 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
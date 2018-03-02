<?php
/**
 * @see \app\controllers\frontend\AuthController::actionResetPassword()
 */

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\frontend\ResetPasswordForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('auth', '{appName} - Reset password', ['appName' => Yii::$app->name]);
$this->params['breadcrumbs'][] = Yii::t('auth', 'Reset password');
?>
<div class="auth-reset-password">
    <h1><?= Html::encode($this->title) ?></h1>

    <p><?= Yii::t('auth', 'Please choose your new password:') ?></p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>

            <?= $form->field($model, 'password')->passwordInput(['autofocus' => true]) ?>

            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<?php
/**
 * @see \app\controllers\backend\SiteController::actionLogin()
 */

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\backend\LoginForm */

use yii\bootstrap\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = Yii::t('admin', 'Login');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-lg-5">
        <?php $form = ActiveForm::begin(['id' => 'login-form', 'as clientScript' => yii\jquery\ActiveFormClientScript::class]); ?>

        <?= $form->field($model, 'username') ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <?php if (Yii::$app->user->enableAutoLogin) : ?>
            <?= $form->field($model, 'rememberMe')->checkbox() ?>
        <?php endif; ?>

        <?php if ($model->isVerifyRobotRequired) : ?>
            <?= $form->field($model, 'verifyCode')->widget(Captcha::class, [
                'template' => '{image}{input}',
            ]) ?>
        <?php endif; ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('admin', 'Login'), ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>

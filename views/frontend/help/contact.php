<?php
/**
 * @see \app\controllers\frontend\HelpController::actionContact()
 */

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\frontend\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = Yii::t('help', 'Contact {appName}', ['appName' => Yii::$app->name]);
$this->params['breadcrumbs'][] = Yii::t('help', 'Contact');

$formatter = Yii::$app->formatter;
?>
<div class="site-contact">
    <h1><?= Yii::t('help', 'Contact') ?></h1>

    <p>
        <?= Yii::t('help', 'If you have business inquiries or other questions, please fill out the following form to contact us. Thank you.') ?>
    </p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

            <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'email') ?>

            <?= $form->field($model, 'subject') ?>

            <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>

            <?php if (Yii::$app->user->isGuest) : ?>
            <?= $form->field($model, 'verifyCode')->widget(Captcha::class, [
                'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
            ]) ?>
            <?php endif; ?>

            <div class="form-group">
                <?= Html::submitButton(Yii::t('common', 'Submit'), ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
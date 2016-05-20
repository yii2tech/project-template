<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\db\User */

$this->title = Yii::t('user', 'Edit profile at {appName}', ['appName' => Yii::$app->name]);
$this->params['breadcrumbs'][] = Yii::t('user', 'Profile');
?>
<div class="account-profile">
    <h1><?= Html::encode(Yii::t('user', 'Profile')) ?></h1>

    <div class="row">
        <div class="col-lg-5">

            <?php $form = ActiveForm::begin(['id' => 'profile-form']); ?>

            <?php /*<?= $form->field($model, 'username')->textInput() ?> */ ?>

            <?= $form->field($model, 'email')->textInput() ?>

            <div class="form-group">
                <?= Html::submitButton(Yii::t('common', 'Save'), ['class' => 'btn btn-primary', 'name' => 'submit-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>

</div>

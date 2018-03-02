<?php
/**
 * @see \app\controllers\backend\AdminController
 * @see \yii2tech\admin\actions\Create
 * @see \yii2tech\admin\actions\Update
 */

use app\models\filedb\IdentityStatus;
use yii\bootstrap\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\db\Admin */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row">
    <div class="col-lg-5">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <?= $form->field($model, 'statusId')->dropDownList(ArrayHelper::map(IdentityStatus::find()->all(), 'id', 'name')) ?>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('admin', 'Create') : Yii::t('admin', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>

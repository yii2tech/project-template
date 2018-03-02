<?php
/**
 * @see \app\controllers\backend\ConfigController::actionIndex()
 */

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $models yii2tech\config\Item[] */

$this->title = Yii::t('admin', 'Application Configuration');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-lg-5">

        <?php $form = ActiveForm::begin([
            'id' => 'config-form'
        ]); ?>

        <?php foreach ($models as $key => $model): ?>
            <?php
            $field = $form->field($model, "[{$key}]value");
            $inputType = ArrayHelper::remove($model->inputOptions, 'type');
            switch($inputType) {
                case 'checkbox':
                    $field->checkbox();
                    break;
                case 'textarea':
                    $field->textarea();
                    break;
                case 'dropDown':
                    $field->dropDownList($model->inputOptions['items']);
                    break;
            }
            echo $field;
            ?>
        <?php endforeach;?>

        <div class="form-group">
            <?= Html::a(Yii::t('admin', 'Restore defaults'), ['default'], ['class' => 'btn btn-danger', 'data-confirm' => Yii::t('admin', 'Are you sure you want to restore default values?')]); ?>
            &nbsp;
            <?= Html::submitButton(Yii::t('admin', 'Save'), ['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
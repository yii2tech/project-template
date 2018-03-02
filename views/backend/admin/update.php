<?php
/**
 * @see \app\controllers\backend\AdminController
 * @see \yii2tech\admin\actions\Update
 */

/* @var $this yii\web\View */
/* @var $model app\models\db\Admin */

$this->title = Yii::t('admin', 'Update Admin: ') . $model->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('admin', 'Administrators'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('admin', 'Update');
?>

<?= $this->render('_form', [
    'model' => $model,
]) ?>

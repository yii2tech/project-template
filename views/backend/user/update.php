<?php

/* @var $this yii\web\View */
/* @var $model app\models\db\User */

$this->title = Yii::t('admin', 'Update User: ') . $model->username;

$this->params['breadcrumbs'][] = ['label' => Yii::t('admin', 'Users'), 'url' => array_merge(['index'], $contextUrlParams)];
$this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => array_merge(['view', 'id' => $model->id], $contextUrlParams)];
$this->params['breadcrumbs'][] = Yii::t('admin', 'Update');
?>

<?= $this->render('_form', [
    'model' => $model,
]) ?>